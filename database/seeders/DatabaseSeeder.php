<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(TruckDriverSeeder::class);
        $this->call(RegistroCombustibleSeeder::class);
        $this->call(SolicitudesSeeder::class);
        $this->call(ViajesSeeder::class);    
        $this->call(AdminSeeder::class);   
        $this->call(datosSueldoSeeder::class);  
    }
}
