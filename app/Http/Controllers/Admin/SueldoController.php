<?php

namespace App\Http\Controllers\Admin;

use App\Models\TruckDriver;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DatosSueldo;
use App\Models\Tabla1;
use App\Models\Tabla2;
use App\Models\Tabla3;
use App\Models\viajes;
use Carbon\Carbon;
use App\Models\nuevaFila;

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
        $tabla1 = Tabla1::firstOrCreate(['truckdriver_id' => $id]);
        $tabla2 = Tabla2::firstOrCreate(['truckdriver_id' => $id]);
        $tabla3 = Tabla3::firstOrCreate(
            ['truckdriver_id' => $id],
            ['viatico_x_km_name' => 'Viático por Km recorrido cohef. 1'],
            ['cruce_frontera_name' => 'Cruce Frontera'],
            ['comida_name' => 'Comida'],
            ['especial_name' => 'Especial'],
            ['pernoctada_name' => 'Pernoctada'],
            ['permanencia_fuera_rec_name' => 'Permanencia fuera residencia habit inc. a)'],
            ['viatico_km_1_2_name' => 'Viático KM recorri 1,2'],
            ['adicional_vacas_anuales_name' => 'Adicional Vacaciones Anuales 2023'],
            ['asignacion_no_remuner_name' => 'Asignación No remuner Cuota - Acuerdo 151221'],
        );

        // Obtener el mes actual
        $mesActual = Carbon::now()->format('m');

        // Filtrar los viajes del mes actual
        $viajesMesActual = viajes::whereMonth('fecha_salida', $mesActual)->get();

        // Calcular la suma de las diferencias de kilómetros
        $sumaKilometros = $viajesMesActual->sum(function ($viaje) {
            return $viaje->km_llegada - $viaje->km_salida;
        });

        return view('admin.sueldo.showCalcularSueldo')
            ->with('truck_driver', $truck_driver)
            ->with('datos', $datos)
            ->with('tabla1', $tabla1)
            ->with('tabla2', $tabla2)
            ->with('tabla3', $tabla3)
            ->with('sumaKilometros', $sumaKilometros);;
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
     * Actualiza la tabla con los datos base para el sueldo.
     */
    public function updateDatosBasicos(Request $request)
    {
        $datos = DatosSueldo::all()->first();

        $datos->sueldo_basico = $request->input('sueldo_basico');
        $datos->hs_ext_km_recorrido = $request->input('hs_ext_km_recorrido');
        $datos->perm_f_res = $request->input('perm_f_res');
        $datos->c_descarga = $request->input('c_descarga');
        $datos->comida = $request->input('comida');
        $datos->especial = $request->input('especial');
        $datos->pernoctada = $request->input('pernoctada');
        $datos->kms_rec = $request->input('kms_rec');
        $datos->perm_f_res_larga_distancia = $request->input('perm_f_res_larga_distancia');
        $datos->cruce_frontera = $request->input('cruce_frontera');
        $datos->dia_camionero = $request->input('dia_camionero');
        $datos->vacaciones_anual_x_dia = $request->input('vacaciones_anual_x_dia');

        $datos->save();
        return redirect("/admin/sueldo/datos")->with('status', 'Cambios Guardados');
    }

    /**
     * Actualiza los datos de la primer tabla del sueldo de un chofer seleccionado.
     */
    public function updateDatos(Request $request, $id)
    {
        $subtotal1 = $this->obtenerSubtotal1($request);

        $tabla1 = Tabla1::where('truckdriver_id', $id)->first();
        $tabla1->hs_ext_km_recorrido = $request->input('hs_ext_km_recorrido');
        $tabla1->hs_ext_km_recorrido_100 = $request->input('hs_ext_km_recorrido_100');
        $tabla1->c_descarga = $request->input('c_descarga');
        $tabla1->hs_50 = $request->input('hs_50');
        $tabla1->hs_100 = $request->input('hs_100');
        $tabla1->antig = $request->input('antig');
        $tabla1->inasistencias_inj = $request->input('inasistencias_inj');
        $tabla1->subtotal1 = $subtotal1;

        $tabla1->total_remun1 = $subtotal1 + $subtotal1 * $request->antig * 0.01;

        $tabla1->update();

        return redirect("/admin/sueldo/calcular/$id")->with('status', 'Cambios Guardados');
    }

    public function obtenerSubtotal1(Request $request)
    {

        $subtotal1 = 0;

        $datos = DatosSueldo::all()->first();
        $inasistencias = ($datos->sueldo_basico / 30) * $request->inasistencias_inj;

        $subtotal1 = $datos->sueldo_basico +
            $datos->hs_ext_km_recorrido * $request->input('hs_ext_km_recorrido') +
            $datos->hs_ext_km_recorrido * $request->input('hs_ext_km_recorrido_100') +
            $datos->perm_f_res * $request->input('perm_f_res') +
            $datos->c_descarga * $request->input('c_descarga') +
            ($datos->hs_50) * ($request->input('hs_50') ?? 0) +
            ($datos->hs_100) * ($request->input('hs_100') ?? 0) -
            // + $datos->dia_camionero + 
            $inasistencias;

        return $subtotal1;
    }

    /**
     * Actualiza los datos de la segunda tabla del sueldo de un chofer seleccionado.
     */
    public function updateDatosTabla2(Request $request, $id)
    {
        $tabla1 = Tabla1::where('truckdriver_id', $id)->first();
        $tabla2 = Tabla2::where('truckdriver_id', $id)->first();
        $tabla2->jubilacion = floatval(str_replace('%', '', $request->input('jubilacion')));
        $tabla2->obra_social = floatval(str_replace('%', '', $request->input('obra_social')));
        $tabla2->cuota_solidaria = floatval(str_replace('%', '', $request->input('cuota_solidaria')));
        $tabla2->ley_19032 = floatval(str_replace('%', '', $request->input('ley_19032')));
        $tabla2->seguro_sepelio = floatval(str_replace('%', '', $request->input('seguro_sepelio')));
        $tabla2->aju_apo_dto = floatval(str_replace('%', '', $request->input('aju_apo_dto')));
        $tabla2->asoc_mut_1nov = floatval(str_replace('%', '', $request->input('asoc_mut_1nov')));

        $tabla2->total_descuento =  $this->obtenerTotalDescuento($request, $tabla1->total_remun1);

        $tabla2->subtotal2 = $tabla1->total_remun1 - $tabla2->total_descuento;

        $tabla2->update();

        return redirect("/admin/sueldo/calcular/$id")->with('status', 'Cambios Guardados');
    }

    public function obtenerTotalDescuento(Request $request, $total_remun1)
    {

        $descuento = 0;

        $descuento = floatval(str_replace('%', '', $request->input('jubilacion'))) / 100 * $total_remun1 +
            floatval(str_replace('%', '', $request->input('obra_social'))) / 100 * $total_remun1 +
            floatval(str_replace('%', '', $request->input('cuota_solidaria'))) / 100 * $total_remun1 +
            floatval(str_replace('%', '', $request->input('ley_19032'))) / 100 * $total_remun1 +
            floatval(str_replace('%', '', $request->input('seguro_sepelio'))) / 100 * $total_remun1 +
            floatval(str_replace('%', '', $request->input('aju_apo_dto'))) / 100 * $total_remun1 +
            floatval(str_replace('%', '', $request->input('asoc_mut_1nov'))) / 100 * $total_remun1;


        return $descuento;
    }

    /**
     * Actualiza los datos de la tercer tabla del sueldo de un chofer seleccionado.
     */
    public function updateDatosTabla3(Request $request, $id)
    {
        $tabla2 = Tabla2::where('truckdriver_id', $id)->first();
        $tabla3 = Tabla3::where('truckdriver_id', $id)->first();

        $this->actualizarNombres($request, $tabla3);

        $tabla3->viatico_x_km = $request->input('viatico_x_km');
        $tabla3->cruce_frontera = $request->input('cruce_frontera');
        $tabla3->comida = $request->input('comida');
        $tabla3->especial = $request->input('especial');
        $tabla3->pernoctada = $request->input('pernoctada');
        $tabla3->permanencia_fuera_rec = $request->input('permanencia_fuera_rec');
        $tabla3->viatico_km_1_2 = $request->input('viatico_km_1_2');
        $tabla3->adicional_vacas_anuales = $request->input('adicional_vacas_anuales');
        $tabla3->asignacion_no_remuner = $request->input('asignacion_no_remuner');

        $totalR = $this->obtenerTotalRemun2($request);
        $tabla3->total_remun2 = $totalR + $tabla2->subtotal2;

        $tabla3->adelantos = $request->input('adelantos');
        $tabla3->celular = $request->input('celular');
        $tabla3->gastos = $request->input('gastos');


        $tabla3->update();

        return redirect("/admin/sueldo/calcular/$id")->with('status', 'Cambios Guardados');
    }

    public function actualizarNombres(Request $request, Tabla3 $tabla3)
    {

        $tabla3->viatico_x_km_name = $request->input('viatico_x_km_name');
        $tabla3->cruce_frontera_name = $request->input('cruce_frontera_name');
        $tabla3->comida_name = $request->input('comida_name');
        $tabla3->especial_name = $request->input('especial_name');
        $tabla3->pernoctada_name = $request->input('pernoctada_name');
        $tabla3->permanencia_fuera_rec_name = $request->input('permanencia_fuera_rec_name');
        $tabla3->viatico_km_1_2_name = $request->input('viatico_km_1_2_name');
        $tabla3->adicional_vacas_anuales_name = $request->input('adicional_vacas_anuales_name');
        $tabla3->asignacion_no_remuner_name = $request->input('asignacion_no_remuner_name');

        $tabla3->save();
    }

    public function obtenerTotalRemun2(Request $request)
    {

        $totalR = 0;

        $datos = DatosSueldo::all()->first();

        $totalR = $datos->kms_rec * ($request->input('viatico_x_km') ?? 0) +
            $datos->cruce_frontera * ($request->input('cruce_frontera') ?? 0) +
            $datos->comida * ($request->input('comida') ?? 0) +
            $datos->especial * ($request->input('especial') ?? 0) +
            $datos->pernoctada * ($request->input('pernoctada') ?? 0) +
            $datos->perm_f_res * ($request->input('permanencia_fuera_rec') ?? 0) +
            $datos->km_1_2 * ($request->input('viatico_km_1_2') ?? 0) +
            $datos->vacaciones_anual_x_dia * ($request->input('adicional_vacas_anuales') ?? 0) +
            ($request->input('asignacion_no_remuner') ?? 0);


        $inputs = $request->all();
        foreach ($inputs as $key => $value) {
            if (strpos($key, 'valor') === 0) {
                $totalR += (float) $value;
            }
        }

        return $totalR;
    }

    public function agregarNuevaFila(Request $request, $id)
    {


        $nuevaFila = new nuevaFila();
        $nuevaFila->nombre = $request->input('nombre');
        $nuevaFila->valor = $request->input('valor');

        $tabla3 = Tabla3::where('truckdriver_id', $id)->first();
        $tabla3->nuevasFilas()->save($nuevaFila);
        $tabla3->total_remun2 += $nuevaFila->valor;
        $tabla3->save();

        return redirect("/admin/sueldo/calcular/$id")->with('status', 'Cambios Guardados');
    }
}
