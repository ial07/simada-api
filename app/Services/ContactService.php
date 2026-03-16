<?php

namespace App\Services;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Mail\ContactFormSubmitted;
use Exception;

class ContactService
{
    /**
     * Send a contact email safely.
     *
     * @param string $name
     * @param string $email
     * @param string $message
     * @return bool
     */
    public function sendContactEmail(string $name, string $email, string $message): bool
    {
        try {
            // Basic sanitization
            $cleanName = strip_tags($name);
            $cleanMessage = strip_tags($message);
            
            $recipient = config('contact.email', 'infosimadaindonesia@gmail.com');
            
            Mail::to($recipient)->send(
                new ContactFormSubmitted($cleanName, $email, $cleanMessage)
            );

            return true;
        } catch (Exception $e) {
            Log::error('SMTP Contact Form Failure: ' . $e->getMessage(), [
                'sender' => $email,
                'name' => $name
            ]);
            
            return false;
        }
    }
}
