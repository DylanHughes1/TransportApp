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
        Schema::create('solicitudes', function (Blueprint $table) {
            $table->id();
            $table->date('dia1')->nullable();
            $table->string('salida');
            $table->longText('observacion1')->nullable();
            $table->date('dia2')->nullable();
            $table->string('llegada');
            $table->longText('observacion2')->nullable();
            $table->timestamps();

            $table->unsignedBigInteger('truckdriver_id')->nullable();
            $table->foreign('truckdriver_id')->references('id')->on('truck_drivers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('solicitudes');
    }
};
