<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Combustible;

class viajes extends Model
{
    use HasFactory;

    public function chofer()
    {
        return $this->hasOne(TruckDriver::class);
    }

    public function combustibles()
    {
        return $this->hasMany(Combustible::class, 'viaje_id');
    }

    public function imagenesViajes()
    {
        return $this->hasMany(ImagenViaje::class, 'viaje_id');
    }
    

}
