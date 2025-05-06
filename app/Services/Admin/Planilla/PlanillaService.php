<?php

namespace App\Services\Admin\Planilla;

use App\Models\{TruckDriver, ViajeInicial, viajes, Solicitudes};
use Exception;
use \Carbon\Carbon;
use App\Models\InputsEditables;
use Illuminate\Support\Facades\{Log, Validator};

class PlanillaService
{
    //use UtilTrait;

    private static $instances = [];

    protected function __construct() {}

    public static function getInstance(): PlanillaService
    {
        $cls = static::class;
        if (!isset(self::$instances[$cls])) {
            self::$instances[$cls] = new static();
        }

        return self::$instances[$cls];
    }

    public function indexPlanilla()
    {
        $truck_drivers = TruckDriver::orderBy('name')->get();

        return ['truck_drivers' => $truck_drivers];
    }

    public function showPlanilla($id)
    {
        $truck_driver = TruckDriver::find($id);

        $viajes = Viajes::where('truckdriver_id', $id)
            ->where('enCurso', false)
            ->with('combustibles')
            ->orderBy('fecha_salida', 'asc')
            ->get();

        $viajesOrdenados = $viajes->sort(function ($a, $b) {
            $fechaA = Carbon::parse($a->fecha_salida);
            $fechaB = Carbon::parse($b->fecha_salida);
            $esVacioA = $a->esVacio;

            if ($fechaA->eq($fechaB)) {
                return $esVacioA ? -1 : 1;
            }

            return $fechaA->lt($fechaB) ? -1 : 1;
        });

        return
            [
                'truck_driver' => $truck_driver,
                'viajes' => $viajesOrdenados
            ];
    }

    public function showPlanillaMensual($id)
    {
        $truck_driver = TruckDriver::find($id);

        $firstDayOfCurrentMonth = Carbon::now()->startOfMonth();
        $firstDayOfPreviousMonth = Carbon::now()->subMonth()->startOfMonth();
        $lastDayOfPreviousMonth = Carbon::now()->subMonth()->endOfMonth();

        $viajesEsteMes = Viajes::where('truckdriver_id', $id)
            ->where('enCurso', false)
            ->with('combustibles')
            ->where('fecha_salida', '>=', $firstDayOfCurrentMonth)
            ->orderBy('fecha_salida', 'asc')
            ->get();

        $viajesMesAnterior = Viajes::where('truckdriver_id', $id)
            ->where('enCurso', false)
            ->with('combustibles')
            ->where('fecha_salida', '>=', $firstDayOfPreviousMonth)
            ->where('fecha_salida', '<=', $lastDayOfPreviousMonth)
            ->orderBy('fecha_salida', 'asc')
            ->get();

        $kms_MesEsteMes = $viajesEsteMes->sum('km_viaje');
        $costo_totalEsteMes = $this->obtenerFacturadoMes($viajesEsteMes);
        $kms_promedio_cargadoEsteMes = $this->obtenerPromedioKMCargado($viajesEsteMes);
        $kms_total_cargadoEsteMes = $this->obtenerTotalKMCargado($viajesEsteMes);
        $porcentaje_cargadoEsteMes = $this->obtenerPorcentajeCargado($viajesEsteMes);

        $kms_MesMesAnterior = $viajesMesAnterior->sum('km_viaje');
        $costo_totalMesAnterior = $this->obtenerFacturadoMes($viajesMesAnterior);
        $kms_promedio_cargadoMesAnterior = $this->obtenerPromedioKMCargado($viajesMesAnterior);
        $kms_total_cargadoMesAnterior = $this->obtenerTotalKMCargado($viajesMesAnterior);
        $porcentaje_cargadoMesAnterior = $this->obtenerPorcentajeCargado($viajesMesAnterior);

        return
            [
                'truck_driver' => $truck_driver,
                'kms_MesEsteMes' => $kms_MesEsteMes,
                'costo_totalEsteMes' => $costo_totalEsteMes,
                'kms_promedio_cargadoEsteMes' => $kms_promedio_cargadoEsteMes,
                'kms_total_cargadoEsteMes' => $kms_total_cargadoEsteMes,
                'porcentaje_cargadoEsteMes' => $porcentaje_cargadoEsteMes,

                'kms_MesMesAnterior' => $kms_MesMesAnterior,
                'costo_totalMesAnterior' => $costo_totalMesAnterior,
                'kms_promedio_cargadoMesAnterior' => $kms_promedio_cargadoMesAnterior,
                'kms_total_cargadoMesAnterior' => $kms_total_cargadoMesAnterior,
                'porcentaje_cargadoMesAnterior' => $porcentaje_cargadoMesAnterior
            ];
    }

    function obtenerFacturadoMes($viajes)
    {
        $costo_total = 0;
        foreach ($viajes as $viaje) {
            $costo_viaje = ($viaje->carga_kg * $viaje->TN) / 1000;
            $costo_total += $costo_viaje;
        }
        return $costo_total;
    }
    function obtenerPromedioKMCargado($viajes)
    {
        $kms_totales = 0;
        $num_viajes = 0;

        foreach ($viajes as $viaje) {
            if (!$viaje->esVacio) {
                $carga_en_toneladas = $viaje->carga_kg / 1000;
                $costo_por_tonelada = $viaje->TN;
                $distancia_viaje = max(1, $viaje->km_llegada - $viaje->km_salida);

                $costo_por_km = ($carga_en_toneladas * $costo_por_tonelada) / $distancia_viaje;

                $kms_totales += $costo_por_km;
                $num_viajes += 1;
            }
        }

        if ($num_viajes > 0) {
            $promedio_kms_cargado = $kms_totales / $num_viajes;
        } else {
            $promedio_kms_cargado = 0;
        }

        return number_format($promedio_kms_cargado, 2);
    }

    function obtenerTotalKMCargado($viajes)
    {
        $kms_totales = 0;

        foreach ($viajes as $viaje) {
            if (!$viaje->esVacio) {
                $carga_en_toneladas = $viaje->carga_kg / 1000;
                $costo_por_tonelada = $viaje->TN;
                $distancia_viaje = max(1, ($viaje->km_llegada - $viaje->km_salida) + $viaje->km_viaje_vacio);

                $costo_por_km = ($carga_en_toneladas * $costo_por_tonelada) / $distancia_viaje;

                $kms_totales += $costo_por_km;
            }
        }

        $num_viajes = count($viajes);
        if ($num_viajes > 0) {
            $promedio_kms_cargado = $kms_totales / $num_viajes;
        } else {
            $promedio_kms_cargado = 0;
        }

        return number_format($promedio_kms_cargado, 2);
    }
    function obtenerPorcentajeCargado($viajes)
    {
        $distancia_viaje_total = 0;
        $distancia_viaje_cargado = 0;

        foreach ($viajes as $viaje) {
            if (!$viaje->esVacio && $viaje->km_llegada > $viaje->km_salida) {
                $distancia_total_viaje = ($viaje->km_llegada - $viaje->km_salida) + $viaje->km_viaje_vacio;
                $distancia_cargada_viaje = ($viaje->km_llegada - $viaje->km_salida);

                if ($distancia_total_viaje > 0) {
                    $distancia_viaje_total += $distancia_total_viaje;
                    $distancia_viaje_cargado += $distancia_cargada_viaje;
                }
            }
        }
        if ($distancia_viaje_total == 0) {
            return 0;
        }

        return (int) (($distancia_viaje_cargado / $distancia_viaje_total) * 100);
    }

    public function showPlanillaEmpresa()
    {

        $firstDayOfCurrentMonth = Carbon::now()->startOfMonth();

        $choferesEmpresaA = TruckDriver::where('empresa', 'A')->pluck('id');
        $viajesEmpresaA = viajes::whereIn('truckdriver_id', $choferesEmpresaA)
            ->where('enCurso', false)
            ->with('combustibles')
            ->where('fecha_salida', '>=', $firstDayOfCurrentMonth)
            ->orderBy('fecha_salida', 'asc')
            ->get();

        $choferesEmpresaB = TruckDriver::where('empresa', 'B')->pluck('id');
        $viajesEmpresaB = viajes::whereIn('truckdriver_id', $choferesEmpresaB)
            ->where('enCurso', false)
            ->with('combustibles')
            ->where('fecha_salida', '>=', $firstDayOfCurrentMonth)
            ->orderBy('fecha_salida', 'asc')
            ->get();

        $kms_MesDonMario = $viajesEmpresaA->sum('km_viaje');
        $facturado_MesDonMario = $this->obtenerFacturadoMes($viajesEmpresaA);
        $kms_promedio_cargadoDonMario = is_numeric($this->obtenerPromedioKMCargado($viajesEmpresaA)) ? $this->obtenerPromedioKMCargado($viajesEmpresaA) : 0;
        $kms_total_cargadoDonMario = is_numeric($this->obtenerTotalKMCargado($viajesEmpresaA)) ? $this->obtenerTotalKMCargado($viajesEmpresaA) : 0;
        $porcentaje_cargadoDonMario = is_numeric($this->obtenerPorcentajeCargado($viajesEmpresaA)) ? $this->obtenerPorcentajeCargado($viajesEmpresaA) : 0;

        $kms_MesCerealFletSur = $viajesEmpresaB->sum('km_viaje');
        $facturado_MesCerealFletSur = $this->obtenerFacturadoMes($viajesEmpresaB);
        $kms_promedio_cargadoCerealFletSur = is_numeric($this->obtenerPromedioKMCargado($viajesEmpresaB)) ? $this->obtenerPromedioKMCargado($viajesEmpresaB) : 0;
        $kms_total_cargadoCerealFletSur = is_numeric($this->obtenerTotalKMCargado($viajesEmpresaB)) ? $this->obtenerTotalKMCargado($viajesEmpresaB) : 0;
        $porcentaje_cargadoCerealFletSur = is_numeric($this->obtenerPorcentajeCargado($viajesEmpresaB)) ? $this->obtenerPorcentajeCargado($viajesEmpresaB) : 0;


        return
            [
                'kms_MesDonMario' => $kms_MesDonMario,
                'facturado_MesDonMario' => $facturado_MesDonMario,
                'kms_promedio_cargadoDonMario' => $kms_promedio_cargadoDonMario,
                'kms_total_cargadoDonMario' => $kms_total_cargadoDonMario,
                'porcentaje_cargadoDonMario' => $porcentaje_cargadoDonMario,

                'kms_MesCerealFletSur' => $kms_MesCerealFletSur,
                'facturado_MesCerealFletSur' => $facturado_MesCerealFletSur,
                'kms_promedio_cargadoCerealFletSur' => $kms_promedio_cargadoCerealFletSur,
                'kms_total_cargadoCerealFletSur' => $kms_total_cargadoCerealFletSur,
                'porcentaje_cargadoCerealFletSur' => $porcentaje_cargadoCerealFletSur
            ];
    }

    public function showPlanillaFiltrada($request, $id)
    {
        $truck_driver = TruckDriver::find($id);
        $fechaInicio = $request->get('fechaInicio');
        $fechaFin = $request->get('fechaFin');

        $viajes = Viajes::where('truckdriver_id', $id)
            ->where('enCurso', false)
            ->with('combustibles')
            ->whereBetween('fecha_salida', [$fechaInicio, $fechaFin])
            ->orderBy('fecha_salida', 'asc')
            ->get();

        $viajesOrdenados = $viajes->sort(function ($a, $b) {
            $fechaA = Carbon::parse($a->fecha_salida);
            $fechaB = Carbon::parse($b->fecha_salida);
            $esVacioA = $a->esVacio;

            if ($fechaA->eq($fechaB)) {
                return $esVacioA ? -1 : 1;
            }

            return $fechaA->lt($fechaB) ? -1 : 1;
        });

        return
            [
                'truck_driver' => $truck_driver,
                'viajes' => $viajesOrdenados
            ];
    }
}
