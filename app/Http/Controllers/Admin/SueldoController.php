<?php

namespace App\Http\Controllers\Admin;

use App\Models\TruckDriver;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DatosSueldo;
use App\Models\Tabla1;
use App\Models\Tabla2;
use App\Models\Tabla3;

class SueldoController extends Controller
{
    /**
     * Muestra las opciones del sueldo.
     */
    public function index()
    {
        return view('admin.sueldo.index');
    }

    /**
     * Muestra los choferes disponibles para calcular el sueldo.
     */
    public function indexCalcularSueldo()
    {
        $truck_drivers = TruckDriver::all();

        return view('admin.sueldo.indexCalcularSueldo')
            ->with('truck_drivers', $truck_drivers);
    }

    /**
     * Muestra la tabla del sueldo del chofer seleccionado.
     */
    public function showCalcularSueldo($id)
    {
        $truck_driver = TruckDriver::find($id);
        $datos = DatosSueldo::find($id);
        $tabla1 = Tabla1::where('truckdriver_id', $id)->first();
        $tabla2 = Tabla2::where('truckdriver_id', $id)->first();
        $tabla3 = Tabla3::where('truckdriver_id', $id)->first();

        return view('admin.sueldo.showCalcularSueldo')
            ->with('truck_driver', $truck_driver)
            ->with('datos', $datos)
            ->with('tabla1', $tabla1)
            ->with('tabla2', $tabla2)
            ->with('tabla3', $tabla3);
    }

    /**
     * Muestra la tabla con los datos base para el sueldo.
     */
    public function showDatosBasicos()
    {

        $datos = DatosSueldo::all();
        return view('admin.sueldo.showDatosBasicos')
            ->with('datos', $datos);
    }

    /**
     * Actualiza los datos de la tabla del sueldo de un chofer seleccionado.
     */
    public function updateDatos(Request $request, $id)
    {

        $tabla1 = Tabla1::where('truckdriver_id', $id)->first();
        $tabla1->hs_ext_km_recorrido = $request->input('hs_ext_km_recorrido');
        $tabla1->hs_ext_km_recorrido_100 = $request->input('hs_ext_km_recorrido_100');
        $tabla1->c_descarga = $request->input('c_descarga');
        $tabla1->hs_50 = $request->input('hs_50');
        $tabla1->hs_100 = $request->input('hs_100');
        $tabla1->inasistencias_inj = $request->input('inasistencias_inj');

        $tabla1->total_remun1 = $request->input('totalR');


        $tabla1->update();

        return redirect("/admin/sueldo/calcular/$id")->with('status', 'Cambios Guardados');
    }
}
