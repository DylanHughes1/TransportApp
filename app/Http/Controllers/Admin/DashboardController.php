<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\ViajeInicial;
use App\Models\TruckDriver;


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
       
        return view('admin.create2')->with('truck_drivers',$truck_drivers);
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

    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
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

