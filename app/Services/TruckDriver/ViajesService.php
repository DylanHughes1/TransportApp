<?php

namespace App\Services\TruckDriver;

use App\Models\{viajes, Combustible, ImagenViaje};
use Exception;
use \Carbon\Carbon;
use App\Models\InputsEditables;
use Illuminate\Support\Facades\{Log, Validator};

class ViajesService
{
    //use UtilTrait;

    private static $instances = [];

    protected function __construct()
    {
    }

    public static function getInstance(): ViajesService
    {
        $cls = static::class;
        if (!isset(self::$instances[$cls])) {
            self::$instances[$cls] = new static();
        }

        return self::$instances[$cls];
    }

    public function index()
    {
        $fechaActual = Carbon::now();
        $fechaDosMesesAtras = $fechaActual->subMonths(2);
        $truck_driver_id = auth()->user()->id;
        $fechaPrimerDiaMesActual = Carbon::now()->startOfMonth();

        $viajes = Viajes::where('fecha_salida', '>=', $fechaDosMesesAtras)
            ->orderBy('fecha_salida', 'asc')
            ->where('truckdriver_id', $truck_driver_id)
            ->get();

        $totalKilometrosMesActual = 0;

        foreach ($viajes as $viaje) {
            if ($viaje->fecha_salida >= $fechaPrimerDiaMesActual)
                $totalKilometrosMesActual += $viaje->km_viaje;
        }

        $viajesOrdenados = $viajes->sort(function ($a, $b) {
            $fechaA = Carbon::parse($a->fecha_llegada);
            $fechaB = Carbon::parse($b->fecha_llegada);
            $esVacioA = $a->esVacio;

            if ($fechaA->eq($fechaB)) {
                return $esVacioA ? -1 : 1;
            }

            return $fechaA->lt($fechaB) ? -1 : 1;
        });

        Viajes::where('fecha_salida', '<', $fechaDosMesesAtras)->delete();

        return [
            'viajes' => $viajesOrdenados,
            'totalKilometrosMesActual' => $totalKilometrosMesActual
        ];
    }

    public function getViajeById($id)
    {
        return Viajes::find($id);
    }

    public function getViajeData($id)
    {
        return [
            'viaje' => Viajes::findOrFail($id),
            'inputs_editables' => InputsEditables::all()
        ];
    }
    public function showViaje($id)
    {
        return $this->handleShowViaje($id, 'truck_driver.viajes.show');
    }

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

    public function autoSaveViaje($id, $data)
    {
        $viaje = viajes::find($id);

        $validatedData = $this->validateAutoSaveData($data);

        foreach ($validatedData as $key => $value) {
            if ($value !== null) {
                $viaje->$key = $value;
            }
        }

        if (!is_null($viaje->km_salida) && !is_null($viaje->km_llegada)) {
            $viaje->km_viaje = $viaje->km_llegada - $viaje->km_salida;
        }

        if ($viaje->progreso == 1 && !is_null($data['carga_kg'] ?? null)) {
            $viaje->progreso = 2;
        }

        $viaje->save();

        return ['message' => 'Datos guardados automáticamente'];
    }

    private function validateAutoSaveData($data)
    {
        return Validator::make($data, [
            'fecha_salida' => 'nullable|date',
            'origen' => 'nullable|max:255',
            'fecha_llegada' => 'nullable|date',
            'km_viaje' => 'nullable|numeric',
            'destino' => 'nullable|max:255',
            'km_salida' => 'nullable|numeric',
            'c_porte' => 'nullable|numeric',
            'producto' => 'nullable|max:255',
            'carga_kg' => 'nullable|numeric',
            'descarga_kg' => 'nullable|numeric',
            'km_llegada' => 'nullable|numeric',
            'km_1_2' => 'nullable|numeric',
            'control_desc' => 'nullable|numeric',
        ])->validate();
    }

    public function updateViaje($data, $id)
    {
        $viaje = Viajes::findOrFail($id);

        if (!empty($data['finalizar']) && $data['finalizar'] == 1) {
            $validatedData = $this->validateFinalizarViaje($data);
            foreach ($validatedData as $key => $value) {
                if ($value !== null) {
                    $viaje->$key = $value;
                }
            }

            if (!is_null($viaje->km_salida) && !is_null($viaje->km_llegada)) {
                $viaje->km_viaje = $viaje->km_llegada - $viaje->km_salida;
            }

            if ($viaje->progreso == 1 && !is_null($data['carga_kg'] ?? null)) {
                $viaje->progreso = 2;
            }

            $viaje->enCurso = false;
            $viaje->save();

            return ['redirect' => "/truck_driver/viajes/image/$id", 'status' => 'Cambios Guardados'];

        }
    }
    private function validateFinalizarViaje($data)
    {
        return Validator::make($data, [
            'fecha_salida' => 'nullable|date',
            'origen' => 'nullable|max:255',
            'fecha_llegada' => 'nullable|date',
            'km_viaje' => 'nullable|numeric',
            'destino' => 'nullable|max:255',
            'km_salida' => 'nullable|numeric',
            'c_porte' => 'nullable|numeric',
            'producto' => 'nullable|max:255',
            'carga_kg' => 'nullable|numeric',
            'descarga_kg' => 'nullable|numeric',
            'km_llegada' => 'nullable|numeric',
            'km_1_2' => 'nullable|numeric',
            'control_desc' => 'nullable|numeric',
        ])->validate();
    }

