<?php

namespace App\Http\Controllers\Member\Portal;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use App\Models\InspeksiMaintenance;
use App\Models\Produk;
use App\Models\UserProduk;
use App\Models\Cart;
use App\Models\Order;
use App\Models\PaymentStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PortalController extends Controller
{
    public function index()
    {
        return view('Member.Portal.portal');
    }

    public function userProduk()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Please login to access your product catalog.');
        }

        $produks = $user->userProduk; // Fetch products associated with the authenticated user

        return view('Member.Portal.user-product', compact('produks'));
    }

    public function detailProduk($id)
    {
        $produk = Produk::with(['images', 'videos', 'documentCertificationsProduk', 'brosur'])->findOrFail($id);

        $user = Auth::user();

        $userProduk = $user ? $user->userProduk->where('produk_id', $id)->first() : null;

        return view('Member.Portal.detail-product', compact('produk', 'userProduk'));
    }

    public function Instructions()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please login to access your photos.');
        }

        $user = Auth::user();

        // Fetch the products associated with the user along with their manuals
        $userProduks = $user->userProduk; // Get the user's `UserProduk` records
        $produks = $userProduks->map(function ($userProduk) {
            return $userProduk->produk; // Get the related `Produk` model for each `UserProduk`
        });

        $uniqueProduks = $produks->unique('id');

        return view('Member.Portal.instructions', compact('uniqueProduks'));
    }

    public function videos()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please login to access your photos.');
        }

        $user = Auth::user();

        // Fetch the products associated with the user along with their manuals
        $userProduks = $user->userProduk; // Get the user's `UserProduk` records
        $produks = $userProduks->map(function ($userProduk) {
            return $userProduk->produk; // Get the related `Produk` model for each `UserProduk`
        });

        // Remove duplicate products based on a unique identifier, e.g., product ID
        $uniqueProduks = $produks->unique('id');

        return view('Member.Portal.tutorials', compact('uniqueProduks'));
    }

    public function document()
    {
        // Mendapatkan data pengguna saat ini
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please login to access your photos.');
        }

        $user = Auth::user();

        // Fetch the products associated with the user along with their manuals
        $userProduks = $user->userProduk; // Get the user's `UserProduk` records
        $produks = $userProduks->map(function ($userProduk) {
            return $userProduk->produk; // Get the related `Produk` model for each `UserProduk`
        });

        $uniqueProduks = $produks->unique('id');

        // Mengembalikan tampilan dengan data produk dan dokumen sertifikasi
        return view('Member.Portal.document', compact('uniqueProduks'));
    }

    public function Monitoring()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please login to access your monitoring.');
        }

        $userProduks = UserProduk::with(['produk', 'monitoring'])->where('user_id', auth()->id())->get();

        $inspeksi = InspeksiMaintenance::where('user_produk_id', auth()->id())->get();

        return view('Member.Portal.monitoring', compact('userProduks'));
    }

    public function showInspeksiMaintenance($id)
    {
        // Retrieve the specific userProduk with its related InspeksiMaintenance
        $userProduk = UserProduk::with(['produk', 'inspeksiMaintenance'])->findOrFail($id);

        return view('Member.Portal.monitoring-detail', compact('userProduk'));
    }

    public function Faq()
    {
        $faqs = Faq::all();
        return view('Member.Portal.qna', compact('faqs'));
    }

    // ======== NEW CART AND PAYMENT METHODS ========

    /**
     * Show cart page
     */
    public function cart()
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login')->with('error', 'Please login to access your cart.');
        }

        // Get cart items for the user
        $cartItems = Cart::where('user_id', $user->id)->with('produk.images')->get();
        
        // Calculate cart data
        $products = $cartItems->map(function ($item) {
            $produk = $item->produk;
            $produk->cartQuantity = $item->quantity;
            $produk->subtotal = $item->quantity * $item->price;
            return $produk;
        });

        $total = $cartItems->sum(function ($item) {
            return $item->quantity * $item->price;
        });

        return view('Member.Portal.cart', compact('products', 'total'));
    }

    /**
     * Add product to cart
     */
    public function addToCart(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:produk,id',
            'quantity' => 'required|integer|min:1'
        ]);

        $user = Auth::user();
        if (!$user) {
            return response()->json(['success' => false, 'message' => 'Please login first']);
        }

        $produk = Produk::findOrFail($request->product_id);

        // Check if item already exists in cart
        $cartItem = Cart::where('user_id', $user->id)
                       ->where('produk_id', $request->product_id)
                       ->first();

        if ($cartItem) {
            // Update quantity
            $cartItem->update([
                'quantity' => $cartItem->quantity + $request->quantity
            ]);
        } else {
            // Create new cart item
            Cart::create([
                'user_id' => $user->id,
                'produk_id' => $request->product_id,
                'quantity' => $request->quantity,
                'price' => $produk->harga
            ]);
        }

        return response()->json(['success' => true, 'message' => 'Product added to cart']);
    }

    /**
     * Update cart item quantity
     */
    public function updateCart(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:produk,id',
            'quantity' => 'required|integer|min:1'
        ]);

        $user = Auth::user();
        if (!$user) {
            return response()->json(['success' => false, 'message' => 'Please login first']);
        }

        $cartItem = Cart::where('user_id', $user->id)
                       ->where('produk_id', $request->product_id)
                       ->first();

        if ($cartItem) {
            $cartItem->update(['quantity' => $request->quantity]);
            return response()->json(['success' => true, 'message' => 'Cart updated']);
        }

        return response()->json(['success' => false, 'message' => 'Cart item not found']);
    }

    /**
     * Remove item from cart
     */
    public function removeFromCart(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:produk,id'
        ]);

        $user = Auth::user();
        if (!$user) {
            return response()->json(['success' => false, 'message' => 'Please login first']);
        }

        $deleted = Cart::where('user_id', $user->id)
                      ->where('produk_id', $request->product_id)
                      ->delete();

        if ($deleted) {
            return response()->json(['success' => true, 'message' => 'Item removed from cart']);
        }

        return response()->json(['success' => false, 'message' => 'Item not found in cart']);
    }

    /**
     * Checkout process - Create order and payment
     */
    public function checkout(Request $request)
    {
        try {
            $user = Auth::user();
            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'Please login first'
                ]);
            }

            // Get cart items
            $cartItems = Cart::where('user_id', $user->id)->with('produk')->get();
            
            if ($cartItems->isEmpty()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Cart is empty'
                ]);
            }
            
            // Calculate total
            $total = $cartItems->sum(function($item) {
                return $item->quantity * $item->price;
            });
            
            // Create order
            $order = Order::create([
                'user_id' => $user->id,
                'order_number' => 'ORD-' . date('Ymd') . '-' . str_pad(rand(1, 9999), 4, '0', STR_PAD_LEFT),
                'total_amount' => $total,
                'status' => 'pending_payment',
                'payment_method' => 'qris'
            ]);
            
            // Create payment status
            $payment = PaymentStatus::create([
                'invoice_id' => 'INV-' . str_pad($order->id, 6, '0', STR_PAD_LEFT),
                'customer_name' => $user->name,
                'customer_email' => $user->email,
                'amount' => $total,
                'payment_method' => 'qris',
                'status' => 'pending',
                'payment_date' => now(),
                'order_id' => $order->id
            ]);
            
            // Clear cart
            Cart::where('user_id', $user->id)->delete();
            
            return response()->json([
                'success' => true,
                'payment_id' => $payment->id,
                'message' => 'Order created successfully'
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error creating order: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * Submit order (legacy method if needed)
     */
    public function submitOrder(Request $request)
    {
        // This can redirect to checkout or handle order submission
        return $this->checkout($request);
    }
}