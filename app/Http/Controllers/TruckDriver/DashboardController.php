<?php

namespace App\Http\Controllers\TruckDriver;

use App\Http\Controllers\Controller;
use App\Services\TruckDriver\DashboardService;
use Illuminate\Support\Facades\Log;


class DashboardController extends Controller
{
    public function __construct()
    {
        /*
         * Uncomment the line below if you want to use verified middleware
         */
        //$this->middleware('verified:truck_driver.verification.notice');
    }
    public function index()
    {
        try {
            $query = DashboardService::getInstance()->index();

            if (request()->expectsJson()) {
                return response()->json(['data' => $query], 200);
            }
            return view('truck_driver.dashboard', $query);
        } catch (\Exception $e) {
            Log::critical('Exception: ' . $e);
            return response()->json(['error_controlado' => $e->getMessage()], 500);
        }
    }

    public function showPerfil()
    {
        return view('truck_driver.perfil');
    }

    public function quitarEmpresa($id)
    {
        try {
            $query = DashboardService::getInstance()->quitarEmpresa($id);

            if (request()->expectsJson()) {
                return response()->json(['data' => $query], 200);
            }

            return view('truck_driver.dashboard', ['status' => $query ? 'Empresa quitada correctamente' : 'Error al quitar la empresa']);

        } catch (\Exception $e) {
            Log::critical('Exception: ' . $e);
            return response()->json(['error_controlado' => $e->getMessage()], 500);
        }
    }

}
