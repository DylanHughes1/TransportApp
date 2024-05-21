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
class PlanillaFiltradaExport implements FromCollection, WithMapping, WithHeadings, WithStyles, WithTitle
{

    protected $id;
    protected $truck_driver_name;
    protected $viajes;
    public function __construct($parametro1, $parametro2, $parametro3)
    {
        $this->id = $parametro1;
        $this->truck_driver_name = TruckDriver::find($this->id)->name;
        $this->fechaInicio = $parametro2;
        $this->fechaFin = $parametro3;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $viajes = Viajes::where('truckdriver_id', $this->id)
            ->where('enCurso', false)
            ->with('combustibles')
            ->whereBetween('fecha_salida', [$this->fechaInicio, $this->fechaFin])
            ->orderBy('fecha_salida', 'asc')
            ->get();

        $viajesOrdenados = $viajes->sort(function ($a, $b) {
            $fechaA = \Carbon\Carbon::parse($a->fecha_salida);
            $fechaB = \Carbon\Carbon::parse($b->fecha_salida);
            $esVacioA = $a->esVacio;

            if ($fechaA->eq($fechaB)) {
                return $esVacioA ? -1 : 1;
            }

            return $fechaA->lt($fechaB) ? -1 : 1;
        });


        return $viajesOrdenados;
    }

    public function title(): string
    {
        return 'Planilla de ' . $this->truck_driver_name;
    }
    public function headings(): array
    {
        // Puedes ajustar los encabezados según tus necesidades.
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
            'Distancia',
            '$/TN',
            'FAC.',
            '$/KM',
        ];
    }

    public function map($viaje): array
    {

        $resultado = $viaje->km_llegada - $viaje->km_salida !== 0
            ? number_format((($viaje->carga_kg / 1000) * $viaje->TN) / ($viaje->km_llegada - $viaje->km_salida), 2)
            : 'N/A';

        return [
            $viaje->fecha_salida,
            $viaje->origen,
            $viaje->km_viaje,
            $viaje->km_salida,
            $viaje->destino,
            $viaje->fecha_llegada,
            $viaje->km_llegada,
            $viaje->producto,
            $viaje->carga_kg,
            $viaje->km_viaje,
            $viaje->TN,
            ($viaje->carga_kg / 1000) * $viaje->TN,
            $resultado,

        ];
    }
    public function styles(Worksheet $sheet)
    {
        $lastRow = $this->viajes + 1;

        // Aplicar bordes a todas las filas
        for ($row = 1; $row <= $lastRow; $row++) {
            $sheet->getStyle('A' . $row . ':M' . $row)->applyFromArray([
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
