<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class TruckDriver extends Authenticatable 
{
    use HasFactory, Notifiable;

    protected $table = 'truck_drivers';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();

        static::created(function ($chofer) {
            // Crear una nueva instancia de tabla1 y asignar el ID del chofer
            $tabla1 = new Tabla1();
            $tabla1->chofer_id = $chofer->id;
            $tabla1->save();

            // Crear una nueva instancia de tabla2 y asignar el ID del chofer
            $tabla2 = new Tabla2();
            $tabla2->chofer_id = $chofer->id;
            $tabla2->save();

            // Crear una nueva instancia de tabla3 y asignar el ID del chofer
            $tabla3 = new Tabla3();
            $tabla3->chofer_id = $chofer->id;
            $tabla3->save();
        });
    }
}
