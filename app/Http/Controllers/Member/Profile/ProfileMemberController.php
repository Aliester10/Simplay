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

        // Ensure the user is a member (type 0)
        return view('Member.Profile.show', compact('user','bidangPerusahaan'));  // Pass the user data to the view
    }

    public function edit()
    {
        $user = User::findOrFail(Auth::id());  // Get the logged-in user by ID

        $bidangPerusahaan = BidangPerusahaan::all();

        // Ensure the user is a member (type 0)

        return view('Member.Profile.edit', compact('user','bidangPerusahaan'));  // Pass the user data to the view
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
        'bidang_perusahaan' => 'nullable|exists:bidang_perusahaan,id',
        'no_telp' => 'nullable|string|max:15',
        'alamat' => 'nullable|string|max:255',
    ]);

    // Update user attributes and save the user
    $user->name = $request->input('name');
    $user->email = $request->input('email');
    $user->nama_perusahaan = $request->input('nama_perusahaan');
    $user->bidang_id = $request->input('bidang_perusahaan');  // Use bidang_id instead of bidang_perusahaan
    $user->no_telp = $request->input('no_telp');
    $user->alamat = $request->input('alamat');

    $user->save();  // Save the changes

    // Redirect back with a success message
    return redirect()->route('profile.show')->with('success', 'Profile updated successfully.');
}

}
