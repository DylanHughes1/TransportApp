<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImagenViaje extends Model
{
    protected $table = 'imagenes_viajes';

    public function viaje()
    {
        return $this->belongsTo(Viaje::class, 'viaje_id');
    }
}
