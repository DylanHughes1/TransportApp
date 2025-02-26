<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\{Log};
use App\Services\Admin\Viajes\ViajesService;
use App\Models\{InputsEditables, viajes, TruckDriver};

class ViajesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Muestra el formulario para crear un nuevo viaje.
     */
    public function createViajeInicial()
    {
        return view('admin.nuevos_viajes.create');
    }

    /**
     * Almacena el nuevo viaje inicial.
     */
    public function storeViajeInicial(Request $request)
    {
        try {
            $query = ViajesService::getInstance()->storeViajeInicial($request);
            if (request()->expectsJson()) {
                return response()->json(['data' => $query], 200);
            }
            return redirect("/admin/show");
        } catch (Exception $e) {
            Log::critical('Exception: ' . $e);
            return response()->json(['error_controlado' => $e->getMessage()], 500);
        }
    }

    /**
     * Almacena la nueva solicitud realizada a un chofer.
     */
    public function storeSolicitudes(Request $request, $id)
    {
        try {
            ViajesService::getInstance()->storeSolicitudes($request, $id);
            return redirect('/admin/show');
        } catch (Exception $e) {
            return back()->withErrors("Ocurrió un error: " . $e->getMessage());
        }
    }

    /**
     * Muestra los viajes en proceso de cada chofer.
     */
    public function showViajes()
    {
        try {
            $query = ViajesService::getInstance()->showViajes();

            if (request()->expectsJson()) {
                return response()->json(['data' => $query], 200);
            }
            return view('admin.viajes_asignados.showViajes', $query);
        } catch (Exception $e) {
            Log::critical('Exception: ' . $e);
            return response()->json(['error_controlado' => $e->getMessage()], 500);
        }
    }


    public function updateViaje(Request $request)
    {
        try {
            $query = ViajesService::getInstance()->updateViaje($request);

            if (request()->expectsJson()) {
                return response()->json(['data' => $query], 200);
            }
            return redirect('/admin/show');
        } catch (Exception $e) {
            Log::critical('Exception: ' . $e);
            return response()->json(['error_controlado' => $e->getMessage()], 500);
        }
    }

    public function cancelarViaje($id)
    {
        try {
            ViajesService::getInstance()->delete($id);
            return redirect('/admin/show');
        } catch (Exception $e) {
            Log::critical('Exception: ' . $e);
            return response()->json(['error_controlado' => $e->getMessage()], 500);
        }
    }
}
