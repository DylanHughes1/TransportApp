<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Origen extends Model
{
    use HasFactory;
    protected $table = 'origenes';
    protected $fillable = ['nombre'];
    public $timestamps = false;
    public function viajes()
    {
        return $this->hasMany(viajes::class, 'origen_id');
    }
}
