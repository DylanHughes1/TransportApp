<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class datosSueldoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
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
                
            ],
        ];

        
        DB::table('datos_sueldo')->insert($data);
    }
}
