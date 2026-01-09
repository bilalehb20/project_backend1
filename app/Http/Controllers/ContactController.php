<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact.index');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:5000',
        ]);

        $message = ContactMessage::create($validated);

        // Send email to admin
        try {
            Mail::raw("Nieuw contactbericht ontvangen:\n\nVan: {$message->name} ({$message->email})\nOnderwerp: {$message->subject}\n\nBericht:\n{$message->message}", function ($mail) use ($message) {
                $mail->to(config('mail.from.address'))
                    ->subject('Nieuw contactbericht: ' . $message->subject);
            });
        } catch (\Exception $e) {
            // Email sending failed, but message is saved
        }

        return redirect()->route('contact.index')->with('success', 'Uw bericht is verzonden! We nemen zo snel mogelijk contact met u op.');
    }
}
