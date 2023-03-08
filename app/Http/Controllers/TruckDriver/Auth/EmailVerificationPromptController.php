<?php

namespace App\Http\Controllers\TruckDriver\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EmailVerificationPromptController extends Controller
{
    /**
     * Display the email verification prompt.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    public function __invoke(Request $request)
    {
        return $request->user('truck_driver')->hasVerifiedEmail()
                    ? redirect()->intended(route('truck_driver.dashboard'))
                    : view('truck_driver.auth.verify-email');
    }
}
