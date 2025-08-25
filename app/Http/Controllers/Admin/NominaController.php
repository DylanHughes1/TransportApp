<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Admin\Sueldo\SueldoService;
use Illuminate\Support\Facades\Log;
use Exception;
use App\Models\{Nomina, AjusteSueldo};
use Illuminate\Support\Facades\Auth;
use App;
use Illuminate\Support\Facades\DB;

class NominaController extends Controller
{
    public function cargarPredeterminadas($nominaId)
    {
        $nomina = Nomina::findOrFail($nominaId);
        try {
            app()->make(SueldoService::class)->poblarLineasPredeterminadas($nomina);
            return redirect()->back()->with('success', 'Filas predeterminadas cargadas.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error cargando filas: ' . $e->getMessage());
        }
    }

    // app/Http/Controllers/NominaController.php
    public function guardar(Request $request, Nomina $nomina)
    { 
        $data = $request->all();

        try {
            DB::transaction(function () use ($data, $nomina) {
                app(SueldoService::class)->guardarNominaCompleta($nomina, $data);
            });

            return response()->json(['success' => true, 'message' => 'Nómina guardada correctamente']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
}
