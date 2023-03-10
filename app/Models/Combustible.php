<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Combustible extends Model
{
    use HasFactory;

    public function solicitudes()
    {
        return $this->belongsTo(Solicitudes::class); 
    }
}
