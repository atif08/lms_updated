<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\BaseController;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Inertia\Inertia;
use Inertia\Response;

class ForgotPasswordController extends BaseController
{
    use SendsPasswordResetEmails;

    public function showLinkRequestForm(): Response
    {
        return Inertia::render('Auth/ForgotPassword', [
            'status' => session('status'),
        ]);
    }
}
