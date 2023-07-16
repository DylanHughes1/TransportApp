<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Combustible;

class viajes extends Model
{
    use HasFactory;

    public function solicitudes()
    {
        return $this->belongsTo(Solicitudes::class); 
    }

    public function chofer()
    {
        return $this->solicitud()->belongsTo(TruckDriver::class);
    }

}
