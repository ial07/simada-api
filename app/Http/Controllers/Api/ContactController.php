<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ContactService;

class ContactController extends Controller
{
    protected ContactService $contactService;

    public function __construct(ContactService $contactService)
    {
        $this->contactService = $contactService;
    }

    public function send(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string|min:10|max:2000',
        ]);

        $success = $this->contactService->sendContactEmail(
            $validated['name'],
            $validated['email'],
            $validated['message']
        );

        if ($success) {
            return response()->json([
                'success' => true,
                'message' => 'Your message has been sent successfully.'
            ], 200);
        }

        return response()->json([
            'success' => false,
            'message' => 'Failed to send message. Please try again later.'
        ], 500);
    }
}
