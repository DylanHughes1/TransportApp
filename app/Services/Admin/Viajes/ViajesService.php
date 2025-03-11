<?php

namespace App\Services\Admin\Viajes;

use App\Models\{TruckDriver, ViajeInicial, viajes, Solicitudes, Origen, Destino, Producto};
use Exception;
use \Carbon\Carbon;
use App\Models\InputsEditables;
use Illuminate\Support\Facades\{Log, Validator};

class ViajesService
{
    //use UtilTrait;

    private static $instances = [];

    protected function __construct() {}

    public static function getInstance(): ViajesService
    {
        $cls = static::class;
        if (!isset(self::$instances[$cls])) {
            self::$instances[$cls] = new static();
        }

        return self::$instances[$cls];
    }


    public function createSolicitudes()
    {
        $truck_drivers = TruckDriver::all();
        $viajes_inicial = ViajeInicial::all();

        return [
            'truck_driver' => $truck_drivers,
            'viajes_inicial' => $viajes_inicial
        ];
    }

    public function storeViajeInicial($request)
    {
        $viaje_inicial = new Viajes();

        $viaje_inicial->origen_id = $this->getOrigen($request);
        $viaje_inicial->destino_id = $this->getDestino($request);

        $viaje_inicial->fecha_salida = $request->get('dia1');
        $viaje_inicial->observacion_origen = $request->get('observacion1');
        $viaje_inicial->fecha_llegada = $request->get('dia2');
        $viaje_inicial->observacion_destino = $request->get('observacion2');

        $this->setPricing($viaje_inicial, $request);

        $viaje_inicial->facturacion_opcion = $request->get('fac-option');

        $viaje_inicial->save();

        return $viaje_inicial;
    }

    private function getOrigen($request)
    {
        $nombreOrigen = $this->normalizeCityName($request->filled('opcion_seleccionada')
            ? $request->get('opcion_seleccionada')
            : $request->input('salida'));

        return Origen::firstOrCreate(['nombre' => $nombreOrigen])->id;
    }

    private function getDestino($request)
    {
        $nombreDestino = $this->normalizeCityName($request->filled('opcion_seleccionada2')
            ? $request->get('opcion_seleccionada2')
            : $request->input('destino'));

        return Destino::firstOrCreate(['nombre' => $nombreDestino])->id;
    }

    private function setPricing(Viajes $viaje_inicial, $request)
    {
        if ($request->get('pricing-option') == 'tonelada') {
            $viaje_inicial->TN = $request->get('TN');
            $viaje_inicial->precio_total = null;
        } elseif ($request->get('pricing-option') == 'total') {
            $viaje_inicial->precio_total = $request->get('total');
            $viaje_inicial->TN = null;
        }
    }

    private function normalizeCityName($city)
    {
        $city = strtolower($city);

        $search = ['á', 'é', 'í', 'ó', 'ú', 'Á', 'É', 'Í', 'Ó', 'Ú'];
        $replace = ['a', 'e', 'i', 'o', 'u', 'A', 'E', 'I', 'O', 'U'];
        $city = str_replace($search, $replace, $city);

        $city = ucwords($city);

        return $city;
    }

    public function storeSolicitudes($request, $truckdriverId)
    {
        $viaje = viajes::find($request->get('id_viaje'));

        if (!$viaje) {
            throw new Exception("El viaje no fue encontrado.");
        }

        $viaje->progresoSolicitud = 1;
        $viaje->truckdriver_id = $truckdriverId;

        $solicitud = $this->crearSolicitudDesdeViaje($viaje, $truckdriverId);

        $solicitud->save();
        $viaje->save();
    }

    private function crearSolicitudDesdeViaje(viajes $viaje, $truckdriverId)
    {
        $solicitud = new Solicitudes();
        $solicitud->dia1 = $viaje->fecha_salida;
        $solicitud->salida = $viaje->origen->nombre;
        $solicitud->observacion1 = $viaje->observacion_origen;
        $solicitud->dia2 = $viaje->fecha_llegada;
        $solicitud->llegada = $viaje->destino->nombre;
        $solicitud->observacion2 = $viaje->observacion_destino;
        $solicitud->TN = $viaje->TN;
        $solicitud->truckdriver_id = $truckdriverId;
        $solicitud->viaje_id = $viaje->id;

        return $solicitud;
    }

    public function showViajes()
    {
        $viajes = Viajes::with(['combustibles', 'origen', 'destino', 'producto'])
            ->where('enCurso', true)
            ->orderBy('fecha_salida', 'asc')
            ->get();

        $choferes = TruckDriver::all();

        $choferesLibres = TruckDriver::whereNotNull('empresa')
            ->doesntHave('viajes', 'and', function ($query) {
                $query->where('enCurso', true);
            })->get();

        $primerDiaHaceDosMeses = Carbon::now()->subMonths(2)->startOfMonth();
        $ultimoDiaHaceDosMeses = Carbon::now()->subMonths(2)->endOfMonth();
        Viajes::whereBetween('fecha_salida', [$primerDiaHaceDosMeses, $ultimoDiaHaceDosMeses])->delete();

        return [
            'viajes' => $viajes,
            'choferes' => $choferes,
            'choferesLibres' => $choferesLibres,
            'origenes' => Origen::all(),
            'destinos' => Destino::all(),
            'productos' => Producto::all()
        ];
    }

    public function updateViaje($request)
    {
        $viaje = Viajes::findOrFail($request->get('id_viaje'));
        $key = $request->get('key');

        $nuevoOrigen = $this->normalizeCityName($request->get('origen' . $key));
        $nuevoDestino = $this->normalizeCityName($request->get('destino' . $key));

        $origen = Origen::firstOrCreate(['nombre' => $nuevoOrigen]);
        $destino = Destino::firstOrCreate(['nombre' => $nuevoDestino]);

        $viaje->origen_id = $origen->id;
        $viaje->destino_id = $destino->id;

        $fechaSalida = $this->convertirFecha($request->get('fecha_salida' . $key));
        $fechaLlegada = $this->convertirFecha($request->get('fecha_llegada' . $key));

        if ($fechaSalida !== null) {
            $viaje->fecha_salida = $fechaSalida;
        }
        if ($fechaLlegada !== null) {
            $viaje->fecha_llegada = $fechaLlegada;
        }

        if ($viaje->truckdriver_id) {
            $truck_driver = TruckDriver::find($viaje->truckdriver_id);

            if ($request->filled('p_chasis' . $key)) {
                $truck_driver->p_chasis = $request->get('p_chasis' . $key);
            }
            if ($request->filled('p_batea' . $key)) {
                $truck_driver->p_batea = $request->get('p_batea' . $key);
            }
            $truck_driver->save();
        }

        $viaje->save();

        return $viaje;
    }


    private function convertirFecha($input)
    {
        $fechaObjeto = \DateTime::createFromFormat('d/m/y', $input);
        return $fechaObjeto ? $fechaObjeto->format('Y-m-d') : null;
    }

    public function delete($id)
    {
        $viaje = viajes::find($id);
        $viaje->delete();
    }
}
