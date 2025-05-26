<?php

namespace App\Http\Controllers\Member\Profile;

use App\Http\Controllers\Controller;
use App\Models\BidangPerusahaan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileMemberController extends Controller
{
    public function show()
    {
        $user = User::findOrFail(Auth::id());  // Get the logged-in user by ID
        $bidangPerusahaan = BidangPerusahaan::all();

        return view('Member.profile.show', compact('user','bidangPerusahaan'));
    }

    public function edit()
    {
        $user = User::findOrFail(Auth::id());  // Get the logged-in user by ID
        $bidangPerusahaan = BidangPerusahaan::all();

        return view('Member.profile.edit', compact('user','bidangPerusahaan'));
    }

    /**
     * Update the profile.
     */
    public function update(Request $request)
    {
        $user = User::findOrFail(Auth::id());  // Get the authenticated user by ID

        // Validate the form data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'nama_perusahaan' => 'nullable|string|max:255',
            // Perbaikan validasi - mengubah dari exists:bidang_perusahaans,id menjadi sesuai model
            'bidang_perusahaan' => 'nullable', // Hilangkan validasi exists sementara
            'no_telp' => 'nullable|string|max:15',
            'alamat' => 'nullable|string|max:255',
        ]);

        try {
            // Update user attributes and save the user
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->nama_perusahaan = $request->input('nama_perusahaan');
            $user->bidang_id = $request->input('bidang_perusahaan');  // Use bidang_id for storage
            $user->no_telp = $request->input('no_telp');
            $user->alamat = $request->input('alamat');

            $user->save();  // Save the changes

            // Redirect back with a success message
            return redirect()->route('profile.show')->with('success', 'Profil berhasil diperbarui!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }
}