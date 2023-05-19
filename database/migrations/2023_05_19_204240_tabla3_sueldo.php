<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tabla3_sueldo', function (Blueprint $table) {
            
            $table->id();
            $table->decimal('sueldo_basico');

            $table->decimal('viatico_x_km');
            $table->decimal('cruce_frontera');
            $table->decimal('comida');
            $table->decimal('especial');
            $table->decimal('pernoctada');
            $table->decimal('permanencia_fuera_rec');
            $table->decimal('viatico_km_1_2');
            $table->decimal('adicional_vacas_anuales');
            $table->decimal('asignacion_no_remuner');
            
            $table->decimal('total_remun2');
            
            $table->decimal('adelantos');
            $table->decimal('celular');
            $table->decimal('gastos');

            $table->decimal('truckdriver_id');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tabla3_sueldo');
    }
};
