<?php

namespace App\Http\Controllers\Admin\BrandPartner;

use App\Http\Controllers\Controller;
use App\Models\BrandPartner;
use App\Models\Principal;
use Illuminate\Http\Request;


class BrandPartnerController extends Controller
{
    public function index()
    {
        $brandPartners = BrandPartner::all();
        $principals = Principal::all();
        return view('Admin.Brand.index', compact('brandPartners', 'principals'));
    }

    public function create()
    {
        return view('Admin.Brand.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'gambar' => 'required|image|max:2048',
            'type' => 'required|in:brand,partner,principal',
            'url' => 'nullable|string',
            'nama' => 'nullable|string',
        ]);

        if ($request->hasFile('gambar')) {
            // Menyimpan gambar ke lokasi yang ditentukan
            $file = $request->file('gambar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('assets/img'), $filename); // Menyimpan di public/assets/img
            $validated['gambar'] = 'assets/img/' . $filename; // Simpan path di database
        }

        BrandPartner::create($validated);

        return redirect()->route('Admin.Brand.index')->with('success', 'Brand Partner created successfully.');
    }

    public function show($id)
    {
        $brandPartner = BrandPartner::findOrFail($id);
        return view('Admin.Brand.show', compact('brandPartner'));
    }

    public function edit($id)
    {
        $brandPartner = BrandPartner::findOrFail($id);
        return view('Admin.Brand.edit', compact('brandPartner'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'gambar' => 'nullable|image|max:2048',
            'type' => 'required|in:brand,partner,principal',
            'url' => 'nullable|string',
            'nama' => 'nullable|string',
        ]);

        $brandPartner = BrandPartner::findOrFail($id);

        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($brandPartner->gambar) {
                $oldImagePath = public_path($brandPartner->gambar); // Menggunakan public_path
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath); // Menghapus file lama
                }
            }

            // Menyimpan gambar baru ke lokasi yang ditentukan
            $file = $request->file('gambar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('assets/img'), $filename); // Menyimpan di public/assets/img
            $validated['gambar'] = 'assets/img/' . $filename; // Simpan path di database
        }

        $brandPartner->update($validated);

        return redirect()->route('Admin.Brand.index')->with('success', 'Brand Partner updated successfully.');
    }

    public function destroy($id)
    {
        $brandPartner = BrandPartner::findOrFail($id);

        if ($brandPartner->gambar) {
            $oldImagePath = public_path($brandPartner->gambar); // Menggunakan public_path
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath); // Hapus file gambar
            }
        }

        $brandPartner->delete();

        return redirect()->route('Admin.Brand.index')->with('success', 'Brand Partner deleted successfully.');
    }
}
