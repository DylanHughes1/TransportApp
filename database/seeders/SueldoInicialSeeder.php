<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use App\Models\AjusteSueldo;
use App\Models\Nomina;
use App\Models\TruckDriver;
use App\Services\Admin\Sueldo\SueldoService;

class SueldoInicialSeeder extends Seeder
{
    public function run(): void
    {
        $this->command->info('Iniciando SueldoInicialSeeder unificado...');

        // 1) Asegurar AjusteSueldo (valores por defecto; ajustalos a tus números)
        if (AjusteSueldo::count() === 0) {
            AjusteSueldo::create([
                'sueldo_basico' => 102667.41,
                'hs_ext_km_recorrido' => 8.21356,
                'perm_f_res' => 2906.09,
                'c_descarga' => 4277.81,
                'km_1_2' => 9.85627,
                'comida' => 1570.98,
                'especial' => 788.31,
                'pernoctada' => 1829.75,
                'kms_rec' => 8.21356,
                'perm_f_res_larga_distancia' => 5544.20,
                'cruce_frontera' => 3818.08,
                'dia_camionero' => 4277.81,
                'vacaciones_anual_x_dia' => 2398.23,
                'hs_50' => 802.09,
                'hs_100' => 1069.45,
                'valor_x_dia' => 4277.81,
                'hora_comun' => 534.72,
            ]);
            $this->command->info('AjusteSueldo creado con valores por defecto.');
        } else {
            $this->command->info('AjusteSueldo ya existente - se mantiene.');
        }

        // 2) Asegurar plantillas (llama al seeder dedicado)
        // $this->call(\Database\Seeders\PlantillasConceptosSeeder::class);

        // 3) Crear una nómina de ejemplo para el primer chofer (si existe)
        $chofer = TruckDriver::first();
        if (! $chofer) {
            $this->command->info('No se encontró chofer. Se omite creación de nómina de ejemplo.');
            return;
        }

        $ajustes = AjusteSueldo::first();

        $hoy = now();
        $periodoDesde = $hoy->copy()->startOfMonth()->toDateString();
        $periodoHasta = $hoy->copy()->endOfMonth()->toDateString();

        $nomina = Nomina::firstOrCreate(
            [
                'truckdriver_id' => $chofer->id,
                'periodo_desde' => $periodoDesde,
                'periodo_hasta' => $periodoHasta,
            ],
            [
                'sueldo_basico_snapshot' => $ajustes->sueldo_basico ?? 0,
                'subtotal_remunerativo' => 0,
                'subtotal_no_remunerativo' => 0,
                'total_descuentos' => 0,
                'neto' => 0,
            ]
        );

        // 4) Poblar la nomina con las plantillas (si no tiene lineas)
        // if ($nomina->lineas()->count() === 0) {
        //     $sueldoService = app()->make(SueldoService::class);
        //     if (method_exists($sueldoService, 'poblarLineasDesdePlantillas')) {
        //         $sueldoService->poblarLineasDesdePlantillas($nomina);
        //         $this->command->info("Nómina de ejemplo (id: {$nomina->id}) poblada desde plantillas.");
        //     } else {
        //         $this->command->warn('El servicio no implementa poblarLineasDesdePlantillas. Implementalo en SueldoService.');
        //     }
        // } else {
        //     $this->command->info("La nómina (id: {$nomina->id}) ya tiene líneas. Se omitió el poblado.");
        // }

        $this->command->info('SueldoInicialSeeder finalizado.');
    }
}