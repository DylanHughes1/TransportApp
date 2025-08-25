<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PlantillaConcepto;

class PlantillasConceptosSeeder extends Seeder
{
    public function run(): void
    {
        $this->command->info('Iniciando PlantillasConceptosSeeder...');

        $conceptos = [
            // REMUNERATIVOS (nombres)
            ['nombre' => 'Hs Extraordinarias por km recorrido', 'tipo' => 'remunerativo'],
            ['nombre' => 'Hs Extraord. por km recorrido - 100%', 'tipo' => 'remunerativo'],
            ['nombre' => 'Permanencia fuera Resid. Habit inc.b)', 'tipo' => 'remunerativo'],
            ['nombre' => 'Control descarga', 'tipo' => 'remunerativo'],
            ['nombre' => 'Horas extras al 50%', 'tipo' => 'remunerativo'],
            ['nombre' => 'Horas extras al 100%', 'tipo' => 'remunerativo'],
            ['nombre' => 'Inasistencias Justificadas', 'tipo' => 'remunerativo'],
            ['nombre' => 'Día del Camionero (15 diciembre)', 'tipo' => 'remunerativo'],
            ['nombre' => 'Antigüedad', 'tipo' => 'remunerativo'],
            ['nombre' => 'Vacaciones Anuales', 'tipo' => 'remunerativo'],

            // DESCUENTOS (guardamos porcentaje por defecto cuando aplique)
            ['nombre' => 'Jubilación', 'tipo' => 'descuento', 'valor_unitario_default' => 1.00],
            ['nombre' => 'Obra Social', 'tipo' => 'descuento', 'valor_unitario_default' => 1.00],
            ['nombre' => 'Cuota Solidaria', 'tipo' => 'descuento', 'valor_unitario_default' => 3.00],
            ['nombre' => 'Ley 19032', 'tipo' => 'descuento', 'valor_unitario_default' => 3.00],
            ['nombre' => 'Seguro Sepelio', 'tipo' => 'descuento', 'valor_unitario_default' => 1.00],
            ['nombre' => 'AJU.APO.DTO.561/19', 'tipo' => 'descuento', 'valor_unitario_default' => 1.00],
            ['nombre' => 'ASOC.MUT.1NOV.PMOS', 'tipo' => 'descuento', 'valor_unitario_default' => 1.00],

            // NO REMUNERATIVOS
            ['nombre' => 'Viático por Km recorrido coef. 1', 'tipo' => 'no_remunerativo'],
            ['nombre' => 'Cruce Frontera', 'tipo' => 'no_remunerativo'],
            ['nombre' => 'Comida', 'tipo' => 'no_remunerativo'],
            ['nombre' => 'Especial', 'tipo' => 'no_remunerativo'],
            ['nombre' => 'Pernoctada', 'tipo' => 'no_remunerativo'],
            ['nombre' => 'Permanencia fuera residencia habit inc. a)', 'tipo' => 'no_remunerativo'],
            ['nombre' => 'Viático KM recori 1,2', 'tipo' => 'no_remunerativo'],
            ['nombre' => 'Adicional Vacaciones Anuales 2023', 'tipo' => 'no_remunerativo'],
            ['nombre' => 'Asignación No remuner Cuota - Acuerdo 151', 'tipo' => 'no_remunerativo'],
        ];

        foreach ($conceptos as $c) {
            $data = ['tipo' => $c['tipo']];

            if (isset($c['valor_unitario_default'])) {
                $data['valor_unitario_default'] = $c['valor_unitario_default'];
            }

            PlantillaConcepto::updateOrCreate(['nombre' => $c['nombre']], $data);
            $this->command->info("Plantilla creada/actualizada: {$c['nombre']} ({$c['tipo']})");
        }

        $this->command->info('PlantillasConceptosSeeder finalizado.');
    }
}
