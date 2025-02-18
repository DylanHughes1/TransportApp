<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Admin\Sueldo\SueldoService;
use Illuminate\Support\Facades\Log;
use Exception;

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

    public function agregarNuevaFila(Request $request, $id)
    {
        try {
            SueldoService::getInstance()->agregarNuevaFila($request, $id);
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
}
