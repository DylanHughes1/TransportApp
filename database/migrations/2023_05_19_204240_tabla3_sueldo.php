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

            $table->string('viatico_x_km_name')->default('Viático por Km recorrido cohef. 1');
            $table->string('cruce_frontera_name')->default('Cruce Frontera');
            $table->string('comida_name')->default('Comida');
            $table->string('especial_name')->default('Especial');
            $table->string('pernoctada_name')->default('Pernoctada');
            $table->string('permanencia_fuera_rec_name')->default('Permanencia fuera residencia habit inc. a)');
            $table->string('viatico_km_1_2_name')->default('Viático KM recorri 1,2');
            $table->string('adicional_vacas_anuales_name')->default('Adicional Vacaciones Anuales 2023');
            $table->string('asignacion_no_remuner_name')->default('Asignación No remuner Cuota - Acuerdo 151221');
            
            $table->decimal('viatico_x_km')->nullable();
            $table->decimal('cruce_frontera')->nullable();
            $table->decimal('comida')->nullable();
            $table->decimal('especial')->nullable();
            $table->decimal('pernoctada')->nullable();
            $table->decimal('permanencia_fuera_rec')->nullable();
            $table->decimal('viatico_km_1_2')->nullable();
            $table->decimal('adicional_vacas_anuales')->nullable();
            $table->decimal('asignacion_no_remuner')->nullable();
            
            $table->decimal('total_remun2')->nullable();
            
            $table->decimal('adelantos')->nullable();
            $table->decimal('celular')->nullable();
            $table->decimal('gastos')->nullable();

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
