<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Admin\Sueldo\SueldoService;
use Illuminate\Support\Facades\Log;
use Exception;
use App\Models\{Nomina, AjusteSueldo, LineaNomina};
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SueldoController extends Controller
{
    /**
     * Muestra las opciones del sueldo.
     */
    public function index()
    {
        try {
            $query = SueldoService::getInstance()->index();
            if (request()->expectsJson()) {
                return response()->json(['data' => $query], 200);
            }
            return view('admin.sueldo.index', $query);
        } catch (Exception $e) {
            Log::critical('Exception: ' . $e);
            return response()->json(['error_controlado' => $e->getMessage()], 500);
        }
    }

    /**
     * Muestra la tabla del sueldo del chofer seleccionado.
     */
    public function showCalcularSueldo($id)
    {
        try {
            $query = SueldoService::getInstance()->showCalcularSueldo($id);
            if (request()->expectsJson()) {
                return response()->json(['data' => $query], 200);
            }
            return view('admin.sueldo.showCalcularSueldo', $query);
        } catch (Exception $e) {
            Log::critical('Exception: ' . $e);
            return response()->json(['error_controlado' => $e->getMessage()], 500);
        }
    }

    public function guardarNomina(Request $request, Nomina $nomina)
    {
        $payload = $request->all();

        DB::beginTransaction();
        try {
            // Llamamos al service para persistir todo
            $service = SueldoService::getInstance()->guardarNominaCompleta($nomina, $payload);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => $service,
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error guardarNomina: ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]);
            return response()->json([
                'success' => false,
                'message' => 'Error al guardar la nómina: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Muestra la tabla con los datos base para el sueldo.
     */
    public function showDatosBasicos()
    {
        try {
            $query = SueldoService::getInstance()->showDatosBasicos();
            if (request()->expectsJson()) {
                return response()->json(['data' => $query], 200);
            }
            return view('admin.sueldo.showDatosBasicos', $query);
        } catch (Exception $e) {
            Log::critical('Exception: ' . $e);
            return response()->json(['error_controlado' => $e->getMessage()], 500);
        }
    }

    /**
     * Actualiza la tabla con los datos base para el sueldo.
     */
    public function updateDatosBasicos(Request $request)
    {
        try {
            SueldoService::getInstance()->updateDatosBasicos($request);
            return redirect("/admin/sueldo/datos")->with('status', 'Cambios Guardados');
        } catch (Exception $e) {
            Log::critical('Exception: ' . $e);
            return response()->json(['error_controlado' => $e->getMessage()], 500);
        }
    }
    /**
     * Tabla 1
     */
    public function actualizarValor(Request $request, $id)
    {
        try {
            $actualizado = SueldoService::getInstance()->actualizarValor($request, $id);
            if (!$actualizado) {
                return response()->json(['error' => 'No se encontró el registro'], 404);
            }
            return response()->json(['message' => 'Actualizado correctamente']);
        } catch (Exception $e) {
            Log::critical('Exception: ' . $e);
            return response()->json(['error_controlado' => $e->getMessage()], 500);
        }
    }

    public function actualizarTotales1(Request $request, $id)
    {
        try {
            $actualizado = SueldoService::getInstance()->actualizarTotales1($request, $id);
            if (!$actualizado) {
                return response()->json(['error' => 'No se encontró el registro'], 404);
            }
            return response()->json(['message' => 'Actualizado correctamente']);
        } catch (Exception $e) {
            Log::critical('Exception: ' . $e);
            return response()->json(['error_controlado' => $e->getMessage()], 500);
        }
    }

    /**
     * Tabla 2
     */

    public function actualizarValorDescuento(Request $request, $id)
    {
        try {
            $actualizado = SueldoService::getInstance()->actualizarValorDescuento($request, $id);
            if (!$actualizado) {
                return response()->json(['error' => 'No se encontró el registro'], 404);
            }
            return response()->json(['message' => 'Actualizado correctamente']);
        } catch (Exception $e) {
            Log::critical('Exception: ' . $e);
            return response()->json(['error_controlado' => $e->getMessage()], 500);
        }
    }

    public function actualizarSubtotal2(Request $request, $id)
    {
        try {
            $actualizado = SueldoService::getInstance()->actualizarSubtotal2($request, $id);
            if (!$actualizado) {
                return response()->json(['error' => 'No se encontró el registro'], 404);
            }
            return response()->json(['message' => 'Actualizado correctamente']);
        } catch (Exception $e) {
            Log::critical('Exception: ' . $e);
            return response()->json(['error_controlado' => $e->getMessage()], 500);
        }
    }

    /**
     * Tabla 3
     */

    public function actualizarNombre3(Request $request)
    {
        try {
            SueldoService::getInstance()->actualizarNombre3($request);
            return response()->json(['message' => 'Actualizado correctamente']);
        } catch (Exception $e) {
            Log::critical('Exception: ' . $e);
            return response()->json(['error_controlado' => $e->getMessage()], 500);
        }
    }

    public function actualizarValor3(Request $request, $id)
    {
        try {
            $actualizado = SueldoService::getInstance()->actualizarValor3($request, $id);
            if (!$actualizado) {
                return response()->json(['error' => 'No se encontró el registro'], 404);
            }
            return response()->json(['message' => 'Actualizado correctamente']);
        } catch (Exception $e) {
            Log::critical('Exception: ' . $e);
            return response()->json(['error_controlado' => $e->getMessage()], 500);
        }
    }

    public function actualizarTotalNoRenum(Request $request, $id)
    {
        try {
            $actualizado = SueldoService::getInstance()->actualizarTotalNoRenum($request, $id);
            if (!$actualizado) {
                return response()->json(['error' => 'No se encontró el registro'], 404);
            }
            return response()->json(['message' => 'Actualizado correctamente']);
        } catch (Exception $e) {
            Log::critical('Exception: ' . $e);
            return response()->json(['error_controlado' => $e->getMessage()], 500);
        }
    }

    public function actualizarGastosExtra(Request $request, $id)
    {
        try {
            $actualizado = SueldoService::getInstance()->actualizarGastosExtra($request, $id);
            if (!$actualizado) {
                return response()->json(['error' => 'No se encontró el registro'], 404);
            }
            return response()->json(['message' => 'Actualizado correctamente']);
        } catch (Exception $e) {
            Log::critical('Exception: ' . $e);
            return response()->json(['error_controlado' => $e->getMessage()], 500);
        }
    }

    public function agregarNuevaFilaTabla1(Request $request, $id)
    {
        try {
            SueldoService::getInstance()->agregarNuevaFilaTabla1($request, $id);
            return redirect("/admin/sueldo/calcular/$id")->with('status', 'Cambios Guardados');
        } catch (Exception $e) {
            Log::critical('Exception: ' . $e);
            return response()->json(['error_controlado' => $e->getMessage()], 500);
        }
    }

    public function agregarNuevaFilaTabla3(Request $request, $id)
    {
        try {
            SueldoService::getInstance()->agregarNuevaFilaTabla3($request, $id);
            return redirect("/admin/sueldo/calcular/$id")->with('status', 'Cambios Guardados');
        } catch (Exception $e) {
            Log::critical('Exception: ' . $e);
            return response()->json(['error_controlado' => $e->getMessage()], 500);
        }
    }

    public function actualizarNombreNuevaFila(Request $request, $id)
    {
        try {
            $actualizado = SueldoService::getInstance()->actualizarNombreNuevaFila($request, $id);
            if (!$actualizado) {
                return response()->json(['error' => 'No se encontró el registro'], 404);
            }
            return response()->json(['message' => 'Actualizado correctamente']);
        } catch (Exception $e) {
            Log::critical('Exception: ' . $e);
            return response()->json(['error_controlado' => $e->getMessage()], 500);
        }
    }

    public function actualizarValorNuevaFila(Request $request, $id)
    {
        try {
            $actualizado = SueldoService::getInstance()->actualizarValorNuevaFila($request, $id);
            if (!$actualizado) {
                return response()->json(['error' => 'No se encontró el registro'], 404);
            }
            return response()->json(['message' => 'Actualizado correctamente']);
        } catch (Exception $e) {
            Log::critical('Exception: ' . $e);
            return response()->json(['error_controlado' => $e->getMessage()], 500);
        }
    }

    public function generarNomina(Request $request)
    {
        // $request->lineas = [
        //   ['tipo'=>'remunerativo','nombre'=>'Hs extra','cantidad'=>5,'valor_unitario'=>200,'porcentaje'=>null],
        //   ['tipo'=>'descuento','nombre'=>'Jubilación','cantidad'=>0,'valor_unitario'=>0,'porcentaje'=>11.0],
        //   ...
        // ]

        // 1) obtener ajustes
        $ajustes = AjusteSueldo::first();

        // 2) crear nomina básica
        $nomina = Nomina::create([
            'truckdriver_id' => $request->truckdriver_id,
            'periodo_desde' => $request->periodo_desde ?? now(),
            'periodo_hasta' => $request->periodo_hasta ?? now(),
            'sueldo_basico_snapshot' => $ajustes->sueldo_basico ?? 0,
            'subtotal_remunerativo' => 0,
            'subtotal_no_remunerativo' => 0,
            'total_descuentos' => 0,
            'neto' => 0,
        ]);

        // 3) crear lineas (si vinieron por request)
        $lineasInput = $request->input('lineas', []);
        foreach ($lineasInput as $li) {
            $cantidad = (float) ($li['cantidad'] ?? 0);
            $valor_unitario = (float) ($li['valor_unitario'] ?? 0);
            $importe = round($cantidad * $valor_unitario, 2);

            // Si la linea tiene porcentaje en el campo 'porcentaje' guardamos ese valor en la columna porcentaje
            $porcentaje = isset($li['porcentaje']) ? (float)$li['porcentaje'] : null;

            $nomina->lineas()->create([
                'tipo' => $li['tipo'] ?? 'remunerativo',
                'nombre' => $li['nombre'] ?? 'Concepto',
                'cantidad' => $cantidad,
                'valor_unitario' => $valor_unitario,
                'importe' => $importe,
                'porcentaje' => $porcentaje, // si es descuento por %, lo guardamos aquí (ej 11.00)
                'es_remunerativo' => ($li['tipo'] ?? 'remunerativo') === 'remunerativo',
                'orden' => $li['orden'] ?? 0,
            ]);
        }

        // 4) recalcular totales
        $lineas = $nomina->lineas()->get();

        $subtotalRem = $lineas->where('tipo', 'remunerativo')->sum('importe');
        $subtotalNoRem = $lineas->where('tipo', 'no_remunerativo')->sum('importe');

        // Para descuentos, si la linea tiene 'porcentaje' lo aplicamos sobre subtotalRem
        $totalDescuentos = 0;
        foreach ($lineas->where('tipo', 'descuento') as $d) {
            if ($d->porcentaje) {
                // porcentaje como 11.00 -> dividir por 100
                $totalDescuentos += round($subtotalRem * ((float)$d->porcentaje / 100.0), 2);
            } else {
                // si viene como importe fijo
                $totalDescuentos += (float)$d->importe;
            }
        }

        $neto = round($subtotalRem + $subtotalNoRem - $totalDescuentos, 2);

        // 5) guardar totales en la nomina
        $nomina->subtotal_remunerativo = $subtotalRem;
        $nomina->subtotal_no_remunerativo = $subtotalNoRem;
        $nomina->total_descuentos = $totalDescuentos;
        $nomina->neto = $neto;

        // 6) armar snapshot (json)
        $lineasSnapshot = $lineas->map(function ($l) {
            return [
                'id_linea' => $l->id,
                'tipo' => $l->tipo,
                'nombre' => $l->nombre,
                'cantidad' => (float) $l->cantidad,
                'valor_unitario' => (float) $l->valor_unitario,
                'importe' => (float) $l->importe,
                'porcentaje' => $l->porcentaje ? (float) $l->porcentaje : null,
            ];
        })->toArray();

        $snapshot = [
            'generado_el' => now()->toDateTimeString(),
            'usuario_id' => Auth::id() ?? null,
            'ajustes_sueldo' => $ajustes ? $ajustes->toArray() : null,
            'lineas' => $lineasSnapshot,
            'totales' => [
                'subtotal_remunerativo' => (float) $subtotalRem,
                'subtotal_no_remunerativo' => (float) $subtotalNoRem,
                'total_descuentos' => (float) $totalDescuentos,
                'neto' => (float) $neto,
            ],
            'version_calculadora' => 'v1',
        ];

        $nomina->json_snapshot = $snapshot;
        $nomina->save();

        return response()->json([
            'success' => true,
            'nomina' => $nomina->load('lineas'),
        ], 201);
    }
}
