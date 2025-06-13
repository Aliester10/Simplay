<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Cart;
use App\Models\User;
use App\Models\Produk;

class CartSeeder extends Seeder
{
    public function run()
    {
        // Get sample user and products for testing
        $user = User::where('type', 0)->first(); // Member user
        $products = Produk::take(3)->get();

        if ($user && $products->count() > 0) {
            foreach ($products as $index => $product) {
                Cart::create([
                    'user_id' => $user->id,
                    'produk_id' => $product->id,
                    'quantity' => $index + 1,
                    'price' => $product->harga
                ]);
            }
        }
    }
}