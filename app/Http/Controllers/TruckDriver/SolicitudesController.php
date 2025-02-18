<?php

namespace App\Http\Controllers\TruckDriver;

use App\Models\Solicitudes;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\viajes;
use Illuminate\Support\Facades\DB;
use Exception;
use App\Models\TruckDriver;
use App\Services\TruckDriver\SolicitudesService;
use Illuminate\Support\Facades\{Log, Validator};

class SolicitudesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Muestra todas las solicitudes asociadas al chofer.
     */
    public function index()
    {
        try {
            $query = SolicitudesService::getInstance()->index();

            if (request()->expectsJson()) {
                return response()->json(['data' => $query], 200);
            }
            return view('truck_driver.viajes.index', $query);
        } catch (Exception $e) {
            Log::critical('Exception: ' . $e);
            return response()->json(['error_controlado' => $e->getMessage()], 500);
        }
    }

    /**
     * Crea el nuevo viaje asociada a la solicitud aceptada.
     */
    public function crearViaje(Request $request, $id)
    {
        try {
            SolicitudesService::getInstance()->crearViaje($request, $id);
            return redirect("/truck_driver/solicitudes");
        } catch (Exception $e) {
            Log::critical('Exception: ' . $e);
            return response()->json(['error_controlado' => $e->getMessage()], 500);
        }
    }

    /**
     * Elimina la solicitud.
     */
    public function cancelarViaje($id)
    {
        try {
            SolicitudesService::getInstance()->cancelarViaje($id);
            return redirect("/truck_driver/solicitudes");
        } catch (Exception $e) {
            Log::critical('Exception: ' . $e);
            return response()->json(['error_controlado' => $e->getMessage()], 500);
        }
    }
}
