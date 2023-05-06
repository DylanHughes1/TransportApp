<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Combustible extends Model
{
    use HasFactory;
    public $table = "registro_combustible";

    public function viaje()
    {
        return $this->belongsTo(viajes::class); 
    }

}
