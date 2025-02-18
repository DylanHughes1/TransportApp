<?php

namespace App\Services\TruckDriver;

use App\Models\{viajes, TruckDriver, Solicitudes};
use Exception;
use \Carbon\Carbon;
use App\Models\InputsEditables;
use Illuminate\Support\Facades\{Log, Validator};

class SolicitudesService
{
    //use UtilTrait;

    private static $instances = [];

    protected function __construct() {}

    public static function getInstance(): SolicitudesService
    {
        $cls = static::class;
        if (!isset(self::$instances[$cls])) {
            self::$instances[$cls] = new static();
        }

        return self::$instances[$cls];
    }

    public function index()
    {
        return Solicitudes::all()->where('truckdriver_id', auth()->user()->id);
    }

    public function crearViaje($data, $id)
    {
        $truck_driver = TruckDriver::findOrFail($data->get('truckdriver_id'));

        $solicitud = Solicitudes::findOrFail($id);

        $viaje = Viajes::findOrFail($solicitud->viaje->id);
        $viaje->progreso = 1;
        $viaje->progresoSolicitud = 2;
        $viaje->observacion_origen = $solicitud->observacion1;
        $viaje->observacion_destino = $solicitud->observacion2;
        $viaje->p_batea = $truck_driver->p_batea;
        $viaje->p_chasis = $truck_driver->p_chasis;
        $viaje->save();

        $solicitud->delete();
    }

    public function cancelarViaje($id)
    {

        $solicitud = Solicitudes::find($id);


        $viaje = viajes::find($solicitud->viaje_id);
        $viaje->progresoSolicitud = 0;
        $viaje->truckdriver_id = null;

        $solicitud->delete();
        $viaje->save();
    }
}
