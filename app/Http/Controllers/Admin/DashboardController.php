<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Admin\DashboardService;
use Exception;
use Illuminate\Support\Facades\Log;

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

    public function showChoferes()
    {
        try {
            $query = DashboardService::getInstance()->showChoferes();
            if (request()->expectsJson()) {
                return response()->json(['data' => $query], 200);
            }
            return view('admin.choferes.indexChoferes', $query);
        } catch (Exception $e) {
            Log::critical('Exception: ' . $e);
            return response()->json(['error_controlado' => $e->getMessage()], 500);
        }
    }

    public function eliminarChofer($id)
    {
        try {
            DashboardService::getInstance()->eliminarChofer($id);
            return redirect('/admin/truck-drivers');
        } catch (Exception $e) {
            Log::critical('Exception: ' . $e);
            return response()->json(['error_controlado' => $e->getMessage()], 500);
        }
    }

    public function asignarEmpresa(Request $request, $id)
    {
        try {
            DashboardService::getInstance()->asignarEmpresa($request, $id);
            return redirect('/admin/truck-drivers');
        } catch (Exception $e) {
            Log::critical('Exception: ' . $e);
            return response()->json(['error_controlado' => $e->getMessage()], 500);
        }
    }

    public function autoSavePatente(Request $request, $id)
    {
        try {
            DashboardService::getInstance()->asignarEmpresa($request, $id);
            return response()->json(['success' => true]);
        } catch (Exception $e) {
            Log::critical('Exception: ' . $e);
            return response()->json(['error_controlado' => $e->getMessage()], 500);
        }
    }
}
