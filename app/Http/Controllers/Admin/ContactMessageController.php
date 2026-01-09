<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\ContactReplyMail;
use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ContactMessageController extends Controller
{
    public function index()
    {
        $messages = ContactMessage::orderBy('created_at', 'desc')->paginate(15);
        return view('admin.contact-messages.index', compact('messages'));
    }

    public function show(ContactMessage $contactMessage)
    {
        // Mark as read
        if (!$contactMessage->read) {
            $contactMessage->update(['read' => true]);
        }
        
        return view('admin.contact-messages.show', compact('contactMessage'));
    }

    public function edit(ContactMessage $contactMessage)
    {
        return view('admin.contact-messages.edit', compact('contactMessage'));
    }

    public function update(Request $request, ContactMessage $contactMessage)
    {
        $validated = $request->validate([
            'read' => 'boolean',
            'reply' => 'nullable|string|max:5000',
        ]);

        $contactMessage->update($validated);

        return redirect()->route('admin.contact-messages.show', $contactMessage)->with('success', 'Bericht bijgewerkt!');
    }

    public function destroy(ContactMessage $contactMessage)
    {
        $contactMessage->delete();
        return redirect()->route('admin.contact-messages.index')->with('success', 'Bericht verwijderd!');
    }

    public function reply(Request $request, ContactMessage $contactMessage)
    {
        $validated = $request->validate([
            'reply' => 'required|string|max:5000',
        ], [
            'reply.required' => 'Het antwoordveld is verplicht.',
            'reply.max' => 'Het antwoord mag maximaal 5000 karakters bevatten.',
        ]);

        // Update contact message with reply and mark as read
        $contactMessage->update([
            'reply' => $validated['reply'],
            'read' => true,
        ]);

        // Log before sending email
        Log::info('Contact reply mail sending', [
            'to' => $contactMessage->email,
            'message_id' => $contactMessage->id,
            'subject' => $contactMessage->subject,
        ]);

        // Send reply email using Mailable
        try {
            Mail::to($contactMessage->email)
                ->send(new ContactReplyMail($contactMessage, $validated['reply']));
            
            Log::info('Contact reply email sent successfully', [
                'to' => $contactMessage->email,
                'message_id' => $contactMessage->id,
                'subject' => $contactMessage->subject,
            ]);

            return redirect()
                ->route('admin.contact-messages.show', $contactMessage)
                ->with('success', 'Antwoord succesvol verzonden naar ' . $contactMessage->email);
        } catch (\Exception $e) {
            // Log the error with full details
            Log::error('Failed to send contact reply email', [
                'to' => $contactMessage->email,
                'message_id' => $contactMessage->id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            // Return error message to admin
            return redirect()
                ->route('admin.contact-messages.show', $contactMessage)
                ->with('error', 'Antwoord opgeslagen, maar e-mail verzending mislukt. Controleer logs voor details.');
        }
    }
}
