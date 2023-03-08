<?php

namespace App\Http\Controllers\TruckDriver\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated truck_driver's email address as verified.
     *
     * @param  \Illuminate\Foundation\Auth\EmailVerificationRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(EmailVerificationRequest $request)
    {
        if ($request->user('truck_driver')->hasVerifiedEmail()) {
            return redirect()->intended(route('truck_driver.dashboard').'?verified=1');
        }

        if ($request->user('truck_driver')->markEmailAsVerified()) {
            event(new Verified($request->user('truck_driver')));
        }

        return redirect()->intended(route('truck_driver.dashboard').'?verified=1');
    }
}
