<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use App\Models\viajes;

class CombustibleExport implements FromCollection, WithHeadings, WithTitle, WithStyles
{
    protected $id;
    protected $rows;
    protected $fechaInicio;
    protected $fechaFin;

    public function __construct($truckDriverId, $fechaInicio = null, $fechaFin = null)
    {
        $this->id = $truckDriverId;
        $this->fechaInicio = $fechaInicio;
        $this->fechaFin = $fechaFin;

        $query = viajes::where('truckdriver_id', $this->id)
            ->with('combustibles');

        if ($this->fechaInicio && $this->fechaFin) {
            $query->whereBetween('fecha_llegada', [$this->fechaInicio, $this->fechaFin]);
        }

        $this->rows = $query->get()
            ->flatMap(function ($viaje) {
                return $viaje->combustibles->map(function ($combustible) use ($viaje) {
                    return [
                        'Fecha' => $combustible->fecha,
                        'Kilometraje' => $combustible->Km,
                        'Litros' => $combustible->litros,
                        'Lugar de carga' => $combustible->lugar_carga,
                        'Viaje ID' => $viaje->id,
                        'Destino' => $viaje->destino->nombre ?? '',
                    ];
                });
            });
    }

    public function collection()
    {
        return collect($this->rows);
    }

    public function headings(): array
    {
        return ['Fecha', 'Kilometraje', 'Litros', 'Lugar de carga', 'Viaje ID', 'Destino'];
    }

    public function title(): string
    {
        return 'Combustible';
    }

    public function styles(Worksheet $sheet)
    {

        for ($row = 1; $row <= 6; $row++) {
            $sheet->getStyle('A' . $row . ':F' . $row)->applyFromArray([
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => 'thin',
                        'color' => ['argb' => '000000'],
                    ],
                ],
            ]);
        }

        $sheet->getDefaultColumnDimension()->setWidth(15);
        $sheet->getStyle('A1:F1')->getFont()->setBold(true);
    }
}
