<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlantillaConcepto extends Model
{
    protected $table = 'plantillas_conceptos';


    protected $fillable = ['nombre', 'valor_unitario_default', 'tipo'];


    protected $casts = [
        'valor_unitario_default' => 'decimal:2'
    ];


    public function nominas()
    {
        return $this->belongsToMany(Nomina::class, 'nomina_plantilla', 'plantilla_concepto_id', 'nomina_id');
    }
}
