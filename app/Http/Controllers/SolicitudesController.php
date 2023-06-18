<?php

namespace App\Http\Controllers;
use App\Models\Solicitudes;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\viajes;
use Illuminate\Support\Facades\DB;

class SolicitudesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $solicitudes = Solicitudes::all()->where('truckdriver_id',auth()->user()->id);

        return view ('solicitudes.index')
            ->with('solicitudes',$solicitudes);
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function edit($id)
    // {

    // }

    public function crearViaje(Request $request, $id){

       
        $solicitud = Solicitudes::find($id);
        
        $viaje = new viajes();
        $viaje->fecha_salida = $solicitud->dia1;
        $viaje->origen = $solicitud->salida;
        $viaje->fecha_llegada = $solicitud->dia2;
        $viaje->destino = $solicitud->llegada;
        $viaje->truckdriver_id = auth()->user()->id;
        $viaje->enCurso = true;
        $viaje->TN = $solicitud->TN;
        $viaje->save();
       

        $solicitud->delete();
        
        return redirect("/truck_driver/solicitudes");
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $solicitud = Solicitudes::find($id);
        $solicitud->delete();

        // redirect
        return redirect("/truck_driver/solicitudes");
    }
}
