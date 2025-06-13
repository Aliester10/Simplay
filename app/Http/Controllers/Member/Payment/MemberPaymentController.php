<?php
// app/Http/Controllers/Member/Payment/MemberPaymentController.php - SIMPLIFIED 3 STATUS VERSION

namespace App\Http\Controllers\Member\Payment;

use App\Http\Controllers\Controller;
use App\Models\PaymentStatus;
use App\Models\PaymentSetting;
use App\Models\QrisImage;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MemberPaymentController extends Controller
{
    /**
     * 🔥 SIMPLIFIED: Display payment status list - 3 STATUS ONLY
     */
    public function paymentStatus()
    {
        try {
            $user = auth()->user();
            
            // Get all payments for current user
            $payments = PaymentStatus::where('customer_email', $user->email)
                ->with(['order', 'approvedBy'])
                ->orderBy('created_at', 'desc')
                ->paginate(10);

            // SIMPLIFIED statistics - 3 STATUS ONLY
            $statistics = [
                'total_payments' => PaymentStatus::where('customer_email', $user->email)->count(),
                'pending_payments' => PaymentStatus::where('customer_email', $user->email)->where('status', 'pending')->count(),
                'approved_payments' => PaymentStatus::where('customer_email', $user->email)->where('status', 'approved')->count(),
                'rejected_payments' => PaymentStatus::where('customer_email', $user->email)->where('status', 'rejected')->count()
            ];

            // Recent activity (last 10 status changes)
            $recentActivity = PaymentStatus::where('customer_email', $user->email)
                ->whereNotNull('updated_at')
                ->orderBy('updated_at', 'desc')
                ->take(10)
                ->get();

            Log::info('Member payment status page viewed - SIMPLIFIED', [
                'user_email' => $user->email,
                'payments_count' => $payments->count(),
                'total_payments' => $statistics['total_payments'],
                'pending_payments' => $statistics['pending_payments'],
                'approved_payments' => $statistics['approved_payments'],
                'rejected_payments' => $statistics['rejected_payments'],
                'timestamp' => '2025-06-13 19:49:34'
            ]);

            return view('Member.Payment.status', compact('payments', 'statistics', 'recentActivity'));
            
        } catch (\Exception $e) {
            Log::error('Member payment status error - SIMPLIFIED:', [
                'user_email' => auth()->user()->email,
                'error' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'timestamp' => '2025-06-13 19:49:34'
            ]);
            
            return redirect()->route('portal')->with('error', 'Unable to load payment status.');
        }
    }

    /**
     * 🔥 SIMPLIFIED: Show detailed payment information - 3 STATUS TIMELINE
     */
    public function paymentDetail($id)
    {
        try {
            $user = auth()->user();
            
            $payment = PaymentStatus::where('customer_email', $user->email)
                ->with(['order', 'approvedBy'])
                ->findOrFail($id);

            // SIMPLIFIED payment timeline - 3 STATUS ONLY
            $timeline = [
                [
                    'status' => 'created',
                    'label' => 'Payment Created',
                    'description' => 'Payment record created, waiting for proof upload',
                    'date' => $payment->created_at,
                    'completed' => true,
                    'icon' => 'fa-plus-circle',
                    'color' => 'info'
                ],
                [
                    'status' => 'pending',
                    'label' => 'Proof Uploaded - Pending Review',
                    'description' => 'Payment proof uploaded and waiting for admin review',
                    'date' => $payment->payment_date,
                    'completed' => in_array($payment->status, ['pending', 'approved', 'rejected']),
                    'icon' => 'fa-clock',
                    'color' => 'warning'
                ]
            ];

            // Add final status
            if ($payment->status == 'approved') {
                $timeline[] = [
                    'status' => 'approved',
                    'label' => 'Payment Approved',
                    'description' => 'Payment has been approved by admin',
                    'date' => $payment->approved_at,
                    'completed' => true,
                    'icon' => 'fa-check-circle',
                    'color' => 'success'
                ];
            } elseif ($payment->status == 'rejected') {
                $timeline[] = [
                    'status' => 'rejected',
                    'label' => 'Payment Rejected',
                    'description' => 'Payment was rejected: ' . ($payment->reject_reason ?? 'No reason provided'),
                    'date' => $payment->rejected_at,
                    'completed' => true,
                    'icon' => 'fa-times-circle',
                    'color' => 'danger'
                ];
            } else {
                // Still pending
                $timeline[] = [
                    'status' => 'final',
                    'label' => 'Waiting for Admin Review',
                    'description' => 'Admin will review and approve/reject your payment',
                    'date' => null,
                    'completed' => false,
                    'icon' => 'fa-hourglass',
                    'color' => 'secondary'
                ];
            }

            Log::info('Member payment detail viewed - SIMPLIFIED', [
                'payment_id' => $id,
                'user_email' => $user->email,
                'payment_status' => $payment->status,
                'payment_amount' => $payment->amount,
                'has_proof' => $payment->payment_proof ? true : false,
                'timestamp' => '2025-06-13 19:49:34'
            ]);

            return view('Member.Payment.detail', compact('payment', 'timeline'));
            
        } catch (\Exception $e) {
            Log::error('Member payment detail error - SIMPLIFIED:', [
                'payment_id' => $id,
                'user_email' => auth()->user()->email,
                'error' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'timestamp' => '2025-06-13 19:49:34'
            ]);
            
            return redirect()->route('member.payment.status')->with('error', 'Payment not found.');
        }
    }

    /**
     * Display payment instructions page
     */
    public function paymentInstructions($orderId = null)
    {
        try {
            $user = auth()->user();
            $paymentStatus = null;
            $order = null;

            // If orderId is provided, get the order and related payment
            if ($orderId) {
                $order = Order::where('user_id', $user->id)->findOrFail($orderId);
                $paymentStatus = PaymentStatus::where('order_id', $orderId)
                    ->where('customer_email', $user->email)
                    ->first();
            }

            // Get payment settings with enhanced QR support
            $paymentSettings = $this->getPaymentSettingsData();

            Log::info('Member payment instructions viewed', [
                'user_email' => $user->email,
                'order_id' => $orderId,
                'has_payment_status' => $paymentStatus ? true : false,
                'timestamp' => '2025-06-13 19:49:34'
            ]);

            return view('Member.Payment.instructions', compact('paymentStatus', 'order', 'paymentSettings'));
            
        } catch (\Exception $e) {
            Log::error('Member payment instructions error:', [
                'user_email' => auth()->user()->email,
                'order_id' => $orderId,
                'error' => $e->getMessage(),
                'timestamp' => '2025-06-13 19:49:34'
            ]);
            
            return redirect()->route('portal')->with('error', 'Unable to load payment instructions.');
        }
    }

    /**
     * 🔥 SIMPLIFIED: Upload payment proof - DIRECTLY TO PENDING STATUS
     */
    public function uploadPaymentProof(Request $request, $id)
    {
        try {
            $request->validate([
                'payment_proof' => 'required|image|mimes:jpeg,png,jpg,gif|max:10240', // 10MB max
                'payment_notes' => 'nullable|string|max:500'
            ]);

            $user = auth()->user();
            $payment = PaymentStatus::where('customer_email', $user->email)->findOrFail($id);

            // Check if payment can receive proof upload
            if (!in_array($payment->status, ['pending', 'rejected'])) {
                return response()->json([
                    'success' => false,
                    'message' => 'Payment proof can only be uploaded for new payments or rejected payments.',
                    'current_status' => $payment->status
                ], 400);
            }

            if ($request->hasFile('payment_proof')) {
                // Delete old proof if exists
                if ($payment->payment_proof) {
                    $this->deletePaymentProofFile($payment->payment_proof);
                }

                // Generate unique filename
                $file = $request->file('payment_proof');
                $timestamp = now()->timestamp;
                $filename = $timestamp . '_payment_proof_' . $file->getClientOriginalName();
                
                // Store file in payment-proofs directory
                $path = $file->storeAs('payment-proofs', $filename, 'public');

                // 🔥 IMPORTANT: Set status to 'pending' after upload
                $payment->update([
                    'payment_proof' => $path,
                    'payment_date' => now(),
                    'status' => 'pending', // 🔥 DIRECTLY TO PENDING
                    'payment_notes' => $request->payment_notes,
                    'rejected_at' => null, // Clear rejection data if re-uploading
                    'reject_reason' => null
                ]);

                Log::info('Member payment proof uploaded - SIMPLIFIED TO PENDING', [
                    'payment_id' => $id,
                    'user_email' => $user->email,
                    'file_name' => $filename,
                    'file_path' => $path,
                    'file_size' => $file->getSize(),
                    'mime_type' => $file->getMimeType(),
                    'payment_notes' => $request->payment_notes,
                    'new_status' => 'pending',
                    'timestamp' => '2025-06-13 19:49:34'
                ]);

                return response()->json([
                    'success' => true,
                    'message' => 'Payment proof uploaded successfully! Status changed to pending review.',
                    'data' => [
                        'payment_id' => $payment->id,
                        'status' => $payment->status,
                        'file_path' => $path,
                        'file_url' => asset('storage/' . $path),
                        'upload_date' => $payment->payment_date->format('d/m/Y H:i:s')
                    ]
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => 'No file uploaded.'
            ], 400);

        } catch (\Exception $e) {
            Log::error('Member upload payment proof error - SIMPLIFIED:', [
                'payment_id' => $id,
                'user_email' => auth()->user()->email,
                'error' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'timestamp' => '2025-06-13 19:49:34'
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Error uploading payment proof: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * 🔥 SIMPLIFIED: Create payment record from order - STARTS WITH PENDING STATUS
     */
    public function createPaymentFromOrder($orderId)
    {
        try {
            $user = auth()->user();
            $order = Order::where('user_id', $user->id)->findOrFail($orderId);

            // Check if payment already exists
            $existingPayment = PaymentStatus::where('order_id', $orderId)
                ->where('customer_email', $user->email)
                ->first();

            if ($existingPayment) {
                return response()->json([
                    'success' => true,
                    'message' => 'Payment record already exists.',
                    'payment_id' => $existingPayment->id,
                    'redirect_url' => route('member.payment.instructions', $existingPayment->id)
                ]);
            }

            // Create new payment record with pending status
            $invoiceId = 'INV-ORD-' . $orderId . '-' . time();
            
            $payment = PaymentStatus::create([
                'invoice_id' => $invoiceId,
                'order_id' => $orderId,
                'customer_name' => $user->name,
                'customer_email' => $user->email,
                'amount' => $order->total_amount,
                'payment_method' => 'qris', // Default to QRIS
                'status' => 'pending', // 🔥 START WITH PENDING (no proof yet)
                'created_at' => now(),
                'updated_at' => now()
            ]);

            Log::info('Member payment created from order - SIMPLIFIED', [
                'payment_id' => $payment->id,
                'order_id' => $orderId,
                'invoice_id' => $invoiceId,
                'user_email' => $user->email,
                'amount' => $order->total_amount,
                'initial_status' => 'pending',
                'timestamp' => '2025-06-13 19:49:34'
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Payment record created successfully!',
                'payment_id' => $payment->id,
                'invoice_id' => $invoiceId,
                'redirect_url' => route('member.payment.instructions', $payment->id)
            ]);

        } catch (\Exception $e) {
            Log::error('Member create payment from order error - SIMPLIFIED:', [
                'order_id' => $orderId,
                'user_email' => auth()->user()->email,
                'error' => $e->getMessage(),
                'timestamp' => '2025-06-13 19:49:34'
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Error creating payment record: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get payment settings with BLOB QR support
     */
    public function getPaymentSettings()
    {
        try {
            $data = $this->getPaymentSettingsData();
            
            return response()->json([
                'success' => true,
                'data' => $data,
                'timestamp' => '2025-06-13 19:49:34',
                'debug_info' => [
                    'user' => 'Aliester10',
                    'qr_source' => $data['qr_image'] ? $data['qr_image']['source'] : 'none',
                    'blob_available' => isset($data['qr_image']['blob_size'])
                ]
            ]);
            
        } catch (\Exception $e) {
            Log::error('Member get payment settings error - SIMPLIFIED:', [
                'error' => $e->getMessage(),
                'timestamp' => '2025-06-13 19:49:34'
            ]);

            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
                'data' => null,
                'timestamp' => '2025-06-13 19:49:34'
            ], 500);
        }
    }

    /**
     * Show payment proof image
     */
    public function showPaymentProof($id)
    {
        try {
            $user = auth()->user();
            $payment = PaymentStatus::where('customer_email', $user->email)->findOrFail($id);
            
            if (!$payment->payment_proof) {
                Log::warning('Member tried to access non-existent payment proof', [
                    'payment_id' => $id,
                    'user_email' => $user->email,
                    'timestamp' => '2025-06-13 19:49:34'
                ]);
                abort(404, 'No payment proof found');
            }

            Log::info('Member accessing payment proof', [
                'payment_id' => $id,
                'file' => $payment->payment_proof,
                'user_email' => $user->email,
                'timestamp' => '2025-06-13 19:49:34'
            ]);

            // Try multiple possible file locations
            $possiblePaths = [
                storage_path('app/public/' . $payment->payment_proof),
                storage_path('app/public/payment-proofs/' . basename($payment->payment_proof)),
                storage_path('app/public/payment_proofs/' . basename($payment->payment_proof)),
                public_path('storage/' . $payment->payment_proof),
                public_path('storage/payment-proofs/' . basename($payment->payment_proof)),
                public_path('storage/payment_proofs/' . basename($payment->payment_proof))
            ];

            foreach ($possiblePaths as $path) {
                if (file_exists($path) && is_readable($path)) {
                    Log::info('Member payment proof file found', [
                        'payment_id' => $id,
                        'path' => $path,
                        'file_size' => filesize($path),
                        'timestamp' => '2025-06-13 19:49:34'
                    ]);
                    
                    return response()->file($path);
                }
            }

            Log::error('Member payment proof file not found in any location', [
                'payment_id' => $id,
                'file' => $payment->payment_proof,
                'checked_paths' => $possiblePaths,
                'user_email' => $user->email,
                'timestamp' => '2025-06-13 19:49:34'
            ]);

            abort(404, 'Payment proof file not found on server');

        } catch (\Exception $e) {
            Log::error('Member show payment proof error:', [
                'payment_id' => $id,
                'error' => $e->getMessage(),
                'user_email' => auth()->user()->email,
                'timestamp' => '2025-06-13 19:49:34'
            ]);
            
            abort(404, 'Payment proof not accessible: ' . $e->getMessage());
        }
    }

    /**
     * Get payment settings data with enhanced QR support
     */
    private function getPaymentSettingsData()
    {
        $settings = PaymentSetting::where('status', 'active')->first();
        
        if (!$settings) {
            return [
                'bank_name' => null,
                'account_number' => null,
                'account_name' => null,
                'payment_instructions' => 'Payment settings not configured',
                'qr_image' => null,
                'status' => 'inactive'
            ];
        }

        $qrImage = null;
        
        // Priority 1: QrisImage file
        $qrImageRecord = QrisImage::where('status', 'active')->first();
        if ($qrImageRecord && $qrImageRecord->image_path && file_exists(public_path('storage/' . $qrImageRecord->image_path))) {
            $qrImage = [
                'id' => $qrImageRecord->id,
                'name' => $qrImageRecord->name,
                'image_path' => $qrImageRecord->image_path,
                'full_url' => asset('storage/' . $qrImageRecord->image_path),
                'source' => 'file',
                'timestamp' => '2025-06-13 19:49:34',
                'user' => 'Aliester10'
            ];
        }
        // Priority 2: BLOB data
        elseif ($settings->qr_img) {
            $qrImage = [
                'id' => $settings->id,
                'name' => 'QR Payment (Database BLOB)',
                'image_path' => null,
                'full_url' => 'data:image/png;base64,' . base64_encode($settings->qr_img),
                'source' => 'blob',
                'blob_size' => strlen($settings->qr_img),
                'timestamp' => '2025-06-13 19:49:34',
                'user' => 'Aliester10'
            ];
        }
        
        return [
            'bank_name' => $settings->bank_name,
            'account_number' => $settings->account_number,
            'account_name' => $settings->account_name,
            'payment_instructions' => $settings->payment_instructions,
            'qr_image' => $qrImage,
            'status' => $settings->status
        ];
    }

    /**
     * Delete payment proof file helper
     */
    private function deletePaymentProofFile($filename)
    {
        try {
            $possiblePaths = [
                'payment-proofs/' . basename($filename),
                'payment_proofs/' . basename($filename),
                'payment/proofs/' . basename($filename),
                $filename // If full path is stored
            ];

            foreach ($possiblePaths as $path) {
                if (Storage::disk('public')->exists($path)) {
                    Storage::disk('public')->delete($path);
                    Log::info('Deleted old payment proof file: ' . $path);
                }
            }
        } catch (\Exception $e) {
            Log::warning('Failed to delete payment proof file: ' . $e->getMessage());
        }
    }
}