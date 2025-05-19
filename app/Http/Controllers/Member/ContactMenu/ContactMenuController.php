<?php

namespace App\Http\Controllers\Member\ContactMenu;

use App\Http\Controllers\Controller;
use App\Models\ContactMenu;
use Illuminate\Http\Request;

class ContactMenuController extends Controller
{
    public function index()
    {
        return view('Member.Contact.contact_menu');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string',
        ]);

        ContactMenu::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'subject' => $request->input('subject'),
            'message' => $request->input('message'),
        ]);

        return redirect()->route('contact_menu')->with('success', 'Your message has been sent successfully!');
    }
}
