<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ViajeInicial;
use App\Models\TruckDriver;
use App\Models\Solicitudes;
use App\Models\viajes;
use App\Models\Combustible;


class DashboardController extends Controller
{
    protected $registro_combustible_id;
    public function __construct()
    {
        /*
         * Uncomment the line below if you want to use verified middleware
         */
        //$this->middleware('verified:admin.verification.notice');
    }

    /**
     * Muestra el inicio del admin.
     */
    public function index()
    {
        return view('admin.dashboard');
    }

    /**
     * Muestra el formulario para crear un nuevo viaje.
     */
    public function createViajeInicial()
    {
        return view('admin.nuevos_viajes.create');
    }

    /**
     * Muestra los choferes y viajes para asignar una nueva solicitud
     */
    public function createSolicitudes()
    {
        $truck_drivers = TruckDriver::all();
        $viajes_inicial = ViajeInicial::all();

        return view('admin.nuevos_viajes.create2')
            ->with('truck_drivers', $truck_drivers)
            ->with('viajes_inicial', $viajes_inicial);
    }

    /**
     * Obtiene la informacion del viaje inicial a asignar mediante la llamada ajax.
     */
    public function getInfoViajeInicial($id)
    {
        $viaje_inicial = ViajeInicial::find($id);

        if ($viaje_inicial) {
            return response()->json([
                'success' => true,
                'data' => $viaje_inicial
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'El viaje no fue encontrado.'
            ], 404);
        }
    }

    /**
     * Almacena el nuevo viaje inicial.
     */
    public function storeViajeInicial(Request $request)
    {
        $request->validate([
            'dia1' => 'required|date',
            'salida' => 'required|max:255',
            'dia2' => 'required|date',
            'llegada' => 'required|max:255',
            'TN' => 'required|integer',
        ]);

        $viaje_inicial = new ViajeInicial();
        $viaje_inicial->dia1 = $request->get('dia1');
        $viaje_inicial->salida = $request->get('salida');
        $viaje_inicial->dia2 = $request->get('dia2');
        $viaje_inicial->llegada = $request->get('llegada');
        $viaje_inicial->TN = $request->get('TN');

        $viaje_inicial->save();

        return redirect("/admin/dashboard");
    }

    /**
     * Almacena la nueva solicitud realizada a un chofer.
     */
    public function storeSolicitudes(Request $request)
    {

        $request->validate([
            'dia1' => 'required|date',
            'observacion1' => 'nullable',
            'salida' => 'required|max:255',
            'dia2' => 'required|date',
            'llegada' => 'required|max:255',
            'observacion2' => 'nullable',
            'id_viaje' => 'nullable'
        ]);

        $viaje_inicial = ViajeInicial::find($request->get('id_viaje'));

        $solicitud = new Solicitudes();
        $solicitud->dia1 = $request->get('dia1');
        $solicitud->salida = $request->get('salida');
        $solicitud->observacion1 = $request->get('observacion1');
        $solicitud->dia2 = $request->get('dia2');
        $solicitud->llegada = $request->get('llegada');
        $solicitud->observacion2 = $request->get('observacion2');
        $solicitud->TN = $request->get('TN');
        $solicitud->truckdriver_id = $request->get('truck_driver_id');

        $solicitud->save();
        $viaje_inicial->delete();

        return redirect('/admin/dashboard');
    }

    /**
     * Muestra los viajes en proceso de cada chofer.
     */
    public function showViajes()
    {
        $truck_drivers = TruckDriver::all();
        $Viajes = Viajes::with('combustibles')->get();

        return view('admin.viajes_asignados.showViajes')
            ->with('truck_drivers', $truck_drivers)
            ->with('viajes', $Viajes);
    }

    /**
     * Muestra los choferes disponibles para ver su planilla.
     */
    public function indexPlanilla()
    {
        $truck_drivers = TruckDriver::all();

        return view('admin.planilla.indexPlanilla')
            ->with('truck_drivers', $truck_drivers);
    }

    /**
     * Muestra la planilla del chofer seleccionado.
     */
    public function showPlanilla($id)
    {

        $truck_driver = TruckDriver::find($id);

        $viajes = Viajes::where('truckdriver_id', $id)
            ->where('enCurso', false)
            ->with('combustibles')
            ->get();

        return view('admin.planilla.showPlanilla')
            ->with('truck_driver', $truck_driver)
            ->with('viajes', $viajes);
    }
}
