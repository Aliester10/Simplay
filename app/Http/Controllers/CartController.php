<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Produk;
use App\Models\Cart;
use App\Models\Order;
use App\Models\PaymentStatus;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    /**
     * Display the cart page
     */
    public function index()
    {
        try {
            if (!auth()->check()) {
                return redirect()->route('login')->with('error', 'Please login to view your cart');
            }

            $user = auth()->user();
            $cartItems = Cart::where('user_id', $user->id)
                ->with(['produk.images'])
                ->get();

            $products = [];
            $total = 0;

            foreach ($cartItems as $cartItem) {
                if ($cartItem->produk) {
                    $product = $cartItem->produk;
                    $product->cartQuantity = $cartItem->quantity;
                    $product->cartPrice = $cartItem->price;
                    $product->subtotal = $cartItem->quantity * $cartItem->price;
                    $products[] = $product;
                    $total += $product->subtotal;
                }
            }

            return view('Member.Portal.cart', compact('products', 'total'));
        } catch (\Exception $e) {
            Log::error('Cart index error:', ['error' => $e->getMessage()]);
            return view('Member.Portal.cart', ['products' => [], 'total' => 0]);
        }
    }

    /**
     * Add product to cart
     */
    public function addToCart(Request $request)
    {
        try {
            if (!auth()->check()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Please login first'
                ], 401);
            }

            $request->validate([
                'product_id' => 'required|integer',
                'quantity' => 'required|integer|min:1'
            ]);

            $user = auth()->user();
            $product = Produk::find($request->product_id);
            
            if (!$product) {
                return response()->json([
                    'success' => false,
                    'message' => 'Product not found'
                ], 404);
            }

            // Update or create cart item
            $cartItem = Cart::updateOrCreate(
                [
                    'user_id' => $user->id,
                    'produk_id' => $request->product_id,
                ],
                [
                    'quantity' => DB::raw("quantity + {$request->quantity}"),
                    'price' => $product->harga ?? 0,
                ]
            );

            $cartCount = Cart::where('user_id', $user->id)->count();
            
            return response()->json([
                'success' => true,
                'message' => 'Product added to cart successfully!',
                'cartCount' => $cartCount
            ]);

        } catch (\Exception $e) {
            Log::error('Add to cart error:', ['error' => $e->getMessage()]);
            return response()->json([
                'success' => false,
                'message' => 'Failed to add product to cart: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update cart quantity
     */
    public function updateCart(Request $request)
    {
        try {
            if (!auth()->check()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Please login first'
                ], 401);
            }

            $request->validate([
                'product_id' => 'required|integer',
                'quantity' => 'required|integer|min:1'
            ]);

            $user = auth()->user();
            $cartItem = Cart::where('user_id', $user->id)
                ->where('produk_id', $request->product_id)
                ->first();
            
            if (!$cartItem) {
                return response()->json([
                    'success' => false,
                    'message' => 'Product not found in cart'
                ], 404);
            }
            
            $cartItem->update(['quantity' => $request->quantity]);
            
            return response()->json([
                'success' => true,
                'message' => 'Cart updated successfully'
            ]);

        } catch (\Exception $e) {
            Log::error('Update cart error:', ['error' => $e->getMessage()]);
            return response()->json([
                'success' => false,
                'message' => 'Failed to update cart: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove product from cart
     */
    public function removeFromCart(Request $request)
    {
        try {
            if (!auth()->check()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Please login first'
                ], 401);
            }

            $request->validate([
                'product_id' => 'required|integer'
            ]);

            $user = auth()->user();
            $deleted = Cart::where('user_id', $user->id)
                ->where('produk_id', $request->product_id)
                ->delete();
            
            if (!$deleted) {
                return response()->json([
                    'success' => false,
                    'message' => 'Product not found in cart'
                ], 404);
            }
            
            return response()->json([
                'success' => true,
                'message' => 'Product removed from cart'
            ]);

        } catch (\Exception $e) {
            Log::error('Remove from cart error:', ['error' => $e->getMessage()]);
            return response()->json([
                'success' => false,
                'message' => 'Failed to remove from cart: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update quantity (alias for updateCart)
     */
    public function updateQuantity(Request $request)
    {
        return $this->updateCart($request);
    }

    /**
     * Remove item (alias for removeFromCart)
     */
    public function removeItem(Request $request)
    {
        return $this->removeFromCart($request);
    }

    /**
     * Process checkout
     */
    public function processCheckout(Request $request)
    {
        try {
            if (!auth()->check()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Please login first'
                ], 401);
            }

            $user = auth()->user();
            $cartItems = Cart::where('user_id', $user->id)->with('produk')->get();

            if ($cartItems->count() === 0) {
                return response()->json([
                    'success' => false,
                    'message' => 'Cart is empty'
                ], 400);
            }

            $totalAmount = $cartItems->sum(function($item) {
                return $item->quantity * $item->price;
            });

            DB::beginTransaction();

            // Create order
            $order = Order::create([
                'user_id' => $user->id,
                'order_number' => 'ORD-' . time() . '-' . $user->id,
                'total_amount' => $totalAmount,
                'status' => 'pending_payment',
                'payment_method' => $request->payment_method ?? 'qris'
            ]);

            // Create payment status record
            $paymentStatus = PaymentStatus::create([
                'invoice_id' => 'INV-' . $order->order_number,
                'customer_name' => $user->name,
                'customer_email' => $user->email,
                'amount' => $totalAmount,
                'payment_method' => $request->payment_method ?? 'qris',
                'status' => 'pending',
                'order_id' => $order->id
            ]);

            // Store payment ID in session
            session(['payment_id' => $paymentStatus->id]);

            // Clear cart
            Cart::where('user_id', $user->id)->delete();

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Order created successfully',
                'order_id' => $order->id,
                'payment_id' => $paymentStatus->id,
                'total_amount' => $totalAmount,
                'redirect_url' => route('payment.show', $paymentStatus->id)
            ]);

        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Checkout error:', ['error' => $e->getMessage()]);
            return response()->json([
                'success' => false,
                'message' => 'Error creating order: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Show payment page
     */
    public function showPayment($id)
    {
        try {
            if (!auth()->check()) {
                return redirect()->route('login');
            }

            $paymentStatus = PaymentStatus::findOrFail($id);
            
            // Store payment ID in session for upload form
            session(['payment_id' => $id]);
            
            return view('payment.show', compact('paymentStatus'));
        } catch (\Exception $e) {
            Log::error('Show payment error:', ['error' => $e->getMessage()]);
            return redirect()->route('cart.index')->with('error', 'Payment not found');
        }
    }

    /**
     * Upload payment proof
     */
    public function uploadPaymentProof(Request $request, $id)
    {
        try {
            if (!auth()->check()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Please login first'
                ], 401);
            }

            $request->validate([
                'payment_proof' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                'notes' => 'nullable|string|max:500'
            ]);

            $paymentStatus = PaymentStatus::findOrFail($id);

            if ($request->hasFile('payment_proof')) {
                $file = $request->file('payment_proof');
                $filename = time() . '_payment_proof_' . $file->getClientOriginalName();
                $path = $file->storeAs('payment-proofs', $filename, 'public');

                $paymentStatus->update([
                    'payment_proof' => $path,
                    'status' => 'uploaded',
                    'payment_date' => now(),
                    'admin_notes' => $request->notes
                ]);

                return response()->json([
                    'success' => true,
                    'message' => 'Payment proof uploaded successfully'
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => 'No file uploaded'
            ], 400);

        } catch (\Exception $e) {
            Log::error('Upload payment proof error:', ['error' => $e->getMessage()]);
            return response()->json([
                'success' => false,
                'message' => 'Error uploading payment proof: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get payment status
     */
    public function paymentStatus($id)
    {
        try {
            if (!auth()->check()) {
                return redirect()->route('login');
            }

            $paymentStatus = PaymentStatus::findOrFail($id);
            return view('payment.status', compact('paymentStatus'));
        } catch (\Exception $e) {
            Log::error('Payment status error:', ['error' => $e->getMessage()]);
            return redirect()->route('cart.index')->with('error', 'Payment status not found');
        }
    }
}