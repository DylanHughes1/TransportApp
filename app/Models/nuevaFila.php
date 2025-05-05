<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class nuevaFila extends Model
{
    public $table = "nueva_fila";
    public $timestamps = false;

    protected $fillable = ['nombre', 'valor'];

    public function tabla1s()
    {
        return $this->belongsToMany(Tabla1::class, 'nueva_fila_tabla1');
    }    

    public function tabla3s()
    {
        return $this->belongsToMany(Tabla3::class, 'nueva_fila_tabla3');
    }
}
