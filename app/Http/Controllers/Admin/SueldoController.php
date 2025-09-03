<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Admin\Sueldo\SueldoService;
use Illuminate\Support\Facades\Log;
use Exception;
use App\Models\{Nomina, AjusteSueldo, LineaNomina};
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\NominaExport;

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

    public function agregarLinea(Request $request, Nomina $nomina)
    {
        $validated = $request->validate([
            'tipo'           => 'required|in:remunerativo,no_remunerativo,descuento',
            'nombre'         => 'required|string|max:255',
            'valor_unitario' => 'nullable|numeric',
            'porcentaje'     => 'nullable|numeric',
        ]);

        DB::beginTransaction();
        try {
            $linea = SueldoService::getInstance()
                ->agregarLinea($nomina, $validated);

            DB::commit();

            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'linea'   => $linea
                ]);
            }

            return redirect()
                ->route('nominas.show', $nomina->id)
                ->with('success', 'Línea agregada correctamente');
        } catch (\Throwable $e) {
            DB::rollBack();
            return back()->withErrors(['error' => $e->getMessage()]);
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

    public function generarNomina(Request $request)
    {
        try {
            $nomina = SueldoService::getInstance()->generarNomina($request->all());

            return response()->json([
                'success' => true,
                'nomina' => $nomina,
            ], 201);
        } catch (Exception $e) {
            Log::critical('Exception: ' . $e);
            return response()->json(['error_controlado' => $e->getMessage()], 500);
        }
    }

    public function eliminarLinea(Request $request, Nomina $nomina, LineaNomina $linea)
    {
        // Verificamos pertenencia
        if ($linea->nomina_id !== $nomina->id) {
            return response()->json(['success' => false, 'message' => 'La línea no pertenece a esta nómina.'], 404);
        }

        DB::beginTransaction();
        try {
            SueldoService::getInstance()->eliminarLinea($nomina, $linea->id);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Línea eliminada correctamente'
            ]);
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('Error eliminando línea: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error al eliminar la línea'
            ], 500);
        }
    }

    public function exportExcel(Nomina $nomina)
    {
        $fileName = "nomina_{$nomina->id}.xlsx";
        return Excel::download(new NominaExport($nomina), $fileName);
    }
}
