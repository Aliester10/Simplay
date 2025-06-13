<?php

namespace App\Http\Controllers\Admin\Payment;

use App\Http\Controllers\Controller;
use App\Models\PaymentStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PaymentStatusController extends Controller
{
    /**
     * Display a listing of payment statuses.
     */
    public function index(Request $request)
    {
        $query = PaymentStatus::query()->with('approvedBy');
        
        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        
        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('invoice_id', 'like', "%{$search}%")
                  ->orWhere('customer_name', 'like', "%{$search}%")
                  ->orWhere('customer_email', 'like', "%{$search}%");
            });
        }
        
        $payments = $query->orderBy('created_at', 'desc')->paginate(15);
        
        return view('Admin.Payment.status.index', compact('payments'));
    }

    /**
     * Display the specified payment status.
     */
    public function show($id)
    {
        $payment = PaymentStatus::with('approvedBy', 'order')->findOrFail($id);
        return view('Admin.Payment.status.show', compact('payment'));
    }

    /**
     * Show the form for editing the specified payment status.
     */
    public function edit($id)
    {
        $payment = PaymentStatus::findOrFail($id);
        return view('Admin.Payment.status.edit', compact('payment'));
    }

    /**
     * Update the specified payment status.
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,approved,rejected',
            'admin_notes' => 'nullable|string',
            'reject_reason' => 'required_if:status,rejected|string'
        ]);

        $payment = PaymentStatus::findOrFail($id);
        
        if ($request->status === 'approved') {
            $payment->approve(auth()->id(), $request->admin_notes);
        } elseif ($request->status === 'rejected') {
            $payment->reject(auth()->id(), $request->reject_reason, $request->admin_notes);
        } else {
            $payment->update([
                'status' => $request->status,
                'admin_notes' => $request->admin_notes
            ]);
        }

        return redirect()->route('Admin.Payment.status.index')
                        ->with('success', 'Status pembayaran berhasil diupdate.');
    }

    /**
     * Remove the specified payment from storage.
     */
    public function destroy($id)
    {
        try {
            $payment = PaymentStatus::findOrFail($id);
            
            // Delete payment proof file if exists
            if ($payment->payment_proof && Storage::disk('public')->exists($payment->payment_proof)) {
                Storage::disk('public')->delete($payment->payment_proof);
            }
            
            $payment->delete();

            return redirect()->route('Admin.Payment.status.index')
                            ->with('success', 'Data pembayaran berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()
                            ->with('error', 'Terjadi kesalahan saat menghapus data pembayaran.');
        }
    }
}