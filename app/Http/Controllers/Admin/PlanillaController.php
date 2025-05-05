<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\{Log};
use App\Services\Admin\Planilla\PlanillaService;
use App\Exports\{PlanillaMensualExport, PlanillaExportMultiple};
use Maatwebsite\Excel\Facades\Excel;

class PlanillaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Muestra los choferes disponibles para ver su planilla.
     */
    public function indexPlanilla()
    {
        try {
            $query = PlanillaService::getInstance()->indexPlanilla();

            if (request()->expectsJson()) {
                return response()->json(['data' => $query], 200);
            }
            return view('admin.planilla.indexPlanilla', $query);
        } catch (Exception $e) {
            Log::critical('Exception: ' . $e);
            return response()->json(['error_controlado' => $e->getMessage()], 500);
        }
    }

    /**
     * Muestra la planilla del chofer seleccionado.
     */

    public function showPlanilla($id)
    {
        try {
            $query = PlanillaService::getInstance()->showPlanilla($id);

            if (request()->expectsJson()) {
                return response()->json(['data' => $query], 200);
            }
            return view('admin.planilla.showPlanilla', $query);
        } catch (Exception $e) {
            Log::critical('Exception: ' . $e);
            return response()->json(['error_controlado' => $e->getMessage()], 500);
        }
    }

    /**
     * Muestra la planilla mensual del chofer seleccionado.
     */
    public function showPlanillaMensual($id)
    {

        try {
            $query = PlanillaService::getInstance()->showPlanillaMensual($id);

            if (request()->expectsJson()) {
                return response()->json(['data' => $query], 200);
            }
            return view('admin.planilla.showPlanillaMensual', $query);
        } catch (Exception $e) {
            Log::critical('Exception: ' . $e);
            return response()->json(['error_controlado' => $e->getMessage()], 500);
        }
    }

    /**
     * Muestra la planilla de Empresa
     */
    public function showPlanillaEmpresa()
    {
        try {
            $query = PlanillaService::getInstance()->showPlanillaEmpresa();

            if (request()->expectsJson()) {
                return response()->json(['data' => $query], 200);
            }
            return view('admin.planilla.showPlanillaEmpresa', $query);
        } catch (Exception $e) {
            Log::critical('Exception: ' . $e);
            return response()->json(['error_controlado' => $e->getMessage()], 500);
        }
    }

    /**
     * Muestra la planilla del chofer seleccionado filtrada por fecha de inicio y fin.
     */

    public function showPlanillaFiltrada(Request $request, $id)
    {
        try {
            $query = PlanillaService::getInstance()->showPlanillaFiltrada($request, $id);

            if (request()->expectsJson()) {
                return response()->json(['data' => $query], 200);
            }
            return view('admin.planilla.showPlanillaFiltrada', $query);
        } catch (Exception $e) {
            Log::critical('Exception: ' . $e);
            return response()->json(['error_controlado' => $e->getMessage()], 500);
        }
    }

    public function exportPlanilla($id)
    {
        return Excel::download(new PlanillaExportMultiple($id), 'planilla_chofer.xlsx');
    }

    public function exportPlanillaFiltrada($id, $fechaInicio, $fechaFin)
    {
        return Excel::download(new PlanillaExportMultiple($id, $fechaInicio, $fechaFin), 'planilla_filtrada.xlsx');
    }

    public function exportPlanillaMensual($id)
    {
        return Excel::download(new PlanillaMensualExport($id), 'planilla_mensual.xlsx');
    }
}
