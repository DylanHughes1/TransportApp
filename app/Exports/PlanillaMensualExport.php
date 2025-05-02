<?php

namespace App\Exports;

use App\Models\TruckDriver;
use App\Models\viajes;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Carbon\Carbon;

class PlanillaMensualExport implements FromCollection, WithMapping, WithHeadings, WithTitle, WithStyles
{
    protected $id;
    protected $truck_driver_name;
    protected $data;

    public function __construct($id)
    {
        $this->id = $id;
        $this->truck_driver_name = TruckDriver::find($this->id)->name;
        $this->data = $this->prepareData();
    }

    public function collection()
    {
        return collect($this->data);
    }

    public function map($row): array
    {
        return [
            $row['mes'],
            $row['km_recorridos'],
            $row['facturado'],
            $row['promedio_cargado'],
            $row['promedio_total'],
            $row['porcentaje_cargado'] . '%',
        ];
    }

    public function headings(): array
    {
        return [
            'Mes',
            'Km Recorridos',
            'Facturado',
            'Promedio $/KM solo cargado',
            'Promedio $/KM total',
            '% Cargado',
        ];
    }

    public function title(): string
    {
        return 'Planilla Mensual de ' . $this->truck_driver_name;
    }

    public function styles(Worksheet $sheet)
    {
        $lastRow = count($this->data) + 1; 

        for ($row = 1; $row <= $lastRow; $row++) {
            $sheet->getStyle('A' . $row . ':F' . $row)->applyFromArray([
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        'color' => ['argb' => '000000'],
                    ],
                ],
            ]);
        }

        $sheet->getStyle('A1:F1')->getFont()->setBold(true);
        $sheet->getDefaultColumnDimension()->setWidth(26);
    }

    private function prepareData()
    {
        $firstDayOfCurrentMonth = Carbon::now()->startOfMonth();
        $firstDayOfPreviousMonth = Carbon::now()->subMonth()->startOfMonth();
        $lastDayOfPreviousMonth = Carbon::now()->subMonth()->endOfMonth();

        $viajesEsteMes = Viajes::where('truckdriver_id', $this->id)
            ->where('enCurso', false)
            ->with('combustibles')
            ->where('fecha_salida', '>=', $firstDayOfCurrentMonth)
            ->orderBy('fecha_salida', 'asc')
            ->get();

        $viajesMesAnterior = Viajes::where('truckdriver_id', $this->id)
            ->where('enCurso', false)
            ->with('combustibles')
            ->whereBetween('fecha_salida', [$firstDayOfPreviousMonth, $lastDayOfPreviousMonth])
            ->orderBy('fecha_salida', 'asc')
            ->get();

        $costo_totalEsteMes = $this->obtenerFacturadoMes($viajesEsteMes);
        $kms_promedio_cargadoEsteMes = $this->obtenerPromedioKMCargado($viajesEsteMes);
        $kms_total_cargadoEsteMes = $this->obtenerTotalKMCargado($viajesEsteMes);
        $porcentaje_cargadoEsteMes = $this->obtenerPorcentajeCargado($viajesEsteMes);

        $costo_totalMesAnterior = $this->obtenerFacturadoMes($viajesMesAnterior);
        $kms_promedio_cargadoMesAnterior = $this->obtenerPromedioKMCargado($viajesMesAnterior);
        $kms_total_cargadoMesAnterior = $this->obtenerTotalKMCargado($viajesMesAnterior);
        $porcentaje_cargadoMesAnterior = $this->obtenerPorcentajeCargado($viajesMesAnterior);

        return [
            [
                'mes' => ucfirst(Carbon::now()->subMonth()->locale('es')->monthName),
                'km_recorridos' => $viajesMesAnterior->sum('km_viaje'),
                'facturado' => $costo_totalMesAnterior,
                'promedio_cargado' => $kms_promedio_cargadoMesAnterior,
                'promedio_total' => $kms_total_cargadoMesAnterior,
                'porcentaje_cargado' => $porcentaje_cargadoMesAnterior ?? 0,
            ],
            [
                'mes' => ucfirst(Carbon::now()->locale('es')->monthName),
                'km_recorridos' => $viajesEsteMes->sum('km_viaje'),
                'facturado' => $costo_totalEsteMes,
                'promedio_cargado' => $kms_promedio_cargadoEsteMes,
                'promedio_total' => $kms_total_cargadoEsteMes,
                'porcentaje_cargado' => $porcentaje_cargadoEsteMes ?? 0,
            ],
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
}
