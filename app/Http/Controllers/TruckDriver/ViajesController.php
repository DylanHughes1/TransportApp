<?php

namespace App\Http\Controllers\TruckDriver;

use App\Http\Controllers\Controller;
use App\Models\viajes;
use App\Models\Combustible;
use Illuminate\Http\Request;

class ViajesController extends Controller
{

    /**
     * Muestra todos los viajes del chofer.
     */
    public function index()
    {
        $viajes = Viajes::all();

        return view('truck_driver.viajes.index')->with('viajes', $viajes);
    }

    /**
     * Muestra el formulario a completar/editar de un viaje especifico.
     */
    public function showViaje($id)
    {

        $viaje = viajes::find($id);
        if ($viaje == null)
            abort(404);

        return view('truck_driver.viajes.show')->with('viaje', $viaje);
    }

    /**
     * Muestra la segunda parte del formulario a completar/editar de un viaje especifico.
     */
    public function showViajePartTwo($id)
    {

        $viaje = viajes::find($id);
        if ($viaje == null)
            abort(404);

        return view('truck_driver.viajes.show2')->with('viaje', $viaje);
    }

    /**
     * Actualiza los cambios de la primer parte del viaje especifico.
     */
    public function updateViaje(Request $request, $id)
    {
        if ($request->input('finalizar') == 1) {
            $request->validate([
                'fecha_salida' => 'nullable|date',
                'origen' => 'nullable|max:255',
                'fecha_llegada' => 'nullable|date',
                'km_viaje' => 'nullable|integer',
                'destino' => 'nullable|max:255',
                'km_salida' => 'nullable|integer',
                'c_porte' => 'nullable|integer',
                'producto' => 'nullable|max:255',
                'carga_kg' => 'nullable|integer',
                'descarga_kg' => 'nullable|integer',
                'km_llegada' => 'nullable|integer',
                'km_1_2' => 'nullable|integer',

            ]);
        } else if ($request->input('finalizar') == null) {
            $this->validarInputObligatorio($request);
        }

        $viaje = viajes::find($id);

        $viaje->fecha_salida = $request->input('fecha_salida');
        $viaje->origen = $request->input('origen');
        $viaje->fecha_llegada = $request->input('fecha_llegada');
        $viaje->km_viaje = $request->input('km_viaje');
        $viaje->destino = $request->input('destino');
        $viaje->km_salida = $request->input('km_salida');
        $viaje->c_porte = $request->input('c_porte');
        $viaje->producto = $request->input('producto');
        $viaje->carga_kg = $request->input('carga_kg');
        $viaje->descarga_kg = $request->input('descarga_kg');
        $viaje->km_llegada = $request->input('km_llegada');
        $viaje->km_1_2 = $request->input('km_1_2');
        $viaje->update();

        if ($request->input('finalizar') == null) {
            $viaje->enCurso = false;
            $viaje->update();
            return redirect("/truck_driver/viajes/image/$id")->with('status', 'Cambios Guardados');
        } else {
            return redirect("/truck_driver/viajes/$id")->with('status', 'Cambios Guardados');
        }
    }

    /**
     * Actualiza los cambios de la segunda parte del viaje especifico.
     */
    public function updateViajeSecondPart(Request $request, $id)
    {

        if ($request->input('finalizar') == null) {
            $this->validarInputObligatorio($request);
        }

        $viaje = viajes::find($id);

        $viaje->km_vacios = $request->input('km_vacios');
        $viaje->observacion = $request->input('observacion');
        $viaje->update();

        return redirect("/truck_driver/viajes/$id");
    }

    public function validarInputObligatorio(Request $request)
    {

        $validator = $request->validate([
            'fecha_salida' => 'required|date',
            'origen' => 'required|max:255',
            'fecha_llegada' => 'required|date',
            'km_viaje' => 'required|integer',
            'destino' => 'required|max:255',
            'km_salida' => 'required|integer',
            'c_porte' => 'required|integer',
            'producto' => 'required|max:255',
            'carga_kg' => 'required|integer',
            'descarga_kg' => 'required|integer',
            'km_llegada' => 'integer',
            'km_1_2' => 'integer',
        ]);
        return redirect()->back()->withErrors($validator)->withInput();
    }

    /**
     * Almacena la informacion del combustible cargado en ese viaje.
     */
    public function storeCombustible(Request $request, $id)
    {

        $request->validate([
            'Km' => 'required|integer',
            'fecha' => 'required|date',
            'litros' => 'required|integer',
            'lugar_carga' => 'required|max:255',
        ]);

        $registro = new Combustible();

        $registro->Km = $request->input('Km');
        $registro->fecha = $request->input('fecha');
        $registro->litros = $request->input('litros');
        $registro->lugar_carga = $request->input('lugar_carga');
        $registro->save();

        $viaje = viajes::find($id);
        $viaje->registro_combustible_id = $registro->id;
        $viaje->save();


        return redirect("/truck_driver/viajes/$id")->with('status', 'Cambios Guardados');
    }

    /**
     * Muestra el input para subir la imagen del recibo.
     */
    public function showImage($id)
    {
        return view('truck_driver.viajes.image');
    }

}