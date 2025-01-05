<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ContactController extends Controller
{
    // contact Form
    public function contactForm()
    {
        return view('users.home.contact');
    }

    // Contact Form Submit
    public function contactSubmit(Request $request)
    {
        // Validate contact form
        $request->validate([
            'title' => 'required|string|max:255',
            'message' => 'required|string|max:2000',
            'user_id' => 'required|exists:users,id',
        ]);

        $data = [
            'title' => $request->title,
            'message' => $request->message,
            'user_id' => $request->user_id
        ];

        // Store contact message
        Contact::create($data);

        Alert::success('Message Sent', 'Message Sent Successfully to Admin Team!');

        return to_route('userHome');
    }

    // contact list
    public function list()
    {
        $contacts = Contact::select(
            'contacts.id as contact_id',
            'users.name as user_name',
            'contacts.title',
            'contacts.message',
            'contacts.created_at'
        )
            ->leftJoin('users', 'contacts.user_id', 'users.id')
            ->orderBy('contacts.created_at', 'desc')
            ->paginate(10);
        return view('admins.contacts.list', compact('contacts'));
    }
}
