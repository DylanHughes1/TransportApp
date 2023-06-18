<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\ViajeInicial;
use App\Models\TruckDriver;
use App\Models\Solicitudes;
use App\Models\viajes;
use App\Models\Combustible;


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
        return view('admin.nuevos_viajes.create');
    }
    public function createSolicitudes()
    {      
        $truck_drivers = TruckDriver::all();
        $viajes_inicial = ViajeInicial::all();
       
        return view('admin.nuevos_viajes.create2')
            ->with('truck_drivers',$truck_drivers)
            ->with('viajes_inicial',$viajes_inicial);
    }

    
    public function getInfo($id)
    {      
        $viaje_inicial = ViajeInicial::find($id);
       
        if ($viaje_inicial) {
            // Construye la respuesta HTTP con los datos del viaje
            return response()->json([
                'success' => true,
                'data' => $viaje_inicial
            ]);
        } else {
            // Si no se encontró el viaje, devuelve una respuesta de error
            return response()->json([
                'success' => false,
                'message' => 'El viaje no fue encontrado.'
            ], 404);
        }
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
            'observacion2' => 'nullable',
            'id_viaje' => 'nullable'
        ]);

        $viaje_inicial = ViajeInicial::find($request->get('id_viaje'));

        $solicitud = new Solicitudes();
        $solicitud->dia1 = $request->get('dia1');
        $solicitud->salida = $request->get('salida');
        $solicitud->observacion1 = $request->get('observacion1');
        $solicitud->dia2 = $request->get('dia2');
        $solicitud->llegada = $request->get('llegada');
        $solicitud->observacion2 = $request->get('observacion2');
        $solicitud->truckdriver_id = $request->get('truck_driver_id');

        $solicitud->save();
        $viaje_inicial->delete();

        return redirect('/admin/dashboard');

    }

    public function showViajes()
    {
        $truck_drivers = TruckDriver::all();
        $Viajes = Viajes::all();
        $combustible = Combustible::all();

        return view('admin.show')
            ->with('truck_drivers',$truck_drivers)
            ->with('viajes', $Viajes)
            ->with('combustibles', $combustible);
    }

    public function indexPlanilla()
    {
        $truck_drivers = TruckDriver::all();
       
        return view('admin.planilla.indexPlanilla')
            ->with('truck_drivers',$truck_drivers);
    }

    public function showPlanilla($id)
    {
        
        $truck_driver = TruckDriver::find($id);
        
        $viajes = Viajes::where('truckdriver_id', $id)
                        ->where('enCurso', false)
                        ->get();

        $combustible = Combustible::all();
       
        return view('admin.planilla.showPlanilla')
            ->with('truck_driver',$truck_driver)
            ->with('viajes', $viajes)
            ->with('combustibles', $combustible);
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

