<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SolicitudesSeeder extends Seeder
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
                'dia1' => '2022-02-20',
                'salida' => 'Bahia Blanca',
                'observacion1' => 'A la noche',
                'dia2' => '2022-02-21',
                'llegada' => 'Buenos Aires',
                'observacion2' => 'A la mañana',
                'truckdriver_id' => 1
            ],
        ];

        DB::table('solicitudes')->insert($data);
    }
}
