<?php

namespace App\Frontend;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactFormController extends BaseController {
    public function __invoke(Request $request)
    {
        $data = $request->validate([
            'firstname' => 'required|string|min:3',
            'email' => 'required|email',
            'phone' => 'required|string',
            'country_of_residence' => 'required|string',
            'program_type' => 'required|string',
            'course_title' => 'required|string',
        ]);

        // Send email to admin
        Mail::send('emails.contact-form', $data, function ($message) {
            $message->to('rajitha@astidubai.ac.ae')
                ->subject('New Course Inquiry');
        });

        return response()->json([
            'success' => true,
            'message' => 'Thank you! We will contact you soon.'
        ]);
    }
}
