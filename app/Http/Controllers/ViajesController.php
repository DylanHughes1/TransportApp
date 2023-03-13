<?php

namespace App\Http\Controllers;

use App\Models\viajes;
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
        $viaje = viajes::find($id);

        if($viaje==null)
            abort(404);

            $viaje->km_viaje = $request->input('km_salida');
            $viaje->c_porte = $request->input('c_porte');
            $viaje->update();
              
            return redirect()->back()->with('status','Cambios Guardados');
    }
    public function updateSecondPart(Request $request, $id)
    {
        $viaje = viajes::find($id);

        if($viaje==null)
            abort(404);

            $viaje->km_viaje = $request->input('km_salida');
            $viaje->c_porte = $request->input('c_porte');
            $viaje->update();
              
            return redirect()->back()->with('status','Cambios Guardados');
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
