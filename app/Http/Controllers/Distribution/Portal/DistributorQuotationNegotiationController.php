<?php

namespace App\Http\Controllers\Distribution\Portal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Quotation;
use App\Models\QuotationNegotiation;
use Illuminate\Support\Facades\Auth;

class DistributorQuotationNegotiationController extends Controller
{
    // Menampilkan daftar negosiasi untuk distributor yang sedang login
    public function index(Request $request)
{
    $userId = Auth::id();

    $search = $request->input('search');

    $negotiations = QuotationNegotiation::whereHas('quotation', function($query) use ($userId) {
        $query->where('user_id', $userId);
    })
    ->with('quotation')
    ->when($search, function($query) use ($search) {
        return $query->whereHas('quotation', function($query) use ($search) {
            $query->where('quotation_number', 'like', '%' . $search . '%');
        });
    })
    ->paginate(10); // Paginate 10 per page

    // Mengirim data negosiasi ke tampilan
    return view('Distributor.Portal.Negotiations.index', compact('negotiations'));
}



    // Menampilkan form untuk negosiasi
    public function create($quotationId)
    {
        $quotation = Quotation::findOrFail($quotationId);
        return view('Distributor.Portal.Negotiations.create', compact('quotation'));
    }

    // Menyimpan negosiasi baru
    public function store(Request $request, $quotationId)
    {
        $quotation = Quotation::findOrFail($quotationId);

        // Validasi input
        $request->validate([
            'notes' => 'nullable|string',
        ]);

        // Cari negosiasi berdasarkan quotation_id
        $negotiation = QuotationNegotiation::where('quotation_id', $quotation->id)->first();

        if ($negotiation) {
            // Tentukan status berdasarkan keberadaan admin_notes
            $status = $negotiation->admin_notes ? 'in_progress' : 'pending';

            // Perbarui negosiasi yang ada
            $negotiation->update([
                'status' => $status, // Tetapkan status sesuai kondisi
                'notes' => $request->input('notes'), // Perbarui catatan distributor
            ]);
        } else {
            // Buat negosiasi baru jika belum ada
            QuotationNegotiation::create([
                'quotation_id' => $quotation->id,
                'status' => 'pending', // Status default
                'notes' => $request->input('notes'),
            ]);
        }

        return redirect()->route('distributor.quotations.negotiations.index')
            ->with('success', 'Negotiation submitted successfully.');
    }


}