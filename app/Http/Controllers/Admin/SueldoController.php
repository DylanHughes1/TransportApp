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
use Illuminate\Support\Facades\Schema;


class SueldoController extends Controller
{
    /**
     * Muestra las opciones del sueldo.
     */
    public function index()
    {
        $truck_drivers = TruckDriver::orderBy('name')->get();

        return view('admin.sueldo.index')
            ->with('truck_drivers', $truck_drivers);
    }

    /**
     * Muestra la tabla del sueldo del chofer seleccionado.
     */
    public function showCalcularSueldo($id)
    {

        $truck_driver = TruckDriver::find($id);
        $datos = DatosSueldo::find(1);
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
            ->with('sumaKilometros', $sumaKilometros);
        ;
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
     * Tabla 1
     */

    public function actualizarValor(Request $request, $id)
    {
        $tabla1 = Tabla1::where('truckdriver_id', $id)->first();

        if ($tabla1) {
            $tabla1->{$request->field} = $request->value;

            $tabla1->save();

            return response()->json(['message' => 'Actualizado correctamente']);
        }

        return response()->json(['error' => 'Tabla no encontrada'], 404);
    }

    public function actualizarTotales1(Request $request, $id)
    {
        $tabla1 = Tabla1::where('truckdriver_id', $id)->first();
        $tabla1->subtotal1 = $request->input('subtotal1');
        $tabla1->total_remun1 = $request->input('total_remun1');
        $tabla1->save();

        return response()->json(['success' => true, 'message' => 'Totales actualizados']);
    }

    /**
     * Tabla 2
     */

    public function actualizarValorDescuento(Request $request, $id)
    {
        $tabla2 = Tabla2::where('truckdriver_id', $id)->first();


        if ($tabla2) {
            $tabla2->{$request->field} = $request->value;

            $tabla2->save();

            return response()->json(['message' => 'Descuento actualizado']);
        }

        return response()->json(['error' => 'Tabla no encontrada'], 404);
    }

    public function actualizarSubtotal2(Request $request, $id)
    {
        $tabla2 = Tabla2::where('truckdriver_id', $id)->first();

        $tabla2->total_descuento = $request->input('total_descuento');
        $tabla2->subtotal2 = $request->input('subtotal2');

        $tabla2->save();

        return response()->json(['success' => true, 'message' => 'Totales actualizados']);
    }

    /**
     * Tabla 3
     */

    public function actualizarNombre3(Request $request, $id)
    {
        $field = $request->input('field');
        $value = $request->input('value');


        Tabla3::query()->update([$field => $value]);

        return response()->json(['message' => 'Todos los registros han sido actualizados correctamente']);

    }

    public function actualizarValor3(Request $request, $id)
    {

        $tabla3 = Tabla3::where('truckdriver_id', $id)->first();

        if ($tabla3) {
            $tabla3->{$request->field} = $request->value;

            $tabla3->save();

            return response()->json(['message' => 'Actualizado correctamente']);
        }

        return response()->json(['error' => 'Tabla no encontrada'], 404);
    }

    public function actualizarTotalNoRenum(Request $request, $id)
    {
        $tabla3 = Tabla3::where('truckdriver_id', $id)->first();

        if ($tabla3) {
            $tabla3->total_remun2 = $request->input('subtotal');
            $tabla3->save();

            return response()->json(['success' => true, 'message' => 'Totales actualizados']);
        } else {
            return response()->json(['success' => false, 'message' => 'Registro no encontrado'], 404);
        }
    }

    public function actualizarGastosExtra(Request $request, $id)
    {
        $tabla3 = Tabla3::where('truckdriver_id', $id)->first();
        $field = $request->input('field');
        $value = $request->input('value');

        if ($tabla3 && in_array($field, ['adelantos', 'celular', 'gastos'])) {
            $tabla3->$field = $value;
            $tabla3->save();
            return response()->json(['success' => true, 'message' => 'Campo actualizado correctamente']);
        }

        return response()->json(['success' => false, 'message' => 'Campo no válido'], 400);
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

    public function actualizarNombreNuevaFila(Request $request, $id)
    {
        $field = $request->input('field');
        $value = $request->input('value');
        $fila = NuevaFila::find($id);

        if ($fila) {
            $fila->{$field} = $value;
            $fila->save();

            return response()->json(['message' => 'Campo actualizado correctamente']);
        }
    }

    public function actualizarValorNuevaFila(Request $request, $id)
    {
        $field = $request->input('field');
        $value = $request->input('value');
        $fila = NuevaFila::find($id);

        if ($fila) {
            $fila->{$field} = $value;
            $fila->save();

            return response()->json(['message' => 'Campo actualizado correctamente']);
        }
    }

}
