<?php

namespace Database\Seeders;

use App\Models\PaymentSetting;
use App\Models\PaymentStatus;
use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Seeder;

class PaymentSystemSeeder extends Seeder
{
    public function run()
    {
        // Create default payment settings
        PaymentSetting::updateOrCreate(
            ['id' => 1],
            [
                'bank_name' => 'Bank Central Asia (BCA)',
                'account_number' => '1234567890',
                'account_name' => 'PT. Simplay Indonesia',
                'payment_instructions' => 'Silakan transfer ke rekening di atas dan upload bukti pembayaran.',
                'status' => 'active'
            ]
        );

        // Check if orders exist, if not create sample payment statuses manually
        $orders = Order::take(3)->get();
        
        if ($orders->count() > 0) {
            // Create payment status from existing orders
            foreach ($orders as $order) {
                PaymentStatus::updateOrCreate(
                    ['order_id' => $order->id],
                    [
                        'invoice_id' => 'INV-' . str_pad($order->id, 3, '0', STR_PAD_LEFT),
                        'customer_name' => $order->user->name,
                        'customer_email' => $order->user->email,
                        'amount' => $order->total_amount,
                        'payment_method' => $order->payment_method === 'qris' ? 'qris' : 'bank_transfer',
                        'status' => 'pending',
                        'payment_date' => now(),
                        'order_id' => $order->id
                    ]
                );
            }
        } else {
            // Create sample payment statuses without orders
            // Get non-admin users (raw type 0 = member, 2 = distributor)
            $users = User::whereIn('type', [0, 2])->take(3)->get();
            
            if ($users->count() > 0) {
                foreach ($users as $index => $user) {
                    PaymentStatus::create([
                        'invoice_id' => 'INV-' . str_pad($index + 1, 3, '0', STR_PAD_LEFT),
                        'customer_name' => $user->name,
                        'customer_email' => $user->email,
                        'amount' => rand(500000, 5000000), // Random amount between 500k - 5M
                        'payment_method' => ['bank_transfer', 'qris'][rand(0, 1)],
                        'status' => ['pending', 'approved', 'rejected'][rand(0, 2)],
                        'payment_date' => now()->subDays(rand(1, 30)),
                        'order_id' => null // No order relation
                    ]);
                }
            } else {
                // Create dummy payment statuses
                for ($i = 1; $i <= 5; $i++) {
                    PaymentStatus::create([
                        'invoice_id' => 'INV-' . str_pad($i, 3, '0', STR_PAD_LEFT),
                        'customer_name' => 'Customer ' . $i,
                        'customer_email' => 'customer' . $i . '@example.com',
                        'amount' => rand(500000, 5000000),
                        'payment_method' => ['bank_transfer', 'qris'][rand(0, 1)],
                        'status' => ['pending', 'approved', 'rejected'][rand(0, 2)],
                        'payment_date' => now()->subDays(rand(1, 30)),
                        'order_id' => null
                    ]);
                }
            }
        }

        // Create sample orders if none exist
        if (Order::count() == 0) {
            $users = User::whereIn('type', [0, 2])->take(3)->get();
            
            foreach ($users as $index => $user) {
                $order = Order::create([
                    'user_id' => $user->id,
                    'order_number' => 'ORD-' . date('Ymd') . '-' . str_pad($index + 1, 3, '0', STR_PAD_LEFT),
                    'total_amount' => rand(1000000, 10000000),
                    'status' => ['pending_payment', 'processing', 'completed'][rand(0, 2)],
                    'payment_method' => 'qris'
                ]);

                // Create payment status for this order
                PaymentStatus::create([
                    'invoice_id' => 'INV-' . str_pad($order->id, 3, '0', STR_PAD_LEFT),
                    'customer_name' => $user->name,
                    'customer_email' => $user->email,
                    'amount' => $order->total_amount,
                    'payment_method' => 'qris',
                    'status' => 'pending',
                    'payment_date' => now(),
                    'order_id' => $order->id
                ]);
            }
        }

        $this->command->info('Payment system seeded successfully!');
    }
}