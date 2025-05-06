<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Destino extends Model
{
    protected $fillable = ['nombre'];
    public $timestamps = false;
    public function viajes()
    {
        return $this->hasMany(viajes::class, 'destino_id');
    }
}
