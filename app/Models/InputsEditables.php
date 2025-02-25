<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InputsEditables extends Model
{
    protected $table = 'inputs_editables';
    protected $fillable = [
        'origen',
        'destino',
    ];


}
