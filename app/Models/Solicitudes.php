<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Solicitudes extends Model
{
    use HasFactory;

    public function truckdriver()
    {
        return $this->belongsTo(TruckDriver::class); 
    }

    public function viaje()
    {
        return $this->belongsTo(viajes::class); 
    }
}
