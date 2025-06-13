<?php
// app/Http/Controllers/Admin/Payment/PaymentStatusController.php - COMPLETE WITH EDIT METHODS

namespace App\Http\Controllers\Admin\Payment;

use App\Http\Controllers\Controller;
use App\Models\PaymentStatus;
use App\Models\PaymentSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class PaymentStatusController extends Controller
{
    /**
     * Display payment status list for admin
     */
    public function index()
    {
        try {
            $payments = PaymentStatus::with(['order', 'approvedBy'])
                ->orderBy('created_at', 'desc')
                ->paginate(15);

            Log::info('Admin payment status viewed', [
                'admin_user' => auth()->user()->email,
                'payments_count' => $payments->count(),
                'timestamp' => '2025-06-13 19:14:39'
            ]);

            return view('Admin.Payment.status.index', compact('payments'));
            
        } catch (\Exception $e) {
            Log::error('Admin payment status error:', [
                'error' => $e->getMessage(),
                'admin_user' => auth()->user()->email,
                'timestamp' => '2025-06-13 19:14:39'
            ]);
            
            return redirect()->route('dashboard')->with('error', 'Unable to load payment status.');
        }
    }

    /**
     * Show specific payment detail for admin
     */
    public function show($id)
    {
        try {
            $payment = PaymentStatus::with(['order', 'approvedBy'])
                ->findOrFail($id);

            Log::info('Admin payment detail viewed', [
                'payment_id' => $id,
                'admin_user' => auth()->user()->email,
                'payment_status' => $payment->status,
                'has_proof' => $payment->payment_proof ? true : false,
                'timestamp' => '2025-06-13 19:14:39'
            ]);

            return view('Admin.Payment.status.show', compact('payment'));
            
        } catch (\Exception $e) {
            Log::error('Admin payment detail error:', [
                'payment_id' => $id,
                'error' => $e->getMessage(),
                'admin_user' => auth()->user()->email,
                'timestamp' => '2025-06-13 19:14:39'
            ]);
            
            return redirect()->route('Admin.Payment.status.index')->with('error', 'Payment not found.');
        }
    }

    /**
     * 🔥 NEW: Show edit form for payment status
     */
    public function edit($id)
    {
        try {
            $payment = PaymentStatus::with(['order', 'approvedBy'])
                ->findOrFail($id);

            Log::info('Admin payment edit form viewed', [
                'payment_id' => $id,
                'admin_user' => auth()->user()->email,
                'current_status' => $payment->status,
                'timestamp' => '2025-06-13 19:14:39'
            ]);

            // Available status options
            $statusOptions = [
                'pending' => 'Pending',
                'uploaded' => 'Uploaded',
                'verified' => 'Verified', 
                'approved' => 'Approved',
                'rejected' => 'Rejected'
            ];

            return view('Admin.Payment.status.edit', compact('payment', 'statusOptions'));
            
        } catch (\Exception $e) {
            Log::error('Admin payment edit error:', [
                'payment_id' => $id,
                'error' => $e->getMessage(),
                'admin_user' => auth()->user()->email,
                'timestamp' => '2025-06-13 19:14:39'
            ]);
            
            return redirect()->route('Admin.Payment.status.index')->with('error', 'Payment not found for editing.');
        }
    }

    /**
     * Show payment proof image for admin
     */
    public function showProof($id)
    {
        try {
            $payment = PaymentStatus::findOrFail($id);
            
            if (!$payment->payment_proof) {
                Log::warning('Admin tried to access non-existent payment proof', [
                    'payment_id' => $id,
                    'admin_user' => auth()->user()->email,
                    'timestamp' => '2025-06-13 19:14:39'
                ]);
                abort(404, 'No payment proof found');
            }

            Log::info('Admin accessing payment proof', [
                'payment_id' => $id,
                'file' => $payment->payment_proof,
                'admin_user' => auth()->user()->email,
                'timestamp' => '2025-06-13 19:14:39'
            ]);

            // Handle existing path structure for admin
            if (strpos($payment->payment_proof, 'payment/proofs/') !== false) {
                // Full path already included
                $possiblePaths = [
                    storage_path('app/public/' . $payment->payment_proof),
                    public_path('storage/' . $payment->payment_proof),
                    storage_path('app/public/' . str_replace('payment/proofs/', 'payment_proofs/', $payment->payment_proof)),
                    public_path('storage/' . str_replace('payment/proofs/', 'payment_proofs/', $payment->payment_proof))
                ];
            } else {
                // Just filename
                $filename = basename($payment->payment_proof);
                $possiblePaths = [
                    storage_path('app/public/payment_proofs/' . $filename),
                    storage_path('app/public/payment/proofs/' . $filename),
                    public_path('storage/payment_proofs/' . $filename),
                    public_path('storage/payment/proofs/' . $filename),
                    storage_path('app/public/' . $payment->payment_proof),
                    public_path('storage/' . $payment->payment_proof)
                ];
            }

            // Try each possible path
            foreach ($possiblePaths as $path) {
                if (file_exists($path) && is_readable($path)) {
                    Log::info('Admin payment proof file found', [
                        'payment_id' => $id,
                        'path' => $path,
                        'file_size' => filesize($path),
                        'timestamp' => '2025-06-13 19:14:39'
                    ]);
                    
                    return response()->file($path);
                }
            }

            // If no file found, log detailed debug info
            Log::error('Admin payment proof file not found in any location', [
                'payment_id' => $id,
                'file' => $payment->payment_proof,
                'checked_paths' => $possiblePaths,
                'admin_user' => auth()->user()->email,
                'timestamp' => '2025-06-13 19:14:39'
            ]);

            abort(404, 'Payment proof file not found on server');

        } catch (\Exception $e) {
            Log::error('Admin show payment proof error:', [
                'payment_id' => $id,
                'error' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'admin_user' => auth()->user()->email,
                'timestamp' => '2025-06-13 19:14:39'
            ]);
            
            abort(404, 'Payment proof not accessible: ' . $e->getMessage());
        }
    }

    /**
     * Update payment status
     */
    public function updateStatus(Request $request, $id)
    {
        try {
            $request->validate([
                'status' => 'required|in:pending,uploaded,verified,approved,rejected',
                'admin_notes' => 'nullable|string|max:1000',
                'reject_reason' => 'nullable|string|max:500'
            ]);

            $payment = PaymentStatus::findOrFail($id);
            $oldStatus = $payment->status;
            
            $updateData = [
                'status' => $request->status,
                'admin_notes' => $request->admin_notes,
                'reject_reason' => $request->reject_reason
            ];

            // Set approval/rejection timestamps and user
            if ($request->status == 'approved') {
                $updateData['approved_by'] = auth()->id();
                $updateData['approved_at'] = now();
                $updateData['rejected_at'] = null;
            } elseif ($request->status == 'rejected') {
                $updateData['approved_by'] = null;
                $updateData['approved_at'] = null;
                $updateData['rejected_at'] = now();
            }

            $payment->update($updateData);

            Log::info('Admin updated payment status', [
                'payment_id' => $id,
                'old_status' => $oldStatus,
                'new_status' => $request->status,
                'admin_user' => auth()->user()->email,
                'admin_notes' => $request->admin_notes,
                'reject_reason' => $request->reject_reason,
                'timestamp' => '2025-06-13 19:14:39'
            ]);

            return redirect()->route('Admin.Payment.status.show', $id)
                ->with('success', 'Payment status updated successfully from ' . ucfirst($oldStatus) . ' to ' . ucfirst($request->status) . '.');
            
        } catch (\Exception $e) {
            Log::error('Admin update payment status error:', [
                'payment_id' => $id,
                'error' => $e->getMessage(),
                'admin_user' => auth()->user()->email,
                'timestamp' => '2025-06-13 19:14:39'
            ]);
            
            return redirect()->back()->with('error', 'Error updating payment status: ' . $e->getMessage());
        }
    }

    /**
     * Delete payment record
     */
    public function destroy($id)
    {
        try {
            $payment = PaymentStatus::findOrFail($id);
            $invoiceId = $payment->invoice_id;
            
            // Delete associated file if exists
            if ($payment->payment_proof) {
                $this->deletePaymentProofFile($payment->payment_proof);
            }
            
            $payment->delete();

            Log::info('Admin deleted payment record', [
                'payment_id' => $id,
                'invoice_id' => $invoiceId,
                'admin_user' => auth()->user()->email,
                'timestamp' => '2025-06-13 19:14:39'
            ]);

            return redirect()->route('Admin.Payment.status.index')
                ->with('success', 'Payment record ' . $invoiceId . ' deleted successfully.');
            
        } catch (\Exception $e) {
            Log::error('Admin delete payment error:', [
                'payment_id' => $id,
                'error' => $e->getMessage(),
                'admin_user' => auth()->user()->email,
                'timestamp' => '2025-06-13 19:14:39'
            ]);
            
            return redirect()->back()->with('error', 'Error deleting payment record: ' . $e->getMessage());
        }
    }

    /**
     * Download payment proof
     */
    public function downloadProof($id)
    {
        try {
            $payment = PaymentStatus::findOrFail($id);
            
            if (!$payment->payment_proof) {
                abort(404, 'No payment proof found');
            }

            $possiblePaths = [
                storage_path('app/public/' . $payment->payment_proof),
                storage_path('app/public/payment/proofs/' . basename($payment->payment_proof)),
                public_path('storage/' . $payment->payment_proof),
                public_path('storage/payment/proofs/' . basename($payment->payment_proof))
            ];

            foreach ($possiblePaths as $path) {
                if (file_exists($path)) {
                    $filename = 'payment_proof_' . $payment->invoice_id . '_' . basename($payment->payment_proof);
                    
                    Log::info('Admin downloading payment proof', [
                        'payment_id' => $id,
                        'file' => $payment->payment_proof,
                        'download_name' => $filename,
                        'admin_user' => auth()->user()->email,
                        'timestamp' => '2025-06-13 19:14:39'
                    ]);
                    
                    return response()->download($path, $filename);
                }
            }

            abort(404, 'Payment proof file not found for download');

        } catch (\Exception $e) {
            Log::error('Admin download payment proof error:', [
                'payment_id' => $id,
                'error' => $e->getMessage(),
                'timestamp' => '2025-06-13 19:14:39'
            ]);
            
            abort(404, 'Payment proof download failed');
        }
    }

    /**
     * Helper: Delete payment proof file
     */
    private function deletePaymentProofFile($filename)
    {
        try {
            $possiblePaths = [
                'payment_proofs/' . basename($filename),
                'payment/proofs/' . basename($filename),
                $filename // If full path is stored
            ];

            foreach ($possiblePaths as $path) {
                if (Storage::disk('public')->exists($path)) {
                    Storage::disk('public')->delete($path);
                    Log::info('Deleted payment proof file: ' . $path);
                }
            }
        } catch (\Exception $e) {
            Log::warning('Failed to delete payment proof file: ' . $e->getMessage());
        }
    }
}