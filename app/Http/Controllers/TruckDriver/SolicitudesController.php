<?php

namespace App\Http\Controllers\TruckDriver;
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
     * Elimina la solicitud.
     */
    public function destroy($id)
    {

        $solicitud = Solicitudes::find($id);
        $solicitud->delete();

        // redirect
        return redirect("/truck_driver/solicitudes");
    }
}
