<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $fillable = ['nombre'];
    public $timestamps = false;
    public function viajes()
    {
        return $this->hasMany(viajes::class, 'producto_id');
    }
}
