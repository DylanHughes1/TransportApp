<?php
namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class PlanillaExportMultiple implements WithMultipleSheets
{
    protected $id;
    protected $fechaInicio;
    protected $fechaFin;

    public function __construct($id, $fechaInicio = null, $fechaFin = null)
    {
        $this->id = $id;
        $this->fechaInicio = $fechaInicio;
        $this->fechaFin = $fechaFin;
    }

    public function sheets(): array
    {
        return [
            new PlanillaExport($this->id, $this->fechaInicio, $this->fechaFin),
            new CombustibleExport($this->id, $this->fechaInicio, $this->fechaFin),
        ];
    }
}
