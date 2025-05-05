<?php

namespace App\Exports;

use App\Models\TruckDriver;
use App\Models\viajes;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithTitle;


//ini_set('memory_limit', '44M');
class PlanillaExport implements FromCollection, WithMapping, WithHeadings, WithStyles, WithTitle
{

    protected $id;
    protected $truck_driver_name;
    protected $viajes;
    protected $fechaInicio;
    protected $fechaFin;

    public function __construct($parametro1, $fechaInicio = null, $fechaFin = null)
    {
        $this->id = $parametro1;
        $this->truck_driver_name = TruckDriver::find($this->id)->name;
        $this->fechaInicio = $fechaInicio;
        $this->fechaFin = $fechaFin;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $query = viajes::where('truckdriver_id', $this->id)
            ->where('enCurso', false)
            ->with(['combustibles', 'viajesAsociados']);

        if ($this->fechaInicio && $this->fechaFin) {
            $query->whereBetween('fecha_llegada', [$this->fechaInicio, $this->fechaFin]);
        }

        $viajes = $query->orderBy('fecha_llegada', 'asc')->get();
        $this->viajes = count($viajes);

        return $viajes->sort(function ($a, $b) {
            return \Carbon\Carbon::parse($a->fecha_llegada)->lt($b->fecha_llegada) ? -1 : 1;
        });
    }

    public function title(): string
    {
        return 'Planilla de ' . $this->truck_driver_name;
    }
    public function headings(): array
    {
        return [
            'Fecha Salida',
            'Origen',
            'Km',
            'Km Salida',
            'Destino',
            'Fecha llegada',
            'Km llegada',
            'Producto',
            'Carga (KG)',
            '$/TN',
            'FAC.',
            '$/KM',
            'Km Totales (Vacío + Carga)',
        ];
    }

    public function map($viaje): array
    {

        $resultado = $viaje->km_llegada - $viaje->km_salida !== 0
            ? number_format((($viaje->carga_kg / 1000) * $viaje->TN) / ($viaje->km_llegada - $viaje->km_salida), 2)
            : 'N/A';

        $kmTotales = 'N/A';

        if (!$viaje->esVacio && $viaje->viaje_principal_id === null) {
            $kmTotales = $viaje->km_viaje;

            if ($viaje->relationLoaded('viajesAsociados')) {
                $kmTotales += $viaje->viajesAsociados->sum('km_viaje');
            } else {
                $kmTotales += $viaje->viajesAsociados()->sum('km_viaje');
            }
        }

        return [
            $viaje->fecha_salida,
            $viaje->origen->nombre,
            $viaje->km_viaje,
            $viaje->km_salida,
            $viaje->destino->nombre,
            $viaje->fecha_llegada,
            $viaje->km_llegada,
            $viaje->producto?->nombre,
            $viaje->carga_kg,
            $viaje->TN,
            ($viaje->carga_kg / 1000) * $viaje->TN,
            $resultado,
            $kmTotales,

        ];
    }
    public function styles(Worksheet $sheet)
    {
        $lastRow = $this->viajes + 1;

        for ($row = 1; $row <= $lastRow; $row++) {
            $sheet->getStyle('A' . $row . ':N' . $row)->applyFromArray([
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => 'thin',
                        'color' => ['argb' => '000000'],
                    ],
                ],
            ]);
        }

        $sheet->getDefaultColumnDimension()->setWidth(15);

        return [
            1 => [
                'font' => ['bold' => true],
            ],
        ];
    }
}
