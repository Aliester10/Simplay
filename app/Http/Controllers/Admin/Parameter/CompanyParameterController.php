<?php

namespace App\Http\Controllers\Admin\Parameter;

use App\Http\Controllers\Controller;
use App\Models\CompanyParameter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CompanyParameterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $companyParameters = CompanyParameter::all();
        return view('Admin.Parameter.index', compact('companyParameters'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Admin.Parameter.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_perusahaan' => 'required|string|max:255',
            'sejarah_singkat' => 'nullable|string',
            'email' => 'required|email',
            'no_telepon' => 'required|string',
            'no_wa' => 'required|string',
            'alamat' => 'required|string',
            'maps' => 'nullable|string',
            'website' => 'nullable|string',
            'visi' => 'nullable|string',
            'misi' => 'nullable|string',
            'logo' => 'nullable|image|max:2048',
            'about_gambar' => 'nullable|image|max:2048',
            'instagram' => 'nullable|string',
            'linkedin' => 'nullable|string',
            'ekatalog' => 'nullable|string',
        ]);

        if ($request->hasFile('logo')) {
            $validated['logo'] = $request->file('logo')->store('uploads/parameter', 'public');
        }

        if ($request->hasFile('about_gambar')) {
            $validated['about_gambar'] = $request->file('about_gambar')->store('uploads/about', 'public');
        }

        CompanyParameter::create($validated);

        return redirect()->route('parameter.index')->with('success', 'Company parameter created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $companyParameter = CompanyParameter::findOrFail($id);
        return view('Admin.Parameter.show', compact('companyParameter'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $companyParameter = CompanyParameter::findOrFail($id);
        return view('Admin.Parameter.edit', compact('companyParameter'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama_perusahaan' => 'required|string|max:255',
            'sejarah_singkat' => 'nullable|string',
            'email' => 'required|email',
            'no_telepon' => 'required|string',
            'no_wa' => 'required|string',
            'alamat' => 'required|string',
            'maps' => 'nullable|string',
            'website' => 'nullable|string',
            'visi' => 'nullable|string',
            'misi' => 'nullable|string',
            'logo' => 'nullable|image|max:2048',
            'about_gambar' => 'nullable|image|max:2048',
            'instagram' => 'nullable|string',
            'linkedin' => 'nullable|string',
            'ekatalog' => 'nullable|string',
        ]);
        // dd($validated);

        $companyParameter = CompanyParameter::findOrFail($id);

        // Handle logo file upload and removal
        if ($request->hasFile('logo')) {
            if ($companyParameter->logo) {
                Storage::delete('public/' . $companyParameter->logo);
            }
            $validated['logo'] = $request->file('logo')->store('uploads/parameter', 'public');
        }

        // Handle about_gambar file upload and removal
        if ($request->hasFile('about_gambar')) {
            if ($companyParameter->about_gambar) {
                Storage::delete('public/' . $companyParameter->about_gambar);
            }
            $validated['about_gambar'] = $request->file('about_gambar')->store('uploads/about', 'public');
        }

        $companyParameter->update($validated);

        return redirect()->route('parameter.index')->with('success', 'Company parameter updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $companyParameter = CompanyParameter::findOrFail($id);

        // Delete logo if exists
        if ($companyParameter->logo) {
            Storage::delete('public/' . $companyParameter->logo);
        }

        // Delete about_gambar if exists
        if ($companyParameter->about_gambar) {
            Storage::delete('public/' . $companyParameter->about_gambar);
        }

        $companyParameter->delete();

        return redirect()->route('parameter.index')->with('success', 'Company parameter deleted successfully.');
    }
}
