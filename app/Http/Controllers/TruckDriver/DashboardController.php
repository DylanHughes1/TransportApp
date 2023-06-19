<?php

namespace App\Http\Controllers\TruckDriver;

use App\Http\Controllers\Controller;
use App\Models\viajes;

class DashboardController extends Controller
{
    public function __construct()
    {
        /*
         * Uncomment the line below if you want to use verified middleware
         */
        //$this->middleware('verified:truck_driver.verification.notice');
    }

    /**
     * Muestra el inicio del chofer.
     */
    public function index()
    {

        return view('truck_driver.dashboard');
    }
}
