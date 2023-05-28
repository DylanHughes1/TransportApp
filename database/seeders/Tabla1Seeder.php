<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Tabla1Seeder extends Seeder
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
                'hs_ext_km_recorrido' => 8226,
                'hs_ext_km_recorrido_100' => 337,
                'perm_f_res' => 0,
                'truckdriver_id' => 1,
            ],
        ];

        DB::table('tabla1_sueldo')->insert($data);
    }
}