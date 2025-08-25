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
        Schema::create('ajustes_sueldo', function (Blueprint $table) {
            $table->id();
            $table->decimal('sueldo_basico', 12, 2)->default(0);


            $table->decimal('hs_ext_km_recorrido', 12, 2)->default(0);
            $table->decimal('perm_f_res', 12, 2)->default(0);
            $table->decimal('c_descarga', 12, 2)->default(0);
            $table->decimal('km_1_2', 12, 2)->default(0);


            $table->decimal('comida', 12, 2)->default(0);
            $table->decimal('especial', 12, 2)->default(0);
            $table->decimal('pernoctada', 12, 2)->default(0);


            $table->decimal('kms_rec', 12, 2)->default(0);
            $table->decimal('perm_f_res_larga_distancia', 12, 2)->default(0);
            $table->decimal('cruce_frontera', 12, 2)->default(0);


            $table->decimal('dia_camionero', 12, 2)->default(0);
            $table->decimal('vacaciones_anual_x_dia', 12, 2)->default(0);


            $table->decimal('hs_50', 12, 2)->default(0);
            $table->decimal('hs_100', 12, 2)->default(0);
            $table->decimal('valor_x_dia', 12, 2)->default(0);
            $table->decimal('hora_comun', 12, 2)->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ajustes_sueldo');
    }
};
