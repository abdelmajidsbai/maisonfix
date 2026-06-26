<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
     // Show contact form
    public function show()
    {
        return view('contact');
    }

    // Handle form submission
   public function send(Request $request)
{
    // Validate
    $request->validate([
        'name'    => 'required|string|max:255',
        'email'   => 'required|email',
        'subject' => 'required|string|max:255',
        'message' => 'required|string',
    ]);

    // Send email using Mail::html()
    Mail::html(
        "<p><strong>Name:</strong> {$request->name}</p>
         <p><strong>Email:</strong> {$request->email}</p>
         <p><strong>Subject:</strong> {$request->subject}</p>
         <p><strong>Message:</strong><br>{$request->message}</p>",
        function ($message) use ($request) {
            $message->to('abdo@gmail.com')
                    ->subject($request->subject);
        }
    );

    return redirect()->back()->with('success', 'Message envoyé avec succès!');
}
}
