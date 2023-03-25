<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
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
                'name' => 'Lucas Vasquez Conti',
                'email' => 'lucas_vasquez@gmail.com',
                'password' => bcrypt('password1'),
            ],
        ];

        DB::table('admins')->insert($data);
    }
}