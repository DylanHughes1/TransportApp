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
        Schema::create('tabla1_sueldo', function (Blueprint $table) {

            $table->id();
            $table->decimal('sueldo_basico');

            $table->decimal('hs_ext_km_recorrido');
            $table->decimal('hs_ext_km_recorrido_100');
            $table->decimal('perm_f_res');
            $table->decimal('c_descarga');
            $table->decimal('hs_50');
            $table->decimal('hs_100');
            $table->decimal('inasistencias_inj');
            $table->decimal('subtotal1');

            $table->decimal('antig');
            $table->decimal('vacaciones');

            $table->decimal('total_remun1');
            
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
        Schema::dropIfExists('tabla1_sueldo');
    }
};
