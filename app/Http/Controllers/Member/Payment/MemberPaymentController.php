<?php

namespace App\Http\Controllers\Member\Payment;

use App\Http\Controllers\Controller;
use App\Models\PaymentStatus;
use App\Models\PaymentSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MemberPaymentController extends Controller
{
    /**
     * Display payment status list - FIXED VERSION
     */
    public function paymentStatus()
    {
        try {
            if (!auth()->check()) {
                return redirect()->route('login')->with('error', 'Please login to view payment status');
            }

            $user = auth()->user();
            
            // Get user's payment records
            $payments = PaymentStatus::where('customer_email', $user->email)
                ->orWhere('customer_name', $user->name)
                ->orderBy('created_at', 'desc')
                ->paginate(6);

            // FIXED: Get payment settings for the view
            $paymentSettings = PaymentSetting::where('status', 'active')->first();

            Log::info('Payment status viewed', [
                'user_id' => $user->id,
                'user_email' => $user->email,
                'payments_count' => $payments->count(),
                'timestamp' => '2025-06-13 07:09:51'
            ]);

            // FIXED: Pass both variables to view
            return view('Member.Payment.status', compact('payments', 'paymentSettings'));
            
        } catch (\Exception $e) {
            Log::error('Payment status error:', [
                'error' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'user' => auth()->check() ? auth()->user()->email : 'guest',
                'timestamp' => '2025-06-13 07:09:51'
            ]);
            
            return redirect()->route('portal')->with('error', 'Unable to load payment status. Please try again.');
        }
    }

    /**
     * Display specific payment detail
     */
    public function paymentDetail($id)
    {
        try {
            if (!auth()->check()) {
                return redirect()->route('login');
            }

            $user = auth()->user();
            
            $payment = PaymentStatus::where('id', $id)
                ->where(function($query) use ($user) {
                    $query->where('customer_email', $user->email)
                          ->orWhere('customer_name', $user->name);
                })
                ->firstOrFail();

            $paymentSettings = PaymentSetting::where('status', 'active')->first();

            return view('Member.Payment.detail', compact('payment', 'paymentSettings'));
            
        } catch (\Exception $e) {
            Log::error('Payment detail error:', [
                'payment_id' => $id,
                'error' => $e->getMessage(),
                'user' => auth()->check() ? auth()->user()->email : 'guest',
                'timestamp' => '2025-06-13 07:09:51'
            ]);
            
            return redirect()->route('member.payment.status')->with('error', 'Payment not found.');
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

            $user = auth()->user();
            
            $payment = PaymentStatus::where('id', $id)
                ->where(function($query) use ($user) {
                    $query->where('customer_email', $user->email)
                          ->orWhere('customer_name', $user->name);
                })
                ->firstOrFail();

            if ($request->hasFile('payment_proof')) {
                $file = $request->file('payment_proof');
                $filename = time() . '_' . $payment->id . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('payment-proofs', $filename, 'public');

                $payment->update([
                    'payment_proof' => $path,
                    'status' => 'uploaded',
                    'payment_date' => now(),
                    'admin_notes' => $request->notes
                ]);

                Log::info('Payment proof uploaded', [
                    'payment_id' => $payment->id,
                    'user_email' => $user->email,
                    'filename' => $filename,
                    'timestamp' => '2025-06-13 07:09:51'
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
            Log::error('Upload payment proof error:', [
                'payment_id' => $id,
                'error' => $e->getMessage(),
                'user' => auth()->check() ? auth()->user()->email : 'guest',
                'timestamp' => '2025-06-13 07:09:51'
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'Error uploading payment proof: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Payment instructions
     */
    public function paymentInstructions($orderId = null)
    {
        try {
            $paymentSettings = PaymentSetting::where('status', 'active')->first();
            
            return view('Member.Payment.instructions', compact('paymentSettings', 'orderId'));
            
        } catch (\Exception $e) {
            Log::error('Payment instructions error:', [
                'error' => $e->getMessage(),
                'timestamp' => '2025-06-13 07:09:51'
            ]);
            
            return redirect()->route('portal')->with('error', 'Unable to load payment instructions.');
        }
    }

    /**
     * Create payment from order
     */
    public function createPaymentFromOrder(Request $request, $orderId)
    {
        try {
            if (!auth()->check()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Please login first'
                ], 401);
            }

            $user = auth()->user();
            
            // Create payment status without order dependency
            $payment = PaymentStatus::create([
                'invoice_id' => 'INV-' . time() . '-' . $user->id,
                'customer_name' => $user->name,
                'customer_email' => $user->email,
                'amount' => $request->amount ?? 0,
                'payment_method' => 'qris',
                'status' => 'pending',
                'order_id' => $orderId
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Payment created successfully',
                'payment_id' => $payment->id
            ]);

        } catch (\Exception $e) {
            Log::error('Create payment from order error:', [
                'order_id' => $orderId,
                'error' => $e->getMessage(),
                'user' => auth()->check() ? auth()->user()->email : 'guest',
                'timestamp' => '2025-06-13 07:09:51'
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'Error creating payment: ' . $e->getMessage()
            ], 500);
        }
    }
}