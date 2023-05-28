<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Tabla2Seeder extends Seeder
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
                'jubilacion' => 11,
                'obra_social' => 3,
                'cuota_solidaria' => 3,
                'truckdriver_id' => 1,
            ],
        ];

        DB::table('tabla2_sueldo')->insert($data);
    }
}