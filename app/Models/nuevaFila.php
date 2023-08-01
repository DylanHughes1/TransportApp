<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class nuevaFila extends Model
{
    public $table = "nueva_fila";
    public $timestamps = false;
    public function tabla3()
    {
        return $this->belongsTo(Tabla3::class, 'tabla3_id');
    }
}
