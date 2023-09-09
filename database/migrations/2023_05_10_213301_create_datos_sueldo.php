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
        Schema::create('datos_sueldo', function (Blueprint $table) {
            $table->id();
            $table->decimal('sueldo_basico');

            $table->decimal('hs_ext_km_recorrido');
            $table->decimal('perm_f_res');
            $table->decimal('c_descarga');
            $table->decimal('km_1_2');

            $table->decimal('comida');
            $table->decimal('especial');
            $table->decimal('pernoctada');

            $table->decimal('kms_rec');
            $table->decimal('perm_f_res_larga_distancia');
            $table->decimal('cruce_frontera');

            $table->decimal('dia_camionero');
            $table->decimal('vacaciones_anual_x_dia');

            $table->decimal('hs_50');
            $table->decimal('hs_100');
            $table->decimal('valor_x_dia');
            $table->decimal('hora_comun');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('datos_sueldo');
    }
};
