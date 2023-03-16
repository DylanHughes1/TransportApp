<?php

namespace App\Http\Controllers;

use App\Models\viajes;
use App\Models\Combustible;
use Illuminate\Http\Request;

class ViajesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $viajes = Viajes::all();

        return view ('viajes.index')->with('viajes',$viajes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd("Hello World");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\viajes  $viajes
     * @return \Illuminate\Http\Response
     */
    public function show(viajes $viajes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\viajes  $viajes
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $viaje = viajes::find($id);
        if($viaje==null)
            abort(404);

        return view('viajes.edit')->with('viaje',$viaje);
    }

        /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\viajes  $viajes
     * @return \Illuminate\Http\Response
     */
    public function editStepTwo($id)
    {
        
        $viaje = viajes::find($id);
        if($viaje==null)
            abort(404);

        return view('viajes.edit2')->with('viaje',$viaje);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\viajes  $viajes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
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
        
        return redirect("/truck_driver/viajes/$id")->with('status','Cambios Guardados');
    }
    public function updateSecondPart(Request $request, $id)
    {
        dd("Hello World");
        $viaje = viajes::find($id);

              
        return redirect("/truck_driver/viajes/$id");
    }

    public function storeCombustible(Request $request, $id){
     
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
        

        return redirect("/truck_driver/viajes/$id")->with('status','Cambios Guardados');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\viajes  $viajes
     * @return \Illuminate\Http\Response
     */
    public function destroy(viajes $viajes)
    {
        //
    }
}
