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
        Schema::create('tabla2_sueldo', function (Blueprint $table) {
            
            $table->id();
            $table->decimal('sueldo_basico');

            $table->decimal('jubilacion');
            $table->decimal('obra_social');
            $table->decimal('cuota_solidaria');
            $table->decimal('ley_19032');
            $table->decimal('seguro_sepelio');
            $table->decimal('aju_apo_dto');
            $table->decimal('asoc_mut_1nov');
            $table->decimal('total_descuento');
            
            $table->decimal('subtotal2');

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
        Schema::dropIfExists('tabla2_sueldo');
    }
};
