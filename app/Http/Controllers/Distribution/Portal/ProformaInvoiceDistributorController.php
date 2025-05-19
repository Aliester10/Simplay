<?php

namespace App\Http\Controllers\Distribution\Portal;

use App\Http\Controllers\Controller;
use App\Models\ProformaInvoice;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ProformaInvoiceDistributorController extends Controller
{
    public function show($id)
    {
        // Temukan Proforma Invoice berdasarkan ID
        $proformaInvoice = ProformaInvoice::with('purchaseOrder')->findOrFail($id);
        // Hitung persen DP
        if ($proformaInvoice->grand_total_include_ppn > 0) {
            $proformaInvoice->dp_percent = ($proformaInvoice->dp / $proformaInvoice->grand_total_include_ppn) * 100;
        } else {
            $proformaInvoice->dp_percent = 0;
        }

        // Kirim data ke view detail
        return view('Distributor.Portal.ProformaInvoice.show', compact('proformaInvoice'));
    }



    public function index(Request $request)
    {
        // Retrieve the search query from the request
        $search = $request->input('search');

        // Fetch Proforma Invoices related to the logged-in distributor
        $proformaInvoices = ProformaInvoice::whereHas('purchaseOrder', function ($query) {
            $query->where('user_id', Auth::id());
        })
            ->when($search, function ($query, $search) {
                return $query->where(function ($query) use ($search) {
                    $query->where('pi_number', 'like', "%$search%")
                        ->orWhereHas('purchaseOrder', function ($query) use ($search) {
                            $query->where('po_number', 'like', "%$search%")
                                ->orWhereHas('quotation', function ($query) use ($search) {
                                    $query->where('quotation_number', 'like', "%$search%");
                                });
                        });
                });
            })
            ->with('purchaseOrder')
            ->paginate(10); // Paginate with 10 invoices per page

        // Return view with proforma invoices and search query
        return view('Distributor.Portal.ProformaInvoice.index', compact('proformaInvoices', 'search'));
    }


    public function uploadPaymentProof(Request $request, $id)
    {
        $request->validate([
            'payment_proof' => 'required|file|mimes:pdf,jpg,jpeg,png|max:10048',
        ]);

        $proformaInvoice = ProformaInvoice::findOrFail($id);

        // Pastikan pembayaran terakhir sudah disetujui
        if ($proformaInvoice->payments_completed > 0 && $proformaInvoice->last_payment_status !== 'approved') {
            return redirect()->back()->with('error', 'Pembayaran sebelumnya belum disetujui oleh admin.');
        }

        // Proses file upload
        if ($request->hasFile('payment_proof')) {
            $file = $request->file('payment_proof');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = public_path('uploads/payment_proofs');

            if (!File::exists($filePath)) {
                File::makeDirectory($filePath, 0755, true);
            }

            $file->move($filePath, $fileName);

            // Tambahkan path file ke array payment_proof_paths
            $paymentProofPaths = $proformaInvoice->payment_proof_paths;
            $paymentProofPaths[] = 'uploads/payment_proofs/' . $fileName;

            $proformaInvoice->payment_proof_paths = $paymentProofPaths;
            $proformaInvoice->last_payment_status = 'pending';
            $proformaInvoice->save();

            return redirect()->route('distributor.proforma-invoices.index')->with('success', 'Bukti pembayaran berhasil diunggah, menunggu persetujuan admin.');
        }

        return redirect()->back()->with('error', 'Gagal mengunggah bukti pembayaran.');
    }





}
