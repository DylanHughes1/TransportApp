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
        'neto',
        'json_snapshot',
        'created_by',
        'aprobado_el'
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
}
