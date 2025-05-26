<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Produk; // Pastikan ini adalah nama model yang benar

class CartController extends Controller
{
    /**
     * Display the cart page
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $cartItems = session()->get('cart', []);
        $products = [];
        $total = 0;

        if (!empty($cartItems)) {
            foreach ($cartItems as $id => $details) {
                $product = Produk::find($id);
                if ($product) {
                    $product->cartQuantity = $details['quantity'];
                    $product->subtotal = $product->harga * $details['quantity'];
                    $products[] = $product;
                    $total += $product->subtotal;
                }
            }
        }

        return view('Member.Portal.cart', compact('products', 'total'));
    }

    /**
     * Add product to cart
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addToCart(Request $request)
    {
        try {
            Log::info('Add to cart request:', $request->all());
            
            $request->validate([
                'product_id' => 'required|integer',
                'quantity' => 'required|integer|min:1'
            ]);

            $product = Produk::find($request->product_id);
            
            if (!$product) {
                return response()->json([
                    'success' => false,
                    'message' => 'Product not found. ID: ' . $request->product_id
                ], 404);
            }
            
            $cart = session()->get('cart', []);

            // If product already in cart, update quantity
            if (isset($cart[$request->product_id])) {
                $cart[$request->product_id]['quantity'] += $request->quantity;
            } else {
                // If product not in cart, add it
                $cart[$request->product_id] = [
                    'name' => $product->nama,
                    'quantity' => $request->quantity,
                    'price' => $product->harga,
                    'image' => $product->images && $product->images->first() ? $product->images->first()->gambar : 'assets/img/default.jpg'
                ];
            }

            session()->put('cart', $cart);
            Log::info('Product added to cart:', ['product_id' => $product->id, 'cart_count' => count($cart)]);
            
            return response()->json([
                'success' => true,
                'message' => 'Product added to cart successfully!',
                'cartCount' => count($cart)
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to add product to cart:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'Failed to add product to cart: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update cart quantity
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateCart(Request $request)
    {
        try {
            if (!$request->has('product_id') || !$request->has('quantity')) {
                return response()->json([
                    'success' => false, 
                    'message' => 'Product ID and quantity are required'
                ], 400);
            }

            $cart = session()->get('cart', []);
            
            if (!isset($cart[$request->product_id])) {
                return response()->json([
                    'success' => false,
                    'message' => 'Product not found in cart'
                ], 404);
            }
            
            $cart[$request->product_id]['quantity'] = $request->quantity;
            session()->put('cart', $cart);
            
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            Log::error('Failed to update cart:', ['error' => $e->getMessage()]);
            return response()->json([
                'success' => false,
                'message' => 'Failed to update cart: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove product from cart
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function removeFromCart(Request $request)
    {
        try {
            if (!$request->has('product_id')) {
                return response()->json([
                    'success' => false,
                    'message' => 'Product ID is required'
                ], 400);
            }

            $cart = session()->get('cart', []);
            
            if (!isset($cart[$request->product_id])) {
                return response()->json([
                    'success' => false,
                    'message' => 'Product not found in cart'
                ], 404);
            }
            
            unset($cart[$request->product_id]);
            session()->put('cart', $cart);
            
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            Log::error('Failed to remove from cart:', ['error' => $e->getMessage()]);
            return response()->json([
                'success' => false,
                'message' => 'Failed to remove from cart: ' . $e->getMessage()
            ], 500);
        }
    }
}