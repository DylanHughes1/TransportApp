<?php

namespace App\Http\Controllers\TruckDriver;
use App\Models\Solicitudes;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\viajes;
use Illuminate\Support\Facades\DB;
use App\Models\ViajeInicial;

class SolicitudesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Muestra todas las solicitudes asociadas al chofer.
     */
    public function index()
    {
        $solicitudes = Solicitudes::all()->where('truckdriver_id',auth()->user()->id);

        return view ('truck_driver.solicitudes.index')
            ->with('solicitudes',$solicitudes);
    }

    /**
     * Crea el nuevo viaje asociada a la solicitud aceptada.
     */
    public function crearViaje(Request $request, $id){

       
        $solicitud = Solicitudes::find($id);
        $viaje = viajes::find($solicitud->viaje->id);
        $viaje->truckdriver_id = $solicitud->truckdriver_id;
        $viaje->progreso = 1;
        $viaje->progresoSolicitud = 1;
        $viaje->observacion_origen = $solicitud->observacion1;
        $viaje->observacion_destino = $solicitud->observacion2;
        $viaje->save();
       

        $solicitud->delete();
        
        return redirect("/truck_driver/solicitudes");
    }

    /**
     * Elimina la solicitud.
     */
    public function cancelarViaje($id)
    {

        $solicitud = Solicitudes::find($id);


        $viaje_inicial = new ViajeInicial();
        $viaje_inicial->dia1 = $solicitud->dia1;
        $viaje_inicial->salida = $solicitud->salida;
        $viaje_inicial->dia2 = $solicitud->dia2;
        $viaje_inicial->llegada = $solicitud->llegada;
        $viaje_inicial->TN = $solicitud->TN;

        $solicitud->delete();
        $viaje_inicial->save();

        // redirect
        return redirect("/truck_driver/solicitudes");
    }
}
