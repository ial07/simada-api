<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormSubmitted;

class ContactController extends Controller
{
    public function send(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email|max:255',
            'message' => 'required|string|min:10|max:2000',
        ]);

        try {
            // Strip tags for basic sanitization against email HTML injection
            $cleanMessage = strip_tags($validated['message']);
            
            $recipient = config('contact.email');
            
            Mail::to($recipient)->send(
                new ContactFormSubmitted($validated['email'], $cleanMessage)
            );

            return response()->json([
                'success' => true,
                'message' => 'Your message has been sent successfully.'
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to send message. Please try again later.'
            ], 500);
        }
    }
}
