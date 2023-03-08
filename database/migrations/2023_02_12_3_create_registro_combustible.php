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
            $table->integer('Km')->nullable();
            $table->date('fecha')->nullable();
            $table->integer('litros')->nullable();
            $table->boolean('lleno')->nullable();
            $table->String('lugar_carga')->nullable();
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
        Schema::dropIfExists('registro_combustible');
    }
};
