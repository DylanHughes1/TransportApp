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

            $table->decimal('jubilacion')->nullable();
            $table->decimal('obra_social')->nullable();
            $table->decimal('cuota_solidaria')->nullable();
            $table->decimal('ley_19032')->nullable();
            $table->decimal('seguro_sepelio')->nullable();
            $table->decimal('aju_apo_dto')->nullable();
            $table->decimal('asoc_mut_1nov')->nullable();
            $table->decimal('total_descuento')->nullable();
            
            $table->decimal('subtotal2')->nullable();

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
