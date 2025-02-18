<?php

namespace App\Services\Admin\Viajes;

use App\Models\{TruckDriver, ViajeInicial, viajes, Solicitudes};
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
        $input_editable = new InputsEditables();

        $viaje_inicial->origen = $this->getOrigen($request, $input_editable);
        $viaje_inicial->destino = $this->getDestino($request, $input_editable);

        $viaje_inicial->fecha_salida = $request->get('dia1');
        $viaje_inicial->observacion_origen = $request->get('observacion1');
        $viaje_inicial->fecha_llegada = $request->get('dia2');
        $viaje_inicial->observacion_destino = $request->get('observacion2');

        $this->setPricing($viaje_inicial, $request);

        $viaje_inicial->save();

        if ($input_editable->origen != null || $input_editable->destino) {
            $input_editable->save();
        }
        return $viaje_inicial;
    }

    private function getOrigen($request, InputsEditables $input_editable)
    {
        if ($request->filled('opcion_seleccionada')) {
            return $this->normalizeCityName($request->get('opcion_seleccionada'));
        }

        $input_editable->origen = $this->normalizeCityName($request->input('salida'));
        return $input_editable->origen;
    }

    private function getDestino($request, InputsEditables $input_editable)
    {
        if ($request->filled('opcion_seleccionada2')) {
            return $this->normalizeCityName($request->get('opcion_seleccionada2'));
        }

        $input_editable->destino = $this->normalizeCityName($request->input('destino'));
        return $input_editable->destino;
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
        $solicitud->salida = $viaje->origen;
        $solicitud->observacion1 = $viaje->observacion_origen;
        $solicitud->dia2 = $viaje->fecha_llegada;
        $solicitud->llegada = $viaje->destino;
        $solicitud->observacion2 = $viaje->observacion_destino;
        $solicitud->TN = $viaje->TN;
        $solicitud->truckdriver_id = $truckdriverId;
        $solicitud->viaje_id = $viaje->id;

        return $solicitud;
    }

    public function showViajes()
    {
        $Viajes = Viajes::with('combustibles')
            ->where('enCurso', true)
            ->orderBy('fecha_salida', 'asc')
            ->get();

        $choferes = TruckDriver::all();

        $choferesLibres = TruckDriver::whereNotNull('empresa')
            ->doesntHave('viajes', 'and', function ($query) {
                $query->where('enCurso', true);
            })->get();


        $inputs_editables = InputsEditables::all();

        $primerDiaHaceDosMeses = Carbon::now()->subMonths(2)->startOfMonth();
        $ultimoDiaHaceDosMeses = Carbon::now()->subMonths(2)->endOfMonth();
        Viajes::whereBetween('fecha_salida', [$primerDiaHaceDosMeses, $ultimoDiaHaceDosMeses])->delete();

        return
            [
                'viajes' => $Viajes,
                'choferes' => $choferes,
                'choferesLibres' => $choferesLibres,
                'inputs_editables' => $inputs_editables
            ];
    }

    public function updateViaje($request)
    {

        $inputs_editables = InputsEditables::all();

        $viaje = viajes::find($request->get('id_viaje'));
        $key = $request->get('key');
        $nuevosCampos = [
            'origen' => $request->get('origen' . $key),
            'destino' => $request->get('destino' . $key),
        ];

        foreach ($nuevosCampos as $campo => $nuevoValor) {
            if (!$inputs_editables->contains($campo, $nuevoValor)) {
                $nuevoInputEditable = new InputsEditables([$campo => $nuevoValor]);
                $nuevoInputEditable->save();
            }
        }

        $viaje->origen = $nuevosCampos['origen'];
        $viaje->destino = $nuevosCampos['destino'];

        $convertirFecha = function ($input) {
            $fechaObjeto = \DateTime::createFromFormat('d/m/y', $input);
            return $fechaObjeto ? $fechaObjeto->format('Y-m-d') : null;
        };

        $fechaSalida = $convertirFecha($request->get('fecha_salida' . $key));
        $fechaLlegada = $convertirFecha($request->get('fecha_llegada' . $key));

        if ($fechaSalida !== null) {
            $viaje->fecha_salida = $fechaSalida;
        }
        if ($fechaLlegada !== null) {
            $viaje->fecha_llegada = $fechaLlegada;
        }

        $viaje->destino = $request->get('destino' . $key);

        $truck_driver = TruckDriver::find($viaje->truckdriver_id);

        if ($request->get('p_chasis' . $key) !== null) {
            $truck_driver->p_chasis = $request->get('p_chasis' . $key);
        }
        if ($request->get('p_batea' . $key) !== null) {
            $truck_driver->p_batea = $request->get('p_batea' . $key);
        }
        $viaje->update();
        if ($truck_driver != null)
            $truck_driver->update();

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
