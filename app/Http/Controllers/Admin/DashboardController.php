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

        $choferes = TruckDriver::all();

        $choferesLibres = TruckDriver::doesntHave('viajes', 'and', function ($query) {
            $query->where('enCurso', true);
        })->get();

        $inputs_editables = InputsEditables::all();

        $primerDiaHaceDosMeses = Carbon::now()->subMonths(2)->startOfMonth();
        $ultimoDiaHaceDosMeses = Carbon::now()->subMonths(2)->endOfMonth();
        Viajes::whereBetween('fecha_salida', [$primerDiaHaceDosMeses, $ultimoDiaHaceDosMeses])->delete();

        return view('admin.viajes_asignados.showViajes')
            ->with('viajes', $Viajes)
            ->with('choferes', $choferes)
            ->with('choferesLibres', $choferesLibres)
            ->with('inputs_editables', $inputs_editables);
    }

    /**
     * Muestra los choferes disponibles para ver su planilla.
     */
    public function indexPlanilla()
    {
        $truck_drivers = TruckDriver::orderBy('name')->get();

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
            ->orderBy('fecha_salida', 'asc')
            ->get();

        $viajesOrdenados = $viajes->sort(function ($a, $b) {
            $fechaA = Carbon::parse($a->fecha_salida);
            $fechaB = Carbon::parse($b->fecha_salida);
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

    /**
     * Muestra la planilla mensual del chofer seleccionado.
     */

    public function showPlanillaMensual($id)
    {
        $truck_driver = TruckDriver::find($id);

        $firstDayOfCurrentMonth = Carbon::now()->startOfMonth();
        $firstDayOfPreviousMonth = Carbon::now()->subMonth()->startOfMonth();
        $lastDayOfPreviousMonth = Carbon::now()->subMonth()->endOfMonth();

        $viajesEsteMes = Viajes::where('truckdriver_id', $id)
            ->where('enCurso', false)
            ->with('combustibles')
            ->where('fecha_salida', '>=', $firstDayOfCurrentMonth)
            ->orderBy('fecha_salida', 'asc')
            ->get();

        $viajesMesAnterior = Viajes::where('truckdriver_id', $id)
            ->where('enCurso', false)
            ->with('combustibles')
            ->where('fecha_salida', '>=', $firstDayOfPreviousMonth)
            ->where('fecha_salida', '<=', $lastDayOfPreviousMonth)
            ->orderBy('fecha_salida', 'asc')
            ->get();

        $kms_MesEsteMes = $viajesEsteMes->sum('km_viaje');
        $costo_totalEsteMes = $this->obtenerFacturadoMes($viajesEsteMes);
        $kms_promedio_cargadoEsteMes = $this->obtenerPromedioKMCargado($viajesEsteMes);
        $kms_total_cargadoEsteMes = $this->obtenerTotalKMCargado($viajesEsteMes);
        $porcentaje_cargadoEsteMes = $this->obtenerPorcentajeCargado($viajesEsteMes);

        $kms_MesMesAnterior = $viajesMesAnterior->sum('km_viaje');
        $costo_totalMesAnterior = $this->obtenerFacturadoMes($viajesMesAnterior);
        $kms_promedio_cargadoMesAnterior = $this->obtenerPromedioKMCargado($viajesMesAnterior);
        $kms_total_cargadoMesAnterior = $this->obtenerTotalKMCargado($viajesMesAnterior);
        $porcentaje_cargadoMesAnterior = $this->obtenerPorcentajeCargado($viajesMesAnterior);

        return view('admin.planilla.showPlanillaMensual')
            ->with('truck_driver', $truck_driver)
            ->with('kms_MesEsteMes', $kms_MesEsteMes)
            ->with('costo_totalEsteMes', $costo_totalEsteMes)
            ->with('kms_promedio_cargadoEsteMes', $kms_promedio_cargadoEsteMes)
            ->with('kms_total_cargadoEsteMes', $kms_total_cargadoEsteMes)
            ->with('porcentaje_cargadoEsteMes', $porcentaje_cargadoEsteMes)

            ->with('kms_MesMesAnterior', $kms_MesMesAnterior)
            ->with('costo_totalMesAnterior', $costo_totalMesAnterior)
            ->with('kms_promedio_cargadoMesAnterior', $kms_promedio_cargadoMesAnterior)
            ->with('kms_total_cargadoMesAnterior', $kms_total_cargadoMesAnterior)
            ->with('porcentaje_cargadoMesAnterior', $porcentaje_cargadoMesAnterior);

    }

    function obtenerFacturadoMes($viajes)
    {
        $costo_total = 0;
        foreach ($viajes as $viaje) {
            $costo_viaje = ($viaje->carga_kg / 1000) * $viaje->TN;
            $costo_total += $costo_viaje;
        }
        return $costo_total;
    }
    function obtenerPromedioKMCargado($viajes)
    {
        $kms_totales = 0;
        $num_viajes = 0 ;

        foreach ($viajes as $viaje) {
            if(!$viaje->esVacio){
                $carga_en_toneladas = $viaje->carga_kg / 1000;
                $costo_por_tonelada = $viaje->TN;
                $distancia_viaje = max(1, $viaje->km_llegada - $viaje->km_salida);

                $costo_por_km = ($carga_en_toneladas * $costo_por_tonelada) / $distancia_viaje;

                $kms_totales += $costo_por_km;
                $num_viajes += 1;
            }
        }

        if ($num_viajes > 0) {
            $promedio_kms_cargado = $kms_totales / $num_viajes;
        } else {
            $promedio_kms_cargado = 0; 
        }

        return number_format($promedio_kms_cargado, 2);
    }

    function obtenerTotalKMCargado($viajes)
    {
        $kms_totales = 0;

        foreach ($viajes as $viaje) {
            if(!$viaje->esVacio){
                $carga_en_toneladas = $viaje->carga_kg / 1000;
                $costo_por_tonelada = $viaje->TN;
                $distancia_viaje = max(1, ($viaje->km_llegada - $viaje->km_salida) + $viaje->km_viaje_vacio);

                $costo_por_km = ($carga_en_toneladas * $costo_por_tonelada) / $distancia_viaje;

                $kms_totales += $costo_por_km;

            }
        }

        $num_viajes = count($viajes);
        if ($num_viajes > 0) {
            $promedio_kms_cargado = $kms_totales / $num_viajes;
        } else {
            $promedio_kms_cargado = 0; 
        }

        return number_format($promedio_kms_cargado, 2);
    }
    function obtenerPorcentajeCargado($viajes){

        $distancia_viaje_total = 0;
        $distancia_viaje_cargado = 0;

        foreach ($viajes as $viaje) {
            if(!$viaje->esVacio){
                $distancia_viaje_total += max(1, ($viaje->km_llegada - $viaje->km_salida) + $viaje->km_viaje_vacio);
                $distancia_viaje_cargado += max(1, ($viaje->km_llegada - $viaje->km_salida));    
            }
            return (int)(($distancia_viaje_cargado/$distancia_viaje_total)*100);
        }

    }

    /**
     * Muestra la planilla de Empresa
    */
    public function showPlanillaEmpresa()
    {
        
        $firstDayOfCurrentMonth = Carbon::now()->startOfMonth();
        $firstDayOfPreviousMonth = Carbon::now()->subMonth()->startOfMonth();
        $lastDayOfPreviousMonth = Carbon::now()->subMonth()->endOfMonth();

        $choferesEmpresaA = TruckDriver::where('empresa', 'A')->pluck('id');
        $viajesEmpresaA = viajes::whereIn('truckdriver_id', $choferesEmpresaA)
            ->where('enCurso', false)
            ->with('combustibles')
            ->where('fecha_salida', '>=', $firstDayOfCurrentMonth)
            ->orderBy('fecha_salida', 'asc')
            ->get();

        $choferesEmpresaB = TruckDriver::where('empresa', 'B')->pluck('id');
        $viajesEmpresaB = viajes::whereIn('truckdriver_id', $choferesEmpresaB)
            ->where('enCurso', false)
            ->with('combustibles')
            ->where('fecha_salida', '>=', $firstDayOfCurrentMonth)
            ->orderBy('fecha_salida', 'asc')
            ->get();

        $kms_MesDonMario = $viajesEmpresaA->sum('km_viaje');
        $facturado_MesDonMario = $this->obtenerFacturadoMes($viajesEmpresaA);
        $kms_promedio_cargadoDonMario = $this->obtenerPromedioKMCargado($viajesEmpresaA);
        $kms_total_cargadoDonMario = $this->obtenerTotalKMCargado($viajesEmpresaA);
        $porcentaje_cargadoDonMario = $this->obtenerPorcentajeCargado($viajesEmpresaA);

        $kms_MesCerealFletSur = $viajesEmpresaB->sum('km_viaje');
        $facturado_MesCerealFletSur = $this->obtenerFacturadoMes($viajesEmpresaB);
        $kms_promedio_cargadoCerealFletSur = $this->obtenerPromedioKMCargado($viajesEmpresaB);
        $kms_total_cargadoCerealFletSur = $this->obtenerTotalKMCargado($viajesEmpresaB);
        $porcentaje_cargadoCerealFletSur = $this->obtenerPorcentajeCargado($viajesEmpresaB);

        return view('admin.planilla.showPlanillaEmpresa')
                ->with('kms_MesDonMario', $kms_MesDonMario)
                ->with('facturado_MesDonMario', $facturado_MesDonMario)
                ->with('kms_promedio_cargadoDonMario', $kms_promedio_cargadoDonMario)
                ->with('kms_total_cargadoDonMario', $kms_total_cargadoDonMario)
                ->with('porcentaje_cargadoDonMario', $porcentaje_cargadoDonMario)

                ->with('kms_MesCerealFletSur', $kms_MesCerealFletSur)
                ->with('facturado_MesCerealFletSur', $facturado_MesCerealFletSur)
                ->with('kms_promedio_cargadoCerealFletSur', $kms_promedio_cargadoCerealFletSur)
                ->with('kms_total_cargadoCerealFletSur', $kms_total_cargadoCerealFletSur)
                ->with('porcentaje_cargadoCerealFletSur', $porcentaje_cargadoCerealFletSur);
    }
    


 /**
     * Muestra la planilla del chofer seleccionado filtrada por fecha de inicio y fin.
     */

    public function showPlanillaFiltrada(Request $request, $id)
    {
        $truck_driver = TruckDriver::find($id);
        $fechaInicio = $request->get('fechaInicio');
        $fechaFin = $request->get('fechaFin');

        $viajes = Viajes::where('truckdriver_id', $id)
            ->where('enCurso', false)
            ->with('combustibles')
            ->whereBetween('fecha_salida', [$fechaInicio, $fechaFin])
            ->orderBy('fecha_salida', 'asc')
            ->get();

        $viajesOrdenados = $viajes->sort(function ($a, $b) {
            $fechaA = Carbon::parse($a->fecha_salida);
            $fechaB = Carbon::parse($b->fecha_salida);
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

    public function exportPlanilla($id)
    {

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

        $truck_driver = TruckDriver::find($viaje->truckdriver_id);

        $truck_driver->p_chasis = $request->get('p_chasis' . $key);
        $truck_driver->p_batea = $request->get('p_batea' . $key);

        $viaje->update();
        $truck_driver->update();

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

    public function showChoferes(){

        $truck_drivers = TruckDriver::all();

        return view('admin.choferes.indexChoferes')
            ->with('truck_drivers', $truck_drivers);
    }

    public function asignarEmpresa(Request $request, $id){

        $truck_driver = TruckDriver::find($id);
        $empresa_seleccionada = $request->get('company_name');

        if($empresa_seleccionada === "Don Mario")
            $truck_driver->empresa = 'A';
        else if ($empresa_seleccionada === "Cereal Flet Sur")
            $truck_driver->empresa = 'B';

        $truck_driver->p_chasis = $request->get('p_chasis');
        $truck_driver->p_batea = $request->get('p_batea');

        $truck_driver->save();

        return redirect('/admin/truck-drivers');
    }
}