    public function storeCombustible($id, array $data)
    {
        $validatedData = $this->validateCombustible($data);

        $registro = new Combustible();
        $registro->Km = $validatedData['Km'];
        $registro->fecha = $validatedData['fecha'];
        $registro->litros = $validatedData['litros'];
        $registro->lugar_carga = $validatedData['lugar_carga'];

        $viaje = Viajes::findOrFail($id);
        $registro->viaje_id = $viaje->id;

        $viaje->save();
        $registro->save();

        return ['redirect' => "/truck_driver/viajes/b/$id", 'status' => 'Cambios Guardados'];
    }

    private function validateCombustible(array $data)
    {
        return Validator::make($data, [
            'Km' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/',
            'fecha' => 'required|date',
            'litros' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/',
            'lugar_carga' => 'required|max:255',
        ])->validate();
    }

    public function crearViajeVacio($id, array $data)
    {
        $validatedData = $this->validateCrearViajeVacio($data);

        $viajeAsociado = Viajes::findOrFail($id);
        $viajeAsociado->viajeInicialCreado = true;
        $viajeAsociado->km_viaje_vacio += $validatedData['km_llegada'] - $validatedData['km_salida'];

        $viaje = new Viajes();
        $input_editable = new InputsEditables();

        if (!empty($validatedData['opcion_seleccionada'])) {
            $viaje->origen = $validatedData['opcion_seleccionada'];
        } else {
            $input_editable->origen = $validatedData['salida'];
            $viaje->origen = $input_editable->origen;
        }

        if (!empty($validatedData['opcion_seleccionada2'])) {
            $viaje->destino = $validatedData['opcion_seleccionada2'];
        } else {
            $input_editable->destino = $validatedData['destino'];
            $viaje->destino = $input_editable->destino;
        }

        $viaje->fecha_salida = $validatedData['fecha_salida'];
        $viaje->fecha_llegada = $validatedData['fecha_llegada'];
        $viaje->km_salida = $validatedData['km_salida'];
        $viaje->km_llegada = $validatedData['km_llegada'];
        $viaje->km_viaje = $validatedData['km_llegada'] - $validatedData['km_salida'];
        $viaje->km_1_2 = $validatedData['km_1_2'];
        $viaje->progresoSolicitud = 2;
        $viaje->esVacio = true;
        $viaje->truckdriver_id = auth()->user()->id;
        $viaje->enCurso = false;

        if ($input_editable->origen !== null || $input_editable->destino !== null) {
            $input_editable->save();
        }

        $viaje->save();
        $viajeAsociado->save();

        return "/truck_driver/viajes/$id";
    }

    private function validateCrearViajeVacio(array $data)
    {
        return Validator::make($data, [
            'fecha_salida' => 'nullable|date',
            'fecha_llegada' => 'nullable|date',
            'km_salida' => 'required|numeric',
            'km_llegada' => 'required|numeric',
            'km_1_2' => 'nullable|numeric',
            'opcion_seleccionada' => 'nullable|string|max:255',
            'opcion_seleccionada2' => 'nullable|string|max:255',
            'salida' => 'nullable|string|max:255',
            'destino' => 'nullable|string|max:255',
        ])->validate();
    }

    public function storeImages($data, $id)
    {
        $viaje = $this->getViajeById($id);

        if (!$viaje) {
            throw new Exception("Viaje no encontrado.");
        }

        $imagenes = ['image1', 'image2', 'image3'];
        $uploadedImages = [];

        foreach ($imagenes as $imagen) {
            if ($data->hasFile($imagen)) {
                $uploadedFile = $data->file($imagen)->storeOnCloudinary('/recibos');

                $imagenViaje = new ImagenViaje();
                $imagenViaje->image_link = $uploadedFile->getPath();
                $imagenViaje->image_path = $uploadedFile->getPublicId();

                $viaje->imagenesViajes()->save($imagenViaje);
                $uploadedImages[] = $imagen;
            }
        }

        return count($uploadedImages) > 0
            ? "Imágenes almacenadas correctamente."
            : "No se subieron imágenes.";
    }
}