<?php

namespace App\Http\Controllers;
use App\Models\Solicitudes;
use App\Models\TruckDriver;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\DatosSueldo;
use App\Models\Tabla1;
use App\Models\Tabla2;
use App\Models\Tabla3;

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
        $datos = DatosSueldo::find($id);
        $tabla1 = Tabla1::where('truckdriver_id', $id)->first();
        $tabla2 = Tabla2::where('truckdriver_id', $id)->first();
        $tabla3 = Tabla3::where('truckdriver_id', $id)->first();

        return view ('admin.sueldo.showCalculo')
            ->with('truck_driver',$truck_driver)
            ->with('datos',$datos)
            ->with('tabla1',$tabla1)
            ->with('tabla2',$tabla2)
            ->with('tabla3',$tabla3);
    }

    public function showDatos()
    {

        $datos = DatosSueldo::all();
        return view ('admin.sueldo.showDatos')
            ->with('datos', $datos);
    }
}
