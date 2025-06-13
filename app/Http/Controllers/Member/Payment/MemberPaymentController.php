<?php
// app/Http/Controllers/Member/Payment/MemberPaymentController.php - PATH FIX INTEGRATED

namespace App\Http\Controllers\Member\Payment;

use App\Http\Controllers\Controller;
use App\Models\PaymentStatus;
use App\Models\PaymentSetting;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class MemberPaymentController extends Controller
{
    /**
     * Display payment status list - ENHANCED WITH PATH FIX
     */
    public function paymentStatus()
    {
        try {
            if (!auth()->check()) {
                return redirect()->route('login')->with('error', 'Please login to view payment status');
            }

            $user = auth()->user();
            
            // ENHANCED: Get user's payment records with better query
            $payments = PaymentStatus::where(function($query) use ($user) {
                    $query->where('customer_email', $user->email)
                          ->orWhere('customer_name', $user->name);
                })
                ->with(['order', 'approvedBy'])
                ->orderBy('created_at', 'desc')
                ->paginate(10);

            // DEBUG: Log payment proof info for path debugging
            foreach ($payments as $payment) {
                if ($payment->payment_proof) {
                    Log::info('Payment proof path debug', [
                        'payment_id' => $payment->id,
                        'file' => $payment->payment_proof,
                        'url' => $payment->payment_proof_url,
                        'exists' => $payment->payment_proof_exists,
                        'timestamp' => '2025-06-13 18:28:03'
                    ]);
                }
            }

            // ENHANCED: Get payment settings with better error handling
            $paymentSettings = PaymentSetting::where('status', 'active')->first();

            Log::info('Payment status viewed - PATH FIX', [
                'user_id' => $user->id,
                'user_email' => $user->email,
                'payments_count' => $payments->count(),
                'payments_with_proof' => $payments->filter(fn($p) => $p->payment_proof)->count(),
                'has_payment_settings' => $paymentSettings ? true : false,
                'timestamp' => '2025-06-13 18:28:03',
                'version' => 'path_fix_v1'
            ]);

            return view('Member.Payment.status', compact('payments', 'paymentSettings'));
            
        } catch (\Exception $e) {
            Log::error('Payment status error - PATH FIX:', [
                'error' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'user' => auth()->check() ? auth()->user()->email : 'guest',
                'timestamp' => '2025-06-13 18:28:03'
            ]);
            
            return redirect()->route('portal')->with('error', 'Unable to load payment status. Please try again.');
        }
    }

    /**
     * Display specific payment detail - ENHANCED WITH PATH FIX
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
                ->with(['order', 'approvedBy'])
                ->firstOrFail();

            $paymentSettings = PaymentSetting::where('status', 'active')->first();

            Log::info('Payment detail viewed - PATH FIX', [
                'payment_id' => $id,
                'user_email' => $user->email,
                'payment_status' => $payment->status,
                'has_proof' => $payment->payment_proof ? true : false,
                'proof_file' => $payment->payment_proof,
                'proof_exists' => $payment->payment_proof_exists,
                'timestamp' => '2025-06-13 18:28:03'
            ]);

            return view('Member.Payment.detail', compact('payment', 'paymentSettings'));
            
        } catch (\Exception $e) {
            Log::error('Payment detail error - PATH FIX:', [
                'payment_id' => $id,
                'error' => $e->getMessage(),
                'user' => auth()->check() ? auth()->user()->email : 'guest',
                'timestamp' => '2025-06-13 18:28:03'
            ]);
            
            return redirect()->route('member.payment.status')->with('error', 'Payment not found.');
        }
    }

    /**
     * Upload payment proof - ENHANCED WITH BETTER PATH HANDLING
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

            Log::info('Payment proof upload started - PATH FIX', [
                'payment_id' => $id,
                'user' => auth()->user()->email,
                'timestamp' => '2025-06-13 18:28:03'
            ]);

            // ENHANCED VALIDATION
            $request->validate([
                'payment_proof' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120', // 5MB max
                'notes' => 'nullable|string|max:1000'
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
                
                // ENHANCED: Generate unique filename with timestamp
                $timestamp = now()->format('Ymd_His');
                $filename = "payment_proof_{$id}_{$timestamp}.{$file->getClientOriginalExtension()}";
                
                // PATH FIX: Use consistent path structure (payment/proofs/ to match existing)
                $uploadPath = 'payment/proofs';
                if (!Storage::disk('public')->exists($uploadPath)) {
                    Storage::disk('public')->makeDirectory($uploadPath);
                    Log::info('Created payment/proofs directory');
                }

                // ENHANCED: Store file with better error handling
                $storedPath = $file->storeAs($uploadPath, $filename, 'public');
                
                if (!$storedPath) {
                    throw new \Exception('Failed to store file to disk');
                }

                // Verify file was actually stored
                $verificationPaths = [
                    storage_path('app/public/' . $storedPath),
                    public_path('storage/' . $storedPath)
                ];
                
                $fileStored = false;
                foreach ($verificationPaths as $path) {
                    if (file_exists($path)) {
                        $fileStored = true;
                        Log::info('File verified at: ' . $path);
                        break;
                    }
                }

                if (!$fileStored) {
                    throw new \Exception('File upload verification failed - file not found after storage');
                }

                Log::info('File stored and verified successfully - PATH FIX', [
                    'stored_path' => $storedPath,
                    'filename' => $filename,
                    'file_size' => $file->getSize(),
                    'mime_type' => $file->getMimeType(),
                    'verification_passed' => $fileStored
                ]);

                // ENHANCED: Delete old payment proof if exists
                if ($payment->payment_proof) {
                    $this->deleteOldProof($payment->payment_proof);
                }

                // PATH FIX: Store with full path to maintain consistency
                $updateData = [
                    'payment_proof' => $storedPath, // Store full path: payment/proofs/filename.ext
                    'status' => 'uploaded',
                    'payment_date' => now()
                ];

                // Store notes in correct field
                if ($request->notes) {
                    $updateData['admin_notes'] = $request->notes;
                }

                $payment->update($updateData);

                // ENHANCED: Verify file exists after update
                $payment = $payment->fresh();
                $fileExists = $payment->payment_proof_exists;

                Log::info('Payment proof uploaded successfully - PATH FIX', [
                    'payment_id' => $payment->id,
                    'invoice_id' => $payment->invoice_id,
                    'user_email' => $user->email,
                    'filename' => $filename,
                    'stored_path' => $storedPath,
                    'file_size' => $file->getSize(),
                    'final_exists_check' => $fileExists,
                    'new_status' => $payment->status,
                    'url_generated' => $payment->payment_proof_url,
                    'timestamp' => '2025-06-13 18:28:03'
                ]);

                return response()->json([
                    'success' => true,
                    'message' => 'Payment proof uploaded successfully',
                    'data' => [
                        'payment_id' => $payment->id,
                        'filename' => $filename,
                        'url' => $payment->payment_proof_url,
                        'file_exists' => $fileExists,
                        'file_size' => $this->formatFileSize($file->getSize()),
                        'status' => $payment->status
                    ]
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => 'No file uploaded'
            ], 400);

        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::warning('Payment proof upload validation failed - PATH FIX', [
                'payment_id' => $id,
                'errors' => $e->errors(),
                'user' => auth()->user()->email
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);

        } catch (\Exception $e) {
            Log::error('Upload payment proof error - PATH FIX:', [
                'payment_id' => $id,
                'error' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
                'user' => auth()->check() ? auth()->user()->email : 'guest',
                'timestamp' => '2025-06-13 18:28:03'
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'Error uploading payment proof: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Payment instructions - ENHANCED
     */
    public function paymentInstructions($orderId = null)
    {
        try {
            $paymentSettings = PaymentSetting::where('status', 'active')->first();
            
            Log::info('Payment instructions accessed - PATH FIX', [
                'order_id' => $orderId,
                'user' => auth()->check() ? auth()->user()->email : 'guest',
                'has_settings' => $paymentSettings ? true : false,
                'timestamp' => '2025-06-13 18:28:03'
            ]);
            
            return view('Member.Payment.instructions', compact('paymentSettings', 'orderId'));
            
        } catch (\Exception $e) {
            Log::error('Payment instructions error - PATH FIX:', [
                'error' => $e->getMessage(),
                'order_id' => $orderId,
                'timestamp' => '2025-06-13 18:28:03'
            ]);
            
            return redirect()->route('portal')->with('error', 'Unable to load payment instructions.');
        }
    }

    /**
     * Create payment from order - ENHANCED
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
            
            // ENHANCED: Validate request data
            $request->validate([
                'amount' => 'required|numeric|min:0.01'
            ]);

            // ENHANCED: Generate unique invoice ID
            $invoiceId = 'INV-ORD-' . $orderId . '-' . time() . '-' . rand(1000, 9999);
            
            // Create payment status
            $payment = PaymentStatus::create([
                'invoice_id' => $invoiceId,
                'customer_name' => $user->name,
                'customer_email' => $user->email,
                'amount' => $request->amount,
                'payment_method' => $request->payment_method ?? 'qris',
                'status' => 'pending',
                'payment_date' => now(),
                'order_id' => $orderId
            ]);

            Log::info('Payment created from order - PATH FIX', [
                'payment_id' => $payment->id,
                'invoice_id' => $invoiceId,
                'order_id' => $orderId,
                'user_email' => $user->email,
                'amount' => $request->amount,
                'timestamp' => '2025-06-13 18:28:03'
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Payment created successfully',
                'data' => [
                    'payment_id' => $payment->id,
                    'invoice_id' => $invoiceId,
                    'amount' => $payment->amount,
                    'status' => $payment->status
                ]
            ]);

        } catch (\Exception $e) {
            Log::error('Create payment from order error - PATH FIX:', [
                'order_id' => $orderId,
                'error' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'user' => auth()->check() ? auth()->user()->email : 'guest',
                'timestamp' => '2025-06-13 18:28:03'
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'Error creating payment: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get payment settings with QR support - ENHANCED
     */
    public function getPaymentSettings()
    {
        try {
            $settings = PaymentSetting::where('status', 'active')->first();
            
            if (!$settings) {
                return response()->json([
                    'success' => false,
                    'message' => 'No active payment settings found',
                    'data' => null
                ], 404);
            }

            $qrImage = null;
            
            // Priority 1: File-based QR from QrisImage table
            $qrImageRecord = \App\Models\QrisImage::where('status', 'active')->first();
            if ($qrImageRecord && $qrImageRecord->image_path && file_exists(public_path('storage/' . $qrImageRecord->image_path))) {
                $qrImage = [
                    'id' => $qrImageRecord->id,
                    'name' => $qrImageRecord->name,
                    'image_path' => $qrImageRecord->image_path,
                    'full_url' => asset('storage/' . $qrImageRecord->image_path),
                    'source' => 'file'
                ];
            }
            // Priority 2: BLOB data from PaymentSetting
            elseif ($settings->qr_img) {
                $qrImage = [
                    'id' => $settings->id,
                    'name' => 'QR Payment (Database BLOB)',
                    'image_path' => null,
                    'full_url' => 'data:image/png;base64,' . base64_encode($settings->qr_img),
                    'source' => 'blob',
                    'blob_size' => strlen($settings->qr_img)
                ];
            }
            
            return response()->json([
                'success' => true,
                'data' => [
                    'bank_name' => $settings->bank_name,
                    'account_number' => $settings->account_number,
                    'account_name' => $settings->account_name,
                    'payment_instructions' => $settings->payment_instructions,
                    'qr_image' => $qrImage,
                    'status' => $settings->status
                ],
                'timestamp' => '2025-06-13 18:28:03'
            ]);

        } catch (\Exception $e) {
            Log::error('Get payment settings error - PATH FIX:', [
                'error' => $e->getMessage(),
                'timestamp' => '2025-06-13 18:28:03'
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Error retrieving payment settings: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Show payment proof image - FIXED FOR EXISTING PATH STRUCTURE
     */
    public function showPaymentProof($id)
    {
        try {
            $payment = PaymentStatus::findOrFail($id);
            
            // Check user permission
            if (auth()->check()) {
                $user = auth()->user();
                if ($payment->customer_email !== $user->email && $payment->customer_name !== $user->name) {
                    abort(403, 'Unauthorized access');
                }
            }
            
            if (!$payment->payment_proof) {
                abort(404, 'No payment proof found');
            }

            Log::info('Showing payment proof - PATH FIX', [
                'payment_id' => $id,
                'file' => $payment->payment_proof,
                'user' => auth()->user()->email ?? 'guest',
                'timestamp' => '2025-06-13 18:28:03'
            ]);

            // PATH FIX: Handle existing path structure
            if (strpos($payment->payment_proof, 'payment/proofs/') !== false) {
                // File already includes the full path
                $possiblePaths = [
                    storage_path('app/public/' . $payment->payment_proof),
                    public_path('storage/' . $payment->payment_proof),
                    storage_path('app/public/' . str_replace('payment/proofs/', 'payment_proofs/', $payment->payment_proof)),
                    public_path('storage/' . str_replace('payment/proofs/', 'payment_proofs/', $payment->payment_proof))
                ];
            } else {
                $possiblePaths = [
                    storage_path('app/public/payment_proofs/' . $payment->payment_proof),
                    storage_path('app/public/payment/proofs/' . $payment->payment_proof),
                    public_path('storage/payment_proofs/' . $payment->payment_proof),
                    public_path('storage/payment/proofs/' . $payment->payment_proof)
                ];
            }

            foreach ($possiblePaths as $path) {
                if (file_exists($path)) {
                    Log::info('Payment proof file found at - PATH FIX: ' . $path);
                    return response()->file($path);
                }
            }

            Log::error('Payment proof file not found in any location - PATH FIX', [
                'payment_id' => $id,
                'file' => $payment->payment_proof,
                'checked_paths' => $possiblePaths
            ]);

            abort(404, 'Payment proof file not found');

        } catch (\Exception $e) {
            Log::error('Show payment proof error - PATH FIX:', [
                'payment_id' => $id,
                'error' => $e->getMessage(),
                'timestamp' => '2025-06-13 18:28:03'
            ]);
            
            abort(404, 'Payment proof not accessible');
        }
    }

    // HELPER METHODS

    /**
     * Delete old payment proof file - ENHANCED WITH PATH FIX
     */
    private function deleteOldProof($filename)
    {
        try {
            // PATH FIX: Handle both old and new path structures
            if (strpos($filename, 'payment/proofs/') !== false) {
                $paths = [
                    $filename, // Full path already included
                    str_replace('payment/proofs/', 'payment_proofs/', $filename)
                ];
            } else {
                $paths = [
                    'payment_proofs/' . $filename,
                    'payment/proofs/' . $filename,
                    'payment_proofs/thumbnails/thumb_' . $filename
                ];
            }

            foreach ($paths as $path) {
                if (Storage::disk('public')->exists($path)) {
                    Storage::disk('public')->delete($path);
                    Log::info('Deleted old payment proof - PATH FIX: ' . $path);
                }
            }
        } catch (\Exception $e) {
            Log::warning('Failed to delete old payment proof - PATH FIX: ' . $e->getMessage());
        }
    }

    /**
     * Verify if uploaded file exists - ENHANCED WITH PATH FIX
     */
    private function verifyFileExists($filename)
    {
        $possiblePaths = [
            storage_path('app/public/payment_proofs/' . $filename),
            storage_path('app/public/payment/proofs/' . $filename),
            public_path('storage/payment_proofs/' . $filename),
            public_path('storage/payment/proofs/' . $filename)
        ];

        foreach ($possiblePaths as $path) {
            if (file_exists($path)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Get payment proof URL - ENHANCED WITH PATH FIX
     */
    private function getPaymentProofUrl($filename)
    {
        // Try multiple path structures
        $pathsToTry = [
            'payment_proofs/' . $filename,
            'payment/proofs/' . $filename
        ];

        foreach ($pathsToTry as $path) {
            if (Storage::disk('public')->exists($path)) {
                return Storage::disk('public')->url($path);
            }
        }
        
        // Fallback to asset URL
        return asset('storage/payment/proofs/' . $filename);
    }

    /**
     * Format file size for display
     */
    private function formatFileSize($bytes)
    {
        if ($bytes >= 1048576) {
            return round($bytes / 1048576, 2) . ' MB';
        } elseif ($bytes >= 1024) {
            return round($bytes / 1024, 2) . ' KB';
        }
        
        return $bytes . ' bytes';
    }
}