<?php

namespace App\Http\Controllers\CustomUser\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Providers\RouteServiceProvider;

class EmailVerificationNotificationController extends Controller
{
    /**
     * Send a new email verification notification.
     */
    public function store(Request $request): RedirectResponse
    {
        if ($request->user('customUserAuth')->hasVerifiedEmail()) {
            return redirect()->intended(RouteServiceProvider::CUSTOM_USER_HOME);
        }

        $request->user('customUserAuth')->sendEmailVerificationNotification();

        return back()->with('status', 'verification-link-sent');
    }
}
