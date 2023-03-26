<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\ViajeInicial;
use App\Models\TruckDriver;
use App\Models\Solicitudes;
use App\Models\viajes;


class DashboardController extends Controller
{
    public function __construct()
    {
        /*
         * Uncomment the line below if you want to use verified middleware
         */
        //$this->middleware('verified:admin.verification.notice');
    }


    public function index(){
        return view('admin.dashboard');
    }

        /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {      
        return view('admin.create');
    }
    public function createSolicitudes()
    {      
        $truck_drivers = TruckDriver::all();
        $viajes_inicial = ViajeInicial::all();
       
        return view('admin.create2')
            ->with('truck_drivers',$truck_drivers)
            ->with('viajes_inicial',$viajes_inicial);
    }

     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $request->validate([
            'dia1' => 'required|date',
            'salida' => 'required|max:255',
            'dia2' => 'required|date',
            'llegada' => 'required|max:255',
        ]);
        
        $viaje_inicial = new ViajeInicial();
        $viaje_inicial->dia1 = $request->get('dia1');
        $viaje_inicial->salida = $request->get('salida');
        $viaje_inicial->dia2 = $request->get('dia2');
        $viaje_inicial->llegada = $request->get('llegada');
        
        $viaje_inicial->save();

        return redirect("/admin/dashboard");
    }

    public function storeSolicitudes(Request $request){

        $request->validate([
            'dia1' => 'required|date',
            'observacion1' => 'nullable',
            'salida' => 'required|max:255',
            'dia2' => 'required|date',
            'llegada' => 'required|max:255',
            'observacion2' => 'nullable'
        ]);

        $solicitud = new Solicitudes();
        $solicitud->dia1 = $request->get('dia1');
        $solicitud->salida = $request->get('salida');
        $solicitud->observacion1 = $request->get('observacion1');
        $solicitud->dia2 = $request->get('dia2');
        $solicitud->llegada = $request->get('llegada');
        $solicitud->observacion2 = $request->get('observacion2');
        $solicitud->truckdriver_id = $request->get('truck_driver_id');

        $solicitud->save();

        return redirect('/admin/dashboard');

    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $truck_driver = TruckDriver::find($id);
        $Viajes = viajes::where('truckdriver_id', $truck_driver->id)->get();

        
        return view('admin.showViaje')
            ->with('truck_driver', $truck_driver)
            ->with('viajes', $Viajes);
    }

    public function showViajes()
    {
        $truck_drivers = TruckDriver::all();
       
        return view('admin.show')
            ->with('truck_drivers',$truck_drivers);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
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
     * @param  int  $ISBN
     * @return \Illuminate\Http\Response
     */
    public function destroy($ISBN)
    {
        
    }
}

