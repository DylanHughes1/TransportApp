<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nomina extends Model
{
    protected $table = 'nominas';


    protected $fillable = [
        'truckdriver_id',
        'periodo_desde',
        'periodo_hasta',
        'sueldo_basico_snapshot',
        'subtotal_remunerativo',
        'subtotal_no_remunerativo',
        'total_descuentos',
        'adelantos',
        'celular',
        'gastos',
        'neto',
        'json_snapshot',
        'created_by',
        'aprobado_el',
    ];


    protected $casts = [
        'sueldo_basico_snapshot' => 'decimal:2',
        'subtotal_remunerativo' => 'decimal:2',
        'subtotal_no_remunerativo' => 'decimal:2',
        'total_descuentos' => 'decimal:2',
        'neto' => 'decimal:2',
        'json_snapshot' => 'array',
        'aprobado_el' => 'datetime',
    ];


    public function chofer()
    {
        return $this->belongsTo(Truckdriver::class, 'truckdriver_id');
    }


    public function lineas()
    {
        return $this->hasMany(LineaNomina::class, 'nomina_id');
    }


    public function plantillas()
    {
        return $this->belongsToMany(PlantillaConcepto::class, 'nomina_plantilla', 'nomina_id', 'plantilla_concepto_id');
    }

    public function recalcularTotales()
    {
        $lineas = $this->lineas()->get();

        $tieneSueldoLinea = $lineas->first(function ($l) {
            return mb_strtolower(trim($l->nombre)) === 'sueldo básico';
        }) ? true : false;

        // subtotal remunerativo (si hay una linea 'Sueldo Básico' ya está incluida)
        $subtotalRem = $lineas->where('tipo', 'remunerativo')->sum('importe');

        // subtotal no remunerativo
        $subtotalNoRem = $lineas->where('tipo', 'no_remunerativo')->sum('importe');

        // descuentos: manejar porcentuales (pueden estar guardados como 11.00 o 0.11)
        $totalDescuentos = 0;
        foreach ($lineas->where('tipo', 'descuento') as $d) {
            $porc = $d->porcentaje;
            if ($porc !== null && $porc !== '') {
                // si persisten como 11.00 (ejemplo) convertimos a fracción
                $porcFloat = (float) $porc;
                if ($porcFloat > 1) {
                    $porcFloat = $porcFloat / 100.0;
                }
                $importeDesc = round($subtotalRem * $porcFloat, 2);
            } else {
                $importeDesc = (float) $d->importe;
            }
            $totalDescuentos += $importeDesc;
        }

        $subtotal2 = round($subtotalRem - $totalDescuentos, 2);

        // Si tenés campos extras en la nomina (adelantos/celular/gastos) restalos aquí:
        $otros = 0;
        if (isset($this->adelantos)) $otros += (float)$this->adelantos;
        if (isset($this->celular)) $otros += (float)$this->celular;
        if (isset($this->gastos)) $otros += (float)$this->gastos;

        $neto = round($subtotal2 + $subtotalNoRem - $otros, 2);

        // Actualiza la nómina
        $this->update([
            'subtotal_remunerativo' => $subtotalRem,
            'subtotal_no_remunerativo' => $subtotalNoRem,
            'total_descuentos' => $totalDescuentos,
            'neto' => $neto,
        ]);

        return [
            'subtotal_remunerativo' => $subtotalRem,
            'subtotal_no_remunerativo' => $subtotalNoRem,
            'total_descuentos' => $totalDescuentos,
            'subtotal2' => $subtotal2,
            'otros' => $otros,
            'neto' => $neto,
        ];
    }
}
