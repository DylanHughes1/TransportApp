<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Tabla3Seeder extends Seeder
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
                'viatico_x_km' => 8226,
                'cruce_frontera' => 0,
                'truckdriver_id' => 1,
            ],
        ];

        DB::table('tabla3_sueldo')->insert($data);
    }
}