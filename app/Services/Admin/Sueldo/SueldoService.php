<?php

namespace App\Services\Admin\Sueldo;

use App\Models\{TruckDriver, viajes, nuevaFila};
use \Carbon\Carbon;
use App\Models\{Tabla1, Tabla2, Tabla3, DatosSueldo};

class SueldoService
{
    //use UtilTrait;

    private static $instances = [];

    protected function __construct() {}

    public static function getInstance(): SueldoService
    {
        $cls = static::class;
        if (!isset(self::$instances[$cls])) {
            self::$instances[$cls] = new static();
        }

        return self::$instances[$cls];
    }

    public function index()
    {
        $truck_drivers = TruckDriver::orderBy('name')->get();

        return ['truck_drivers' => $truck_drivers];
    }

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

        $mesActual = Carbon::now()->format('m');

        $viajesMesActual = viajes::whereMonth('fecha_salida', $mesActual)->get();

        $sumaKilometros = $viajesMesActual->sum(function ($viaje) {
            return $viaje->km_llegada - $viaje->km_salida;
        });

        return
            [
                'truck_driver' => $truck_driver,
                'datos' => $datos,
                'tabla1' => $tabla1,
                'tabla2' => $tabla2,
                'tabla3' => $tabla3,
                'sumaKilometros' => $sumaKilometros
            ];
    }

    public function showDatosBasicos()
    {
        $datos = DatosSueldo::all();
        return ['datos' => $datos];
    }

    public function updateDatosBasicos($data)
    {
        $datos = DatosSueldo::all()->first();

        $datos->sueldo_basico = $data->input('sueldo_basico');
        $datos->hs_ext_km_recorrido = $data->input('hs_ext_km_recorrido');
        $datos->perm_f_res = $data->input('perm_f_res');
        $datos->c_descarga = $data->input('c_descarga');
        $datos->comida = $data->input('comida');
        $datos->especial = $data->input('especial');
        $datos->pernoctada = $data->input('pernoctada');
        $datos->kms_rec = $data->input('kms_rec');
        $datos->perm_f_res_larga_distancia = $data->input('perm_f_res_larga_distancia');
        $datos->cruce_frontera = $data->input('cruce_frontera');
        $datos->dia_camionero = $data->input('dia_camionero');
        $datos->vacaciones_anual_x_dia = $data->input('vacaciones_anual_x_dia');

        $datos->save();
    }

    public function actualizarValor($data, $id)
    {
        $tabla1 = Tabla1::where('truckdriver_id', $id)->first();
        if (!$tabla1) {
            return false;
        }

        $tabla1->{$data->field} = $data->value;
        return $tabla1->save();
    }

    public function actualizarTotales1($data, $id)
    {
        $tabla1 = Tabla1::where('truckdriver_id', $id)->first();
        if (!$tabla1) {
            return false;
        }

        $tabla1->subtotal1 = $data->input('subtotal1');
        $tabla1->total_remun1 = $data->input('total_remun1');
        return $tabla1->save();
    }

    public function actualizarValorDescuento($data, $id)
    {
        $tabla2 = Tabla2::where('truckdriver_id', $id)->first();
        if (!$tabla2) {
            return false;
        }
        $tabla2->{$data->field} = $data->value;

        return $tabla2->save();
    }

    public function actualizarSubtotal2($data, $id)
    {
        $tabla2 = Tabla2::where('truckdriver_id', $id)->first();
        if (!$tabla2) {
            return false;
        }
        $tabla2->total_descuento = $data->input('total_descuento');
        $tabla2->subtotal2 = $data->input('subtotal2');

        return $tabla2->save();
    }

    public function actualizarNombre3($data)
    {
        $field = $data->input('field');
        $value = $data->input('value');
        Tabla3::query()->update([$field => $value]);
    }


    public function actualizarValor3($data, $id)
    {
        $tabla3 = Tabla3::where('truckdriver_id', $id)->first();

        if (!$tabla3) {
            return false;
        }

        $tabla3->{$data->field} = $data->value;
        return $tabla3->save();
    }

    public function actualizarTotalNoRenum($data, $id)
    {
        $tabla3 = Tabla3::where('truckdriver_id', $id)->first();

        if (!$tabla3) {
            return false;
        }
        $tabla3->total_remun2 = $data->input('subtotal');
        return $tabla3->save();
    }

    public function actualizarGastosExtra($data, $id)
    {
        $tabla3 = Tabla3::where('truckdriver_id', $id)->first();
        $field = $data->input('field');
        $value = $data->input('value');

        if ($tabla3 && in_array($field, ['adelantos', 'celular', 'gastos'])) {
            $tabla3->$field = $value;
            return $tabla3->save();
        } else return false;
    }


    public function agregarNuevaFila($data, $id)
    {
        $nuevaFila = new nuevaFila();
        $nuevaFila->nombre = $data->input('nombre');
        $nuevaFila->valor = $data->input('valor');

        $tabla3 = Tabla3::where('truckdriver_id', $id)->first();
        $tabla3->nuevasFilas()->save($nuevaFila);
        $tabla3->total_remun2 += $nuevaFila->valor;
        $tabla3->save();
    }

    public function actualizarNombreNuevaFila($data, $id)
    {
        $field = $data->input('field');
        $value = $data->input('value');
        $fila = NuevaFila::find($id);

        if ($fila) {
            $fila->{$field} = $value;
            return $fila->save();
        } else return false;
    }

    public function actualizarValorNuevaFila($data, $id)
    {
        $field = $data->input('field');
        $value = $data->input('value');
        $fila = NuevaFila::find($id);

        if ($fila) {
            $fila->{$field} = $value;
            return $fila->save();
        } else return false;
    }
}
