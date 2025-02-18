<?php

namespace App\Http\Controllers\TruckDriver;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Exception;
use App\Services\TruckDriver\ViajesService;
use Illuminate\Support\Facades\Log;


class ViajesController extends Controller
{

    /**
     * Muestra todos los viajes del chofer.
     */
    public function index()
    {
        try {
            $query = ViajesService::getInstance()->index();

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
     * Muestra el formulario a completar/editar de un viaje especifico.
     */
    public function showViaje($id)
    {
        return $this->handleShowViaje($id, 'truck_driver.viajes.show');
    }
    /**
     * Muestra la segunda parte del formulario a completar/editar de un viaje especifico.
     */
    public function showViajePartTwo($id)
    {
        return $this->handleShowViaje($id, 'truck_driver.viajes.show2');
    }
    private function handleShowViaje($id, $viewName)
    {
        try {
            $query = ViajesService::getInstance()->getViajeData($id);

            if (request()->expectsJson()) {
                return response()->json(['data' => $query], 200);
            }

            return view($viewName, $query);
        } catch (Exception $e) {
            Log::critical('Exception: ' . $e);
            return response()->json(['error_controlado' => $e->getMessage()], 500);
        }
    }

    public function autoSaveViaje(Request $request, $id)
    { {
            try {
                $query = ViajesService::getInstance()->autoSaveViaje($id, $request->all());

                return response()->json($query, 200);
            } catch (Exception $e) {
                Log::critical('Exception: ' . $e);
                return response()->json(['error_controlado' => $e->getMessage()], 500);
            }
        }
    }

    /**
     * Actualiza los cambios de la primer parte del viaje especifico.
     */
    public function updateViaje(Request $request, $id)
    {
        try {
            $result = ViajesService::getInstance()->updateViaje($id, $request->all());

            return redirect($result['redirect'])->with('status', $result['status']);
        } catch (Exception $e) {
            Log::critical('Exception: ' . $e);
            return redirect()->back()->withErrors(['error_controlado' => $e->getMessage()]);
        }
    }


    public function validarInputObligatorio(Request $request)
    {

        $validator = $request->validate([
            'fecha_salida' => 'required|date',
            'origen' => 'required|max:255',
            'fecha_llegada' => 'required|date',
            'km_viaje' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/',
            'destino' => 'required|max:255',
            'km_salida' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/',
            'c_porte' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/',
            'producto' => 'required|max:255',
            'carga_kg' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/',
            'descarga_kg' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/',
            'km_llegada' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/',
            'km_1_2' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/',
            'control_desc' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/',
        ]);

        return redirect()->back()->withErrors($validator)->withInput();
    }

    /**
     * Almacena la informacion del combustible cargado en ese viaje.
     */
    public function storeCombustible(Request $request, $id)
    {
        try {
            $result = ViajesService::getInstance()->storeCombustible($id, $request->all());

            return redirect($result['redirect'])->with('status', $result['status']);
        } catch (Exception $e) {
            Log::critical('Exception: ' . $e);
            return redirect()->back()->withErrors(['error_controlado' => $e->getMessage()]);
        }
    }

    public function crearViajeVacio(Request $request, $id)
    {
        try {
            $redirectUrl = ViajesService::getInstance()->crearViajeVacio($id, $request->all());

            return redirect($redirectUrl);
        } catch (Exception $e) {
            Log::critical('Exception: ' . $e);
            return redirect()->back()->withErrors(['error_controlado' => $e->getMessage()]);
        }
    }

    /**
     * Muestra el input para subir la imagen del recibo.
     */
    public function showImage($id)
    {
        $viaje = ViajesService::getInstance()->getViajeById($id);

        if (!$viaje) {
            abort(404);
        }

        if ($viaje->enCurso == false) {
            return view('truck_driver.viajes.image', compact('viaje'));
        } else {
            return view("truck_driver.viajes.permiso-denegado");
        }
    }

    public function storeImage(Request $request, $id)
    {
        try {
            $result = ViajesService::getInstance()->storeImages($request, $id);
            return redirect("/truck_driver/dashboard")->with('status', $result);
        } catch (Exception $e) {
            return redirect("/truck_driver/viajes/image/$id")->withErrors("Ocurrió un error al almacenar la imagen.");
        }
    }
}
