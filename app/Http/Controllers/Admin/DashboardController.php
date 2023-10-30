<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ViajeInicial;
use App\Models\TruckDriver;
use App\Models\Solicitudes;
use App\Models\viajes;
use App\Models\Combustible;
use App\Models\InputsEditables;
use Illuminate\Support\Facades\Log;


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
        $viaje_inicial = new Viajes();
        // $input_editable = InputsEditables::firstOrNew();
        $input_editable = new InputsEditables();

        if ($request->filled('opcion_seleccionada')) {
            $viaje_inicial->origen = $request->get('opcion_seleccionada');
        } else{
            $input_editable->origen = $request->input('salida');
            $viaje_inicial->origen = $input_editable->origen;
        }

        if ($request->filled('opcion_seleccionada2')) {
            $viaje_inicial->destino = $request->get('opcion_seleccionada2');
        } else{
            $input_editable->destino = $request->input('destino');
            $viaje_inicial->destino = $input_editable->destino;
        }

        $viaje_inicial->fecha_salida = $request->get('dia1');
        $viaje_inicial->fecha_llegada = $request->get('dia2');
        $viaje_inicial->TN = $request->get('TN');

        $viaje_inicial->save();
        if($input_editable->origen != null || $input_editable->destino) 
            $input_editable->save();

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

        $choferesLibres = TruckDriver::doesntHave('viajes', 'and', function ($query) {
            $query->where('enCurso', true);
        })->get();

        $inputs_editables = InputsEditables::all();

        return view('admin.viajes_asignados.showViajes')
            ->with('truck_drivers', $truck_drivers)
            ->with('viajes', $Viajes)
            ->with('choferesLibres', $choferesLibres)
            ->with('inputs_editables', $inputs_editables);
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
