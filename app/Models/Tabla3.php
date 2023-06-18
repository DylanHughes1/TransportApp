<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tabla3 extends Model
{
    use HasFactory;
    public $table = "tabla3_sueldo";
    public $timestamps = false;
    public function truckdriver()
    {
        return $this->belongsTo(TruckDriver::class); 
    }
}
