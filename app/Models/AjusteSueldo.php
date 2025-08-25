<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AjusteSueldo extends Model
{
    protected $table = 'ajustes_sueldo';


    protected $fillable = [
        'sueldo_basico',
        'hs_ext_km_recorrido',
        'perm_f_res',
        'c_descarga',
        'km_1_2',
        'comida',
        'especial',
        'pernoctada',
        'kms_rec',
        'perm_f_res_larga_distancia',
        'cruce_frontera',
        'dia_camionero',
        'vacaciones_anual_x_dia',
        'hs_50',
        'hs_100',
        'valor_x_dia',
        'hora_comun'
    ];


    protected $casts = [
        'sueldo_basico' => 'decimal:2',
        'hs_ext_km_recorrido' => 'decimal:2',
        // (agregar casts para el resto si se desea)
    ];
}
