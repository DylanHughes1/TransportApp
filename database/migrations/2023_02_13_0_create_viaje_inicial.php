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
        Schema::create('viaje_inicial', function (Blueprint $table) {
            $table->id();
            $table->date('dia1')->nullable();
            $table->string('salida');
            $table->date('dia2')->nullable();
            $table->string('llegada');
            $table->integer('$/TN');
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
        Schema::dropIfExists('viaje_inicial');
    }
};
