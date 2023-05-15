<?php

namespace App\Http\Controllers;
use App\Models\Solicitudes;
use App\Models\TruckDriver;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\DatosSueldo;

class SueldoController extends Controller
{
    public function index()
    {

        return view ('admin.sueldo.index');
    }

    public function indexCalcular()
    {
        $truck_drivers = TruckDriver::all();

        return view ('admin.sueldo.indexCalculo')
            ->with('truck_drivers',$truck_drivers);
    }

    public function showCalcular($id)
    {
        $truck_driver = TruckDriver::find($id);

        return view ('admin.sueldo.showCalculo')
            ->with('truck_driver',$truck_driver);
    }

    public function showDatos()
    {

        $datos = DatosSueldo::all();
        return view ('admin.sueldo.showDatos')
            ->with('datos', $datos);
    }
}
