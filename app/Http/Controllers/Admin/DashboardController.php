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
            'dia1' => 'required',
            'salida' => 'required|max:255',
            'dia2' => 'required',
            'llegada' => 'required|max:255',
            'TN' => 'required',
        ]);
        
        $viaje_inicial = new viajes();
        $viaje_inicial->fecha_salida = $request->get('dia1');
        $viaje_inicial->origen = $request->get('salida');
        $viaje_inicial->fecha_llegada = $request->get('dia2');
        $viaje_inicial->destino = $request->get('llegada');
        $viaje_inicial->TN = $request->get('TN');

        $viaje_inicial->save();

        return redirect("/admin/show");
    }

    /**
     * Almacena la nueva solicitud realizada a un chofer.
     */
    public function storeSolicitudes(Request $request)
    {

        // dd($request);

        $viaje = viajes::find($request->get('id_viaje'));
        $viaje->progresoSolicitud = 1;

        $solicitud = new Solicitudes();
        $solicitud->dia1 = $viaje->fecha_salida;
        $solicitud->salida = $viaje->origen;
        $solicitud->observacion1 = $request->get('observacion1');
        $solicitud->dia2 = $viaje->fecha_llegada;
        $solicitud->llegada = $viaje->destino;
        $solicitud->observacion2 = $request->get('observacion2');
        $solicitud->TN = $viaje->TN;
        $solicitud->truckdriver_id = $request->get('truckdriver_id');
        $solicitud->viaje_id = $request->get('id_viaje');

        $solicitud->save();
        $viaje->save();

        return redirect('/admin/show');
    }

    /**
     * Muestra los viajes en proceso de cada chofer.
     */
    public function showViajes()
    {
        $truck_drivers = TruckDriver::all();
        $Viajes = Viajes::with('combustibles')
                ->orderBy('fecha_salida','asc')
                ->get();

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
            ->orderBy('fecha_llegada', 'asc')
            ->get();

        return view('admin.planilla.showPlanilla')
            ->with('truck_driver', $truck_driver)
            ->with('viajes', $viajes);
    }
}
