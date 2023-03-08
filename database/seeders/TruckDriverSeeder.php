<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TruckDriverSeeder extends Seeder
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
                'name' => 'Dylan Hughes',
                'email' => 'dylan_21174@hotmail.com',
                'password' => bcrypt('passwd'),
            ],
        ];

        DB::table('truck_drivers')->insert($data);
    }
}
