<?php

namespace App\Http\Controllers\CustomUser\Auth;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Providers\RouteServiceProvider;

class EmailVerificationPromptController extends Controller
{
    /**
     * Display the email verification prompt.
     */
    public function __invoke(Request $request): RedirectResponse|View
    {
        return $request->user('customUserAuth')->hasVerifiedEmail()
            ? redirect()->intended(RouteServiceProvider::CUSTOM_USER_HOME)
            : view('custom-auth.auth.verify-email');
    }
}
