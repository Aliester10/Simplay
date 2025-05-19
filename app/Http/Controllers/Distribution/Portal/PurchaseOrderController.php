<?php

namespace App\Http\Controllers\Distribution\Portal;

use App\Http\Controllers\Controller;
use App\Models\Quotation;
use App\Models\PurchaseOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PurchaseOrderController extends Controller
{
    public function index(Request $request)
    {
        // Ambil semua Purchase Orders yang dibuat oleh distributor yang sedang login
        $query = PurchaseOrder::where('user_id', auth()->id());

        // Jika ada input pencarian, filter berdasarkan nomor PO atau nama distributor
        if ($request->has('search') && $request->input('search') != '') {
            $searchTerm = $request->input('search');
            $query->where(function ($q) use ($searchTerm) {
                $q->where('po_number', 'like', '%' . $searchTerm . '%')
                    ->orWhereHas('user', function ($q) use ($searchTerm) {
                        $q->where('name', 'like', '%' . $searchTerm . '%');
                    });
            });
        }

        // Mengambil data dengan pagination
        $purchaseOrders = $query->paginate(10);

        return view('Distributor.Portal.PurchaseOrder.index', compact('purchaseOrders'));
    }

    public function create($quotationId)
    {
        // Ambil data quotation berdasarkan ID
        $quotation = Quotation::findOrFail($quotationId);

        return view('Distributor.Portal.PurchaseOrder.create', compact('quotation'));
    }

    // Menyimpan data PO ke database
    public function store(Request $request, $quotationId)
    {
        // Validasi input
        $request->validate([
            'po_number' => 'required|string|max:255', // Validasi agar po_number wajib diisi

            'file_path' => 'required|file|mimes:pdf,doc,docx|max:10048', // Validasi agar file wajib diisi
        ]);

        // Menentukan path file untuk disimpan di direktori public
        $filePath = null;
        if ($request->hasFile('file_path')) {
            $file = $request->file('file_path');

            // Buat nama file dengan waktu, nama asli, dan ekstensi
            $fileName = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();

            // Simpan file di direktori public/purchase_orders
            $file->move(public_path('purchase_orders'), $fileName);

            // Set path untuk disimpan di database
            $filePath = 'purchase_orders/' . $fileName;
        }

        // Buat PO
        PurchaseOrder::create([
            'quotation_id' => $quotationId,
            'user_id' => auth()->id(),
            'po_date' => now(), // Tanggal otomatis diisi dengan waktu saat ini
            'file_path' => $filePath,
            'po_number' => $request->input('po_number'), // Simpan po_number yang diisi oleh distributor

        ]);

        return redirect()->route('distributor.purchase-orders.index')->with('success', 'Purchase Order created successfully.');
    }
}
