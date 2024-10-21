<?php

namespace App\Http\Controllers\TruckDriver;

use App\Http\Controllers\Controller;
use App\Models\Solicitudes;
use App\Models\TruckDriver;

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

        $solicitudes = Solicitudes::where('truckdriver_id', auth()->user()->id)->get();
        $cantidadSolicitudes = $solicitudes->count();

        return view('truck_driver.dashboard')
            ->with('cantidadSolicitudes', $cantidadSolicitudes);
    }

    public function showPerfil()
    {

        return view('truck_driver.perfil');
    }

    public function quitarEmpresa($id)
    {
        $truck_driver = TruckDriver::findOrFail($id);
        $truck_driver->empresa = null;

        $truck_driver->save();

        return redirect('/truck_driver/dashboard');
    }
}
