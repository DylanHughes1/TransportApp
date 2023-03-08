<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RegistroCombustibleSeeder extends Seeder
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
                'Km' => 800,
                'fecha' => '2022-02-20',
                'litros' => 250,
                'lleno' => true,
                'lugar_carga' => 'Azul',
            ],
        ];

        DB::table('registro_combustible')->insert($data);
    }
}
