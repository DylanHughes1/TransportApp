<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tabla3 extends Model
{
    use HasFactory;
    public $table = "tabla3_sueldo";
    protected $fillable = [
        'truckdriver_id',
        'viatico_x_km_name',
        'cruce_frontera_name',
        'comida_name',
        'especial_name',
        'pernoctada_name',
        'permanencia_fuera_rec_name',
        'viatico_km_1_2_name',
        'adicional_vacas_anuales_name',
        'asignacion_no_remuner_name',
    ];
    public $timestamps = false;
    public function truckdriver()
    {
        return $this->belongsTo(TruckDriver::class);
    }

    public function nuevasFilas()
    {
        return $this->belongsToMany(nuevaFila::class, 'nueva_fila_tabla3');
    }
}
