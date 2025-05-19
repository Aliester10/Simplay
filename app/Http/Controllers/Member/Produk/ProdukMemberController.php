<?php

namespace App\Http\Controllers\Member\Produk;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Quotation;


class ProdukMemberController extends Controller
{
    public function index($categoryId = null)
    {
        // Ambil semua kategori
        $kategori = Kategori::all();

        // Cek apakah ada kategori yang dipilih, jika iya, filter produk berdasarkan kategori tersebut
        if ($categoryId) {
            $produks = Produk::where('kategori_id', $categoryId)->paginate(9);
            $selectedCategory = Kategori::find($categoryId);
        } else {
            $produks = Produk::paginate(6);
            $selectedCategory = null;
        }

        return view('Member.Product.product', compact('produks', 'kategori', 'selectedCategory'));
    }


    public function search(Request $request)
    {
        $kategori = Kategori::all();
        $keyword = $request->keyword;

        // Ganti get() dengan paginate(9)
        $produks = Produk::where('nama', 'LIKE', '%' . $keyword . '%')->paginate(9);

        $selectedCategory = null;

        return view('Member.Product.product', compact('produks', 'kategori', 'selectedCategory'));
    }


    public function filterByCategory($id)
    {
        $kategori = Kategori::all();

        // Ganti get() dengan paginate(9)
        $produks = Produk::where('kategori_id', $id)->paginate(9);

        $selectedCategory = Kategori::find($id);

        return view('Member.Product.product', compact('produks', 'kategori', 'selectedCategory'));
    }



    public function show($id)
    {
        // Mengambil detail produk berdasarkan ID
        $produk = Produk::findOrFail($id);

        $produkSerupa = Produk::where('kategori_id', $produk->kategori_id)
            ->where('id', '!=', $id) // Exclude the current product
            ->take(4) // Limit to 4 similar products
            ->get();

        return view('Member.Product.detail', compact('produk', 'produkSerupa'));
    }
    public function addToQuotation(Request $request, $id)
{
    // Find the product by ID using the Produk model
    $produk = Produk::find($id);

    if (!$produk) {
        // Redirect back with an error message if the product doesn't exist
        return redirect()->back()->with('error', 'Produk tidak ditemukan.');
    }

    // Get the authenticated user
    $user = auth()->user();

    // Validate the quantity input with a default message if missing
    $request->validate([
        'quantity' => 'required|integer|min:1'
    ], [
        'quantity.required' => 'Kuantitas produk harus diisi.',
        'quantity.integer' => 'Kuantitas produk harus berupa angka.',
        'quantity.min' => 'Kuantitas produk minimal 1.'
    ]);

    // Get the quantity from the request, default to 1 if not provided
    $quantity = $request->input('quantity', 1);

    // Check if a quotation already exists for this user and product
    $existingQuotation = Quotation::where('user_id', $user->id)
        ->where('produk_id', $id)
        ->first();

    if ($existingQuotation) {
        // If the product is already in the quotation list, increment the quantity
        $existingQuotation->increment('quantity', $quantity);
    } else {
        // If no existing quotation, create a new one
        Quotation::create([
            'user_id' => $user->id,
            'produk_id' => $produk->id,
            'quantity' => $quantity,
            'status' => 'pending', // Set a default status for the quotation
        ]);
    }

    // Redirect to the request-quotation page with a success message
    return redirect()->route('distribution.request-quotation')->with('success', 'Produk berhasil ditambahkan ke permintaan quotation.');
}

    
    
}
