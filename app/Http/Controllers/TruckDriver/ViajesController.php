<?php

namespace App\Http\Controllers\TruckDriver;

use App\Http\Controllers\Controller;
use App\Models\viajes;
use App\Models\Combustible;
use Illuminate\Http\Request;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Exception;
use App\Models\ImagenViaje;
use \Carbon\Carbon;
use App\Models\InputsEditables;

class ViajesController extends Controller
{

    /**
     * Muestra todos los viajes del chofer.
     */
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

        return view('truck_driver.viajes.index')
            ->with('viajes', $viajesOrdenados)
            ->with('totalKilometrosMesActual', $totalKilometrosMesActual);
    }

    /**
     * Muestra el formulario a completar/editar de un viaje especifico.
     */
    public function showViaje($id)
    {

        $viaje = viajes::find($id);
        $inputs_editables = InputsEditables::all();
        if ($viaje == null)
            abort(404);

        return view('truck_driver.viajes.show')
            ->with('viaje', $viaje)
            ->with('inputs_editables', $inputs_editables);
    }

    /**
     * Muestra la segunda parte del formulario a completar/editar de un viaje especifico.
     */
    public function showViajePartTwo($id)
    {

        $viaje = viajes::find($id);
        $inputs_editables = InputsEditables::all();
        if ($viaje == null)
            abort(404);

        return view('truck_driver.viajes.show2')
            ->with('viaje', $viaje)
            ->with('inputs_editables', $inputs_editables);
    }


    public function autoSaveViaje(Request $request, $id)
    {
        $viaje = viajes::find($id);

        $request->validate([
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
        ]);

        foreach ($request->all() as $key => $value) {
            if ($request->has($key) && $value !== null) {
                $viaje->$key = $value;
            }
        }

        if ($viaje->km_salida != null && $viaje->km_llegada != null) {
            $viaje->km_viaje = $viaje->km_llegada - $viaje->km_salida;
        }

        if ($viaje->progreso == 1 && $request->input('carga_kg') !== null) {
            $viaje->progreso = 2;
        }

        $viaje->update();

        return response()->json(['message' => 'Datos guardados automáticamente'], 200);
    }

    /**
     * Actualiza los cambios de la primer parte del viaje especifico.
     */
    public function updateViaje(Request $request, $id)
    {
        $viaje = viajes::find($id);

        if ($request->input('finalizar') == 1) {
            $request->validate([
                'fecha_salida' => 'nullable|date',
                'origen' => 'nullable|max:255',
                'fecha_llegada' => 'nullable|date',
                'km_viaje' => 'nullable',
                'destino' => 'nullable|max:255',
                'km_salida' => 'nullable',
                'c_porte' => 'nullable',
                'producto' => 'nullable|max:255',
                'carga_kg' => 'nullable',
                'descarga_kg' => 'nullable',
                'km_llegada' => 'nullable',
                'km_1_2' => 'nullable',
            ]);

            $viaje->fecha_salida = $request->input('fecha_salida');
            $viaje->origen = $request->input('origen');
            $viaje->fecha_llegada = $request->input('fecha_llegada');
            $viaje->km_viaje = $request->input('km_llegada') - $request->input('km_salida');
            $viaje->destino = $request->input('destino');
            $viaje->km_salida = $request->input('km_salida');
            $viaje->c_porte = $request->input('c_porte');
            $viaje->producto = $request->input('producto');
            $viaje->carga_kg = $request->input('carga_kg');
            $viaje->descarga_kg = $request->input('descarga_kg');
            $viaje->km_llegada = $request->input('km_llegada');
            $viaje->km_1_2 = $request->input('km_1_2');
            $viaje->control_desc = $request->input('control_desc');

            if ($viaje->progreso == 1 && $request->input('carga_kg') !== null) {
                $viaje->progreso = 2;
            }

            $viaje->update();
        }
        $viaje->enCurso = false;
        $viaje->update();
        return redirect("/truck_driver/viajes/image/$id")->with('status', 'Cambios Guardados');
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

        $request->validate([
            'Km' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/',
            'fecha' => 'required|date',
            'litros' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/',
            'lugar_carga' => 'required|max:255',
        ]);

        $registro = new Combustible();

        $registro->Km = $request->input('Km');
        $registro->fecha = $request->input('fecha');
        $registro->litros = $request->input('litros');
        $registro->lugar_carga = $request->input('lugar_carga');

        $viaje = viajes::find($id);
        $registro->viaje_id = $viaje->id;
        $viaje->save();
        $registro->save();

        return redirect("/truck_driver/viajes/b/$id")->with('status', 'Cambios Guardados');
    }

    public function crearViajeVacio(Request $request, $id)
    {
        $viajeAsociado = viajes::find($id);
        $viajeAsociado->viajeInicialCreado = true;
        $viajeAsociado->km_viaje_vacio += $request->km_llegada - $request->km_salida;

        $viaje = new viajes();

        $input_editable = new InputsEditables();

        if ($request->filled('opcion_seleccionada')) {
            $viaje->origen = $request->get('opcion_seleccionada');
        } else {
            $input_editable->origen = $request->input('salida');
            $viaje->origen = $input_editable->origen;
        }

        if ($request->filled('opcion_seleccionada2')) {
            $viaje->destino = $request->get('opcion_seleccionada2');
        } else {
            $input_editable->destino = $request->input('destino');
            $viaje->destino = $input_editable->destino;
        }

        $viaje->fecha_salida = $request->fecha_salida;
        $viaje->fecha_llegada = $request->fecha_llegada;
        $viaje->km_salida = $request->km_salida;
        $viaje->km_llegada = $request->km_llegada;
        $viaje->km_viaje = $request->km_llegada - $request->km_salida;
        $viaje->km_1_2 = $request->km_1_2;
        $viaje->progresoSolicitud = 2;
        $viaje->esVacio = true;

        $viaje->truckdriver_id = auth()->user()->id;
        $viaje->enCurso = false;
        if ($input_editable->origen != null || $input_editable->destino)
            $input_editable->save();
        $viaje->save();
        $viajeAsociado->save();

        return redirect("/truck_driver/viajes/$id");
    }

    /**
     * Muestra el input para subir la imagen del recibo.
     */
    public function showImage($id)
    {
        $viaje = viajes::find($id);
        if ($viaje->enCurso == false) {
            return view('truck_driver.viajes.image')
                ->with('viaje', $viaje);
        } else {
            return view("truck_driver.viajes.permiso-denegado");
        }
    }

    public function storeImage(Request $request, $id)
    {

        $viaje = viajes::find($id);
        try {
            if ($request->hasFile('image1')) {

                $uploadedFile1 = $request->file('image1')->storeOnCloudinary('/recibos');
                $imagenViaje1 = new ImagenViaje();
                $imagenViaje1->image_link = $uploadedFile1->getPath();
                $imagenViaje1->image_path = $uploadedFile1->getPublicId();
                $viaje->imagenesViajes()->save($imagenViaje1);
            }
            if ($request->hasFile('image2')) {

                $uploadedFile2 = $request->file('image2')->storeOnCloudinary('/recibos');
                $imagenViaje2 = new ImagenViaje();
                $imagenViaje2->image_link = $uploadedFile2->getPath();
                $imagenViaje2->image_path = $uploadedFile2->getPublicId();
                $viaje->imagenesViajes()->save($imagenViaje2);
            }
            if ($request->hasFile('image3')) {
                $uploadedFile3 = $request->file('image3')->storeOnCloudinary('/recibos');
                $imagenViaje3 = new ImagenViaje();
                $imagenViaje3->image_link = $uploadedFile3->getPath();
                $imagenViaje3->image_path = $uploadedFile3->getPublicId();
                $viaje->imagenesViajes()->save($imagenViaje3);
            }
        } catch (Exception $e) {

            return redirect("/truck_driver/viajes/image/$id")->withErrors("Ocurrió un error al almacenar la imagen\n");
        }

        return redirect("/truck_driver/dashboard");
    }
}
