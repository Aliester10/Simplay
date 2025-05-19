<?php

namespace App\Http\Controllers\Admin\MasterData;

use App\Http\Controllers\Controller;
use App\Models\BidangPerusahaan;
use Illuminate\Http\Request;

class BidangPerusahaanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bidangPerusahaans = BidangPerusahaan::all();
        return view('Admin.MasterData.bidang.index', compact('bidangPerusahaans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Admin.MasterData.bidang.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        BidangPerusahaan::create($request->all());

        return redirect()->route('bidangperusahaan.index')  // Perubahan di sini
            ->with('success', 'Bidang Perusahaan created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $bidang = BidangPerusahaan::findOrFail($id);

        return view('Admin.MasterData.bidang.show', compact('bidang'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $bidang = BidangPerusahaan::findOrFail($id);
        return view('Admin.MasterData.bidang.edit', compact('bidang'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $bidangPerusahaan = BidangPerusahaan::findOrFail($id);
        $bidangPerusahaan->update($request->all());

        return redirect()->route('Admin.MasterData.index')
            ->with('success', 'Bidang Perusahaan updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $bidangPerusahaan = BidangPerusahaan::findOrFail($id);
        $bidangPerusahaan->delete();

        return redirect()->route('bidangperusahaan.index')
            ->with('success', 'Bidang Perusahaan deleted successfully.');
    }

}
