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
        Schema::create('registro_combustible', function (Blueprint $table) {
            $table->id();
            $table->decimal('Km')->nullable();
            $table->date('fecha')->nullable();
            $table->decimal('litros')->nullable();
            $table->boolean('lleno')->nullable();
            $table->String('lugar_carga')->nullable();
            $table->timestamps();

            $table->unsignedBigInteger('viaje_id')->nullable();
            $table->foreign('viaje_id')->references('id')->on('viajes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('registro_combustible');
    }
};
