<?php

namespace App\Http\Controllers\Admin;

use App\Exports\PlanillaExport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ViajeInicial;
use App\Models\TruckDriver;
use App\Models\Solicitudes;
use App\Models\viajes;
use App\Models\Combustible;
use App\Models\InputsEditables;
use Illuminate\Support\Facades\Log;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;
use \Carbon\Carbon;


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
            ->with('truck_drivers' . $truck_drivers)
            ->with('viajes_inicial', $viajes_inicial);
    }
    
    /**
     * Almacena el nuevo viaje inicial.
     */
    public function storeViajeInicial(Request $request)
    {
        $viaje_inicial = new Viajes();
        $input_editable = new InputsEditables();

        if ($request->filled('opcion_seleccionada')) {
            $viaje_inicial->origen = $request->get('opcion_seleccionada');
        } else {
            $input_editable->origen = $request->input('salida');
            $viaje_inicial->origen = $input_editable->origen;
        }

        if ($request->filled('opcion_seleccionada2')) {
            $viaje_inicial->destino = $request->get('opcion_seleccionada2');
        } else {
            $input_editable->destino = $request->input('destino');
            $viaje_inicial->destino = $input_editable->destino;
        }

        $viaje_inicial->fecha_salida = $request->get('dia1');
        $viaje_inicial->observacion_origen = $request->get('observacion1');
        $viaje_inicial->fecha_llegada = $request->get('dia2');
        $viaje_inicial->observacion_destino = $request->get('observacion2');
        $viaje_inicial->TN = $request->get('TN');

        $viaje_inicial->save();
        if ($input_editable->origen != null || $input_editable->destino)
            $input_editable->save();

        return redirect("/admin/show");
    }

    /**
     * Almacena la nueva solicitud realizada a un chofer.
     */
    public function storeSolicitudes(Request $request, $id)
    {

        $viaje = viajes::find($request->get('id_viaje'));

        $viaje->progresoSolicitud = 1;
        $viaje->truckdriver_id = $id;

        $solicitud = new Solicitudes();
        $solicitud->dia1 = $viaje->fecha_salida;
        $solicitud->salida = $viaje->origen;
        $solicitud->observacion1 = $viaje->observacion_origen;
        $solicitud->dia2 = $viaje->fecha_llegada;
        $solicitud->llegada = $viaje->destino;
        $solicitud->observacion2 = $viaje->observacion_destino;
        $solicitud->TN = $viaje->TN;
        $solicitud->truckdriver_id = $id;
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
        $Viajes = Viajes::with('combustibles')
            ->where('enCurso', true)
            ->orderBy('fecha_salida', 'asc')
            ->get();

        $choferesLibres = TruckDriver::doesntHave('viajes', 'and', function ($query) {
            $query->where('enCurso', true);
        })->get();

        $inputs_editables = InputsEditables::all();

        $fechaActual = Carbon::now();
        $fechaDosMesesAtras = $fechaActual->subMonths(2);
        Viajes::where('fecha_salida', '<', $fechaDosMesesAtras)->delete();

        return view('admin.viajes_asignados.showViajes')
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

        $viajesOrdenados = $viajes->sort(function ($a, $b) {
            $fechaA = \Carbon\Carbon::parse($a->fecha_llegada);
            $fechaB = \Carbon\Carbon::parse($b->fecha_llegada);
            $esVacioA = $a->esVacio;

            if ($fechaA->eq($fechaB)) {
                return $esVacioA ? -1 : 1;
            }

            return $fechaA->lt($fechaB) ? -1 : 1;
        });

        return view('admin.planilla.showPlanilla')
            ->with('truck_driver', $truck_driver)
            ->with('viajes', $viajesOrdenados);
    }

    public function exportPlanilla($id){

        return Excel::download(new PlanillaExport($id), 'planilla.xlsx');
    }


    public function updateViaje(Request $request)
    {

        $inputs_editables = InputsEditables::all();

        $viaje = viajes::find($request->get('id_viaje'));
        $key = $request->get('key');
        $nuevosCampos = [
            'origen' => $request->get('origen' . $key),
            'destino' => $request->get('destino' . $key),
        ];

        foreach ($nuevosCampos as $campo => $nuevoValor) {
            if (!$inputs_editables->contains($campo, $nuevoValor)) {
                $nuevoInputEditable = new InputsEditables([$campo => $nuevoValor]);
                $nuevoInputEditable->save();
            }
        }

        $viaje->origen = $nuevosCampos['origen'];
        $viaje->destino = $nuevosCampos['destino'];

        $convertirFecha = function ($input) {
            $fechaObjeto = \DateTime::createFromFormat('d/m/y', $input);
            return $fechaObjeto ? $fechaObjeto->format('Y-m-d') : null;
        };

        $fechaSalida = $convertirFecha($request->get('fecha_salida' . $key));
        $fechaLlegada = $convertirFecha($request->get('fecha_llegada' . $key));

        if ($fechaSalida !== null) {
            $viaje->fecha_salida = $fechaSalida;
        }
        if ($fechaLlegada !== null) {
            $viaje->fecha_llegada = $fechaLlegada;
        }

        $viaje->destino = $request->get('destino' . $key);

        $viaje->patente = $request->get('patente' . $key);
        $viaje->batea = $request->get('batea' . $key);

        $viaje->update();
        return redirect('/admin/show');
    }

    function convertirFecha($input)
    {
        $fechaObjeto = \DateTime::createFromFormat('d/m/y', $input);
        return $fechaObjeto ? $fechaObjeto->format('Y-m-d') : null;
    }

    public function cancelarViaje($id)
    {

        $viaje = viajes::find($id);
        $viaje->delete();

        return redirect('/admin/show');
    }
}
