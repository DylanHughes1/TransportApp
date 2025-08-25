<?php

namespace App\Services\Admin\Sueldo;

use App\Models\{TruckDriver, viajes, nuevaFila};
use \Carbon\Carbon;
use App\Models\{Tabla1, Tabla2, Tabla3, DatosSueldo, AjusteSueldo, Nomina, PlantillaConcepto, LineaNomina};
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Arr;

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
        if (! $truck_driver) {
            throw new \Exception("Chofer no encontrado (id: {$id})");
        }

        $ajustes = AjusteSueldo::first();

        $hoy = Carbon::now();
        $periodoDesde = $hoy->copy()->startOfMonth()->toDateString();
        $periodoHasta  = $hoy->copy()->endOfMonth()->toDateString();

        $nomina = Nomina::firstOrCreate(
            [
                'truckdriver_id' => $id,
                'periodo_desde' => $periodoDesde,
                'periodo_hasta' => $periodoHasta,
            ],
            [
                'sueldo_basico_snapshot' => $ajustes->sueldo_basico ?? 0,
                'subtotal_remunerativo' => 0,
                'subtotal_no_remunerativo' => 0,
                'total_descuentos' => 0,
                'neto' => 0,
            ]
        );

        if ($nomina->lineas()->count() == 0) {
            $this->poblarLineasDesdePlantillas($nomina);
        }

        $lineas = $nomina->lineas()->orderBy('orden')->get();

        $plantillas = PlantillaConcepto::all();

        $mes = $hoy->format('m');
        $anio = $hoy->format('Y');

        try {
            $queryViajes = DB::table('viajes')
                ->whereMonth('fecha_salida', $mes)
                ->whereYear('fecha_salida', $anio);

            // Si la columna truckdriver_id existe, filtramos por chofer
            if (Schema::hasColumn('viajes', 'truckdriver_id')) {
                $queryViajes->where('truckdriver_id', $id);
            } else {
                // Si no existe, tratamos de filtrar por alguna columna relacionada, si aplica (saltamos)
            }

            $viajesMesActual = $queryViajes->get();

            $sumaKilometros = $viajesMesActual->sum(function ($viaje) {
                // defensivo: si no existen las columnas, asumimos 0
                $kmSalida = isset($viaje->km_salida) ? (float)$viaje->km_salida : 0;
                $kmLlegada = isset($viaje->km_llegada) ? (float)$viaje->km_llegada : 0;
                $d = $kmLlegada - $kmSalida;
                return $d > 0 ? $d : 0;
            });
        } catch (\Exception $e) {
            // Si falla la consulta (tabla/no columnas), devolvemos 0 y seguimos
            Log::warning("No se pudieron obtener viajes para calcular kms: {$e->getMessage()}");
            $sumaKilometros = 0;
        }

        $subtotalRem = $lineas->where('tipo', 'remunerativo')->sum('importe');
        $subtotalNoRem = $lineas->where('tipo', 'no_remunerativo')->sum('importe');

        $totalDescuentos = 0;
        foreach ($lineas->where('tipo', 'descuento') as $d) {
            if (!empty($d->porcentaje)) {
                // asumimos porcentaje guardado como 11.00 => dividir por 100
                $totalDescuentos += round($subtotalRem * ((float)$d->porcentaje / 100.0), 2);
            } else {
                $totalDescuentos += (float)$d->importe;
            }
        }

        $neto = round($subtotalRem + $subtotalNoRem - $totalDescuentos, 2);

        // Actualizamos la nomina (no obligatorio, pero útil para tener los totales persistidos)
        $nomina->subtotal_remunerativo = $subtotalRem;
        $nomina->subtotal_no_remunerativo = $subtotalNoRem;
        $nomina->total_descuentos = $totalDescuentos;
        $nomina->neto = $neto;
        $nomina->save();

        // 9) retornar datos listos para la vista
        return [
            'truck_driver' => $truck_driver,
            'ajustes' => $ajustes,
            'nomina' => $nomina,
            'lineas' => $lineas,
            'plantillas' => $plantillas,
            'sumaKilometros' => $sumaKilometros,
            'totales' => [
                'subtotal_remunerativo' => $subtotalRem,
                'subtotal_no_remunerativo' => $subtotalNoRem,
                'total_descuentos' => $totalDescuentos,
                'neto' => $neto,
            ]
        ];
    }

    public function poblarLineasDesdePlantillas(Nomina $nomina)
    {
        if ($nomina->lineas()->count() > 0) {
            return $nomina;
        }

        $ajustes = AjusteSueldo::first();
        if (! $ajustes) {
            Log::warning('No existe AjusteSueldo. Se creará lineas con valor unitario 0 donde no haya porcentaje.');
        }

        // Mapa: plantilla.nombre => campo en ajustes
        $mapaAjuste = [
            'Sueldo Básico' => 'sueldo_basico',
            'Hs Extraordinarias por km recorrido' => 'hs_ext_km_recorrido',
            'Hs Extraord. por km recorrido - 100%' => 'hs_ext_km_recorrido',
            'Permanencia fuera Resid. Habit inc.b)' => 'perm_f_res',
            'Control descarga' => 'c_descarga',
            'Horas extras al 50%' => 'hs_50',
            'Horas extras al 100%' => 'hs_100',
            'Día del Camionero (15 diciembre)' => 'valor_x_dia',
            'Vacaciones Anuales' => 'vacaciones_anual_x_dia',
            'Viático por Km recorrido coef. 1' => 'kms_rec',
            'Viático KM recori 1,2' => 'km_1_2',
            'Cruce Frontera' => 'cruce_frontera',
            'Comida' => 'comida',
            'Especial' => 'especial',
            'Pernoctada' => 'pernoctada',
            'Permanencia fuera residencia habit inc. a)' => 'perm_f_res_larga_distancia',
            // agregá/ajusta más mapeos si hace falta
        ];

        DB::beginTransaction();
        try {
            // 1) Remunerativos y no_remunerativos
            $plantillas = PlantillaConcepto::whereIn('tipo', ['remunerativo', 'no_remunerativo'])->get();

            foreach ($plantillas as $p) {
                $campo = $mapaAjuste[$p->nombre] ?? null;
                $valorUnitario = 0;
                if ($campo && $ajustes && isset($ajustes->{$campo})) {
                    $valorUnitario = (float)$ajustes->{$campo};
                }
                $cantidad = $p->nombre === 'Sueldo Básico' ? 1 : 0;

                LineaNomina::create([
                    'nomina_id' => $nomina->id,
                    'tipo' => $p->tipo,
                    'nombre' => $p->nombre,
                    'cantidad' => $cantidad,
                    'valor_unitario' => $valorUnitario,
                    'importe' => round($cantidad * $valorUnitario, 2),
                    'porcentaje' => null,
                    'es_remunerativo' => $p->tipo === 'remunerativo',
                    'orden' => 0,
                ]);
            }

            // 2) Descuentos (con porcentaje desde plantilla)
            $plantillasDesc = PlantillaConcepto::where('tipo', 'descuento')->get();
            foreach ($plantillasDesc as $p) {
                LineaNomina::create([
                    'nomina_id' => $nomina->id,
                    'tipo' => 'descuento',
                    'nombre' => $p->nombre,
                    'cantidad' => 0,
                    'valor_unitario' => 0,
                    'importe' => 0,
                    'porcentaje' => $p->valor_unitario_default ?? null,
                    'es_remunerativo' => false,
                    'orden' => 0,
                ]);
            }

            // 3) Recalcular totales y persistir
            $lineas = $nomina->lineas()->get();
            $subtotalRem = $lineas->where('tipo', 'remunerativo')->sum('importe') + ($nomina->sueldo_basico_snapshot ?? 0);
            $subtotalNoRem = $lineas->where('tipo', 'no_remunerativo')->sum('importe');

            $totalDescuentos = 0;
            foreach ($lineas->where('tipo', 'descuento') as $d) {
                if (!empty($d->porcentaje)) {
                    $totalDescuentos += round($subtotalRem * ((float)$d->porcentaje / 100.0), 2);
                } else {
                    $totalDescuentos += (float)$d->importe;
                }
            }

            $neto = round($subtotalRem + $subtotalNoRem - $totalDescuentos, 2);

            $nomina->update([
                'subtotal_remunerativo' => $subtotalRem,
                'subtotal_no_remunerativo' => $subtotalNoRem,
                'total_descuentos' => $totalDescuentos,
                'neto' => $neto,
            ]);

            DB::commit();
            return $nomina;
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('Error poblando lineas desde plantillas: ' . $e->getMessage());
            throw $e;
        }
    }

    public function guardarNominaCompleta(Nomina $nomina, array $payload)
    {
        $lineasPayload = Arr::get($payload, 'lineas', []);
        $totales = Arr::get($payload, 'totales', []);

        // Recorrer lineas: si viene id -> actualizar, sino -> crear
        foreach ($lineasPayload as $lp) {
            $data = [
                'nomina_id' => $nomina->id,
                'tipo' => $lp['tipo'] ?? 'remunerativo',
                'nombre' => $lp['nombre'] ?? '',
                'cantidad' => isset($lp['cantidad']) ? (float)$lp['cantidad'] : 0,
                'valor_unitario' => isset($lp['valor_unitario']) ? (float)$lp['valor_unitario'] : 0,
                'importe' => isset($lp['importe']) ? (float)$lp['importe'] : 0,
                'porcentaje' => isset($lp['porcentaje']) ? ($lp['porcentaje'] === null ? null : (float)$lp['porcentaje']) : null,
                'es_remunerativo' => ($lp['tipo'] ?? '') === 'remunerativo',
            ];

            if (!empty($lp['id'])) {
                // actualizar si existe
                LineaNomina::where('id', $lp['id'])->update($data);
            } else {
                // crear nueva linea
                LineaNomina::create($data);
            }
        }

        // Recalcular en servidor por seguridad (no confiar 100% en cliente)
        $lineas = $nomina->lineas()->get();

        // subtotal remunerativo: si existe 'Sueldo Básico' como linea la contamos, si no usamos snapshot
        $tieneSueldo = $lineas->first(function ($l) {
            return mb_strtolower(trim($l->nombre)) === 'sueldo básico';
        }) ? true : false;

        $subtotalRem = $lineas->where('tipo', 'remunerativo')->sum('importe');
        if (! $tieneSueldo) {
            $subtotalRem += ($nomina->sueldo_basico_snapshot ?? 0);
        }

        $subtotalNoRem = $lineas->where('tipo', 'no_remunerativo')->sum('importe');

        // descuentos: calcular porcentuales sobre subtotalRem o sumar importes fijos
        $totalDescuentos = 0;
        foreach ($lineas->where('tipo', 'descuento') as $d) {
            if (!empty($d->porcentaje)) {
                $totalDescuentos += round($subtotalRem * ((float)$d->porcentaje / 100.0), 2);
            } else {
                $totalDescuentos += (float)$d->importe;
            }
        }

        $subtotal2 = round($subtotalRem - $totalDescuentos, 2);
        $neto = round($subtotal2 + $subtotalNoRem, 2);

        // Guardar totales en la nómina
        $nomina->update([
            'subtotal_remunerativo' => $subtotalRem,
            'subtotal_no_remunerativo' => $subtotalNoRem,
            'total_descuentos' => $totalDescuentos,
            'neto' => $neto,
        ]);

        // Guardar snapshot JSON con detalle (opcional pero recomendado)
        $lineasSnapshot = $nomina->lineas()->get()->map(function ($l) {
            return [
                'id' => $l->id,
                'tipo' => $l->tipo,
                'nombre' => $l->nombre,
                'cantidad' => (float)$l->cantidad,
                'valor_unitario' => (float)$l->valor_unitario,
                'importe' => (float)$l->importe,
                'porcentaje' => $l->porcentaje ? (float)$l->porcentaje : null,
            ];
        })->toArray();

        $snapshot = [
            'generado_el' => now()->toDateTimeString(),
            'lineas' => $lineasSnapshot,
            'totales_cliente_enviado' => $totales,
            'totales_recalculado' => [
                'subtotal_remunerativo' => (float)$subtotalRem,
                'total_descuentos' => (float)$totalDescuentos,
                'subtotal_no_remunerativo' => (float)$subtotalNoRem,
                'subtotal2' => (float)$subtotal2,
                'neto' => (float)$neto,
            ],
            'version' => 'v1'
        ];

        $nomina->json_snapshot = $snapshot;
        $nomina->save();
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

    public function agregarNuevaFilaTabla1($data, $id)
    {
        $nuevaFila = nuevaFila::create([
            'nombre' => $data->input('nombre'),
            'valor' => $data->input('valor'),
        ]);

        $todasLasTabla1 = Tabla1::all();

        foreach ($todasLasTabla1 as $tabla1) {
            $tabla1->nuevasFilas()->attach($nuevaFila->id);
            $tabla1->subtotal1 += $nuevaFila->valor;
            $tabla1->total_remun1 += $nuevaFila->valor;
            $tabla1->save();
        }

        $tabla2 = Tabla2::where('truckdriver_id', $id)->first();
        $tabla2->subtotal2 += $nuevaFila->valor;
        $tabla2->save();
    }

    public function agregarNuevaFilaTabla3($data, $id)
    {
        $nuevaFila = nuevaFila::create([
            'nombre' => $data->input('nombre'),
            'valor' => $data->input('valor'),
        ]);

        $todasLasTabla3 = Tabla3::all();

        foreach ($todasLasTabla3 as $tabla3) {
            $tabla3->nuevasFilas()->attach($nuevaFila->id);
            $tabla3->total_remun2 += $nuevaFila->valor;
            $tabla3->save();
        }
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
