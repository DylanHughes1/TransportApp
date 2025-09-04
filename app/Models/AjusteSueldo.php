<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class AjusteSueldo extends Model
{
    protected $table = 'ajustes_sueldo';


    protected $fillable = [
        'sueldo_basico',
        'hs_ext_km_recorrido',
        'perm_f_res',
        'c_descarga',
        'km_1_2',
        'comida',
        'especial',
        'pernoctada',
        'kms_rec',
        'perm_f_res_larga_distancia',
        'cruce_frontera',
        'dia_camionero',
        'vacaciones_anual_x_dia',
        'hs_50',
        'hs_100',
        'valor_x_dia',
        'hora_comun'
    ];


    protected $casts = [
        'sueldo_basico' => 'decimal:2',
        'hs_ext_km_recorrido' => 'decimal:2',
        // (agregar casts para el resto si se desea)
    ];

    protected static function booted()
    {
        static::updated(function (AjusteSueldo $ajuste) {
            // 1) atributos cambiados en este update
            $changes = $ajuste->getChanges();
            if (empty($changes)) return;

            // 2) limitar a keys relevantes (fillable)
            $validKeys = $ajuste->getFillable();
            $keysToPropagar = array_values(array_intersect(array_keys($changes), $validKeys));
            if (empty($keysToPropagar)) return;

            // 3) Propagar a LineaNomina que tengan ajuste_key entre las keys cambiadas
            $lineas = \App\Models\LineaNomina::whereIn('ajuste_key', $keysToPropagar)->get();

            // Actualizamos lineas encontradas
            if ($lineas->isNotEmpty()) {
                // agrupamos por nomina_id para recalcular una sola vez por nómina
                $nominasIds = $lineas->pluck('nomina_id')->unique()->values()->all();

                foreach ($lineas as $linea) {
                    $key = $linea->ajuste_key;
                    if ($key && array_key_exists($key, $changes)) {
                        $nuevoValor = (float) $ajuste->{$key};
                        $linea->valor_unitario = $nuevoValor;
                        $linea->importe = round($linea->cantidad * $nuevoValor, 2);
                        $linea->save();
                    }
                }

                // Recalcular totales por nómina afectada
                foreach ($nominasIds as $nid) {
                    $nom = \App\Models\Nomina::find($nid);
                    if ($nom) {
                        try {
                            $nom->recalcularTotales();
                        } catch (\Throwable $e) {
                            Log::error("Error recalculando nomina {$nid} tras ajuste: " . $e->getMessage());
                        }
                    }
                }
            }

            // 4) Si cambió el sueldo_basico, actualizar snapshots en nóminas que DEPENDEN del snapshot
            if (in_array('sueldo_basico', $keysToPropagar, true)) {
                $nuevoSueldo = (float) $ajuste->sueldo_basico;

                // Buscamos nominas que NO tengan la linea "Sueldo Básico" (asumimos idioma/español)
                $nominasAfectadas = \App\Models\Nomina::whereDoesntHave('lineas', function ($q) {
                    // filtramos por nombre normalizado (minusculas y trim)
                    $q->whereRaw("LOWER(TRIM(nombre)) = ?", ['sueldo básico']);
                })->get();

                foreach ($nominasAfectadas as $nom) {
                    $nom->sueldo_basico_snapshot = $nuevoSueldo;
                    $nom->save();

                    try {
                        $nom->recalcularTotales();
                    } catch (\Throwable $e) {
                        Log::error("Error recalculando nomina {$nom->id} tras update sueldo_basico: " . $e->getMessage());
                    }
                }
            }
        });
    }
}
