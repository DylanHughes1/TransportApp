<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LineaNomina extends Model
{
    protected $table = 'lineas_nomina';


    protected $fillable = [
        'nomina_id',
        'tipo',
        'nombre',
        'cantidad',
        'valor_unitario',
        'importe',
        'porcentaje',
        'es_remunerativo',
        'orden'
    ];


    protected $casts = [
        'cantidad' => 'decimal:2',
        'valor_unitario' => 'decimal:2',
        'importe' => 'decimal:2',
        'porcentaje' => 'decimal:4',
        'es_remunerativo' => 'boolean',
    ];


    // Calcula el importe si no está guardado
    public function calcularImporte(): float
    {
        return round((float)$this->cantidad * (float)$this->valor_unitario, 2);
    }


    public function nomina()
    {
        return $this->belongsTo(Nomina::class, 'nomina_id');
    }


    // Scopes útiles
    public function scopeRemunerativos($query)
    {
        return $query->where('tipo', 'remunerativo');
    }


    public function scopeDescuentos($query)
    {
        return $query->where('tipo', 'descuento');
    }
}
