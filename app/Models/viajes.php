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
        return $this->hasOne(TruckDriver::class, 'truckdriver_id');
    }

    public function combustibles()
    {
        return $this->hasMany(Combustible::class, 'viaje_id');
    }

    public function imagenesViajes()
    {
        return $this->hasMany(ImagenViaje::class, 'viaje_id');
    }

    public function origen()
    {
        return $this->belongsTo(Origen::class, 'origen_id');
    }

    public function destino()
    {
        return $this->belongsTo(Destino::class, 'destino_id');
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'producto_id');
    }

    public function viajePrincipal()
    {
        return $this->belongsTo(Viajes::class, 'viaje_principal_id');
    }

    public function viajesAsociados()
    {
        return $this->hasMany(Viajes::class, 'viaje_principal_id');
    }
}
