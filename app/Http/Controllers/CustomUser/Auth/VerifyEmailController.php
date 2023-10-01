<?php

namespace App\Http\Controllers\CustomUser\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\RedirectResponse;
use App\Providers\RouteServiceProvider;
use App\Http\Requests\CustomUser\Auth\EmailVerificationRequest;

class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */
    public function __invoke(EmailVerificationRequest $request): RedirectResponse
    {
        if ($request->user('customUserAuth')->hasVerifiedEmail()) {
            return redirect()->intended(RouteServiceProvider::CUSTOM_USER_HOME . '?verified=1');
        }

        if ($request->user('customUserAuth')->markEmailAsVerified()) {
            event(new Verified($request->user('customUserAuth')));
        }

        return redirect()->intended(RouteServiceProvider::CUSTOM_USER_HOME . '?verified=1');
    }
}
