<?php

namespace App\Services\TruckDriver;

use App\Models\{viajes, Combustible, ImagenViaje, Origen, Destino, Producto};
use Exception;
use \Carbon\Carbon;
use App\Models\InputsEditables;
use Illuminate\Support\Facades\{Log, Validator};

class ViajesService
{
    //use UtilTrait;

    private static $instances = [];

    protected function __construct() {}

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
            'origenes' => Origen::all(),
            'destinos' => Destino::all(),
            'productos' => Producto::all()
        ];
    }

    public function autoSaveViaje($id, $data)
    {
        $viaje = viajes::find($id);
        $validatedData = $this->validateAutoSaveData($data);

        if (isset($validatedData['origen'])) {
            $origen = Origen::firstOrCreate(['nombre' => $this->normalizeCityName($validatedData['origen'])]);
            $viaje->origen_id = $origen->id;
        }

        if (isset($validatedData['destino'])) {
            $destino = Destino::firstOrCreate(['nombre' => $this->normalizeCityName($validatedData['destino'])]);
            $viaje->destino_id = $destino->id;
        }

        if (isset($validatedData['producto'])) {
            $producto = Producto::firstOrCreate(['nombre' => $validatedData['producto']]);
            $viaje->producto_id = $producto->id;
        }

        foreach ($validatedData as $key => $value) {
            if ($value !== null && !in_array($key, ['origen', 'destino', 'producto'])) {
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
    private function normalizeCityName($city)
    {
        $city = strtolower($city);

        $search = ['á', 'é', 'í', 'ó', 'ú', 'Á', 'É', 'Í', 'Ó', 'Ú'];
        $replace = ['a', 'e', 'i', 'o', 'u', 'A', 'E', 'I', 'O', 'U'];
        $city = str_replace($search, $replace, $city);

        $city = ucwords($city);

        return $city;
    }

    public function updateViaje($id, $data)
    {
        $viaje = viajes::findOrFail($id);
        $validatedData = $this->validateFinalizarViaje($data);

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
    private function validateFinalizarViaje($data)
    {
        return Validator::make($data, [
            'fecha_salida' => 'date',
            'origen' => 'max:255',
            'fecha_llegada' => 'date',
            'km_viaje' => 'numeric',
            'destino' => 'max:255',
            'km_salida' => 'numeric',
            'c_porte' => 'nullable|numeric',
            'producto' => 'max:255',
            'carga_kg' => 'numeric',
            'descarga_kg' => 'numeric',
            'km_llegada' => 'numeric',
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

        $viaje->viaje_principal_id = $viajeAsociado->id;

        if (!empty($validatedData['opcion_seleccionada'])) {
            $viaje->origen_id = Origen::firstOrCreate([
                'nombre' => $this->normalizeCityName($validatedData['opcion_seleccionada'])
            ])->id;
        } else {
            $viaje->origen_id = Origen::firstOrCreate([
                'nombre' => $this->normalizeCityName($validatedData['salida'])
            ])->id;
        }

        if (!empty($validatedData['opcion_seleccionada2'])) {
            $viaje->destino_id = Destino::firstOrCreate([
                'nombre' => $this->normalizeCityName($validatedData['opcion_seleccionada2'])
            ])->id;
        } else {
            $viaje->destino_id = Destino::firstOrCreate([
                'nombre' => $this->normalizeCityName($validatedData['destino'])
            ])->id;
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
