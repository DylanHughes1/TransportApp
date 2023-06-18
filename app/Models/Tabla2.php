<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tabla2 extends Model
{
    use HasFactory;
    public $table = "tabla2_sueldo";
    public $timestamps = false;
    public function truckdriver()
    {
        return $this->belongsTo(TruckDriver::class); 
    }
}
