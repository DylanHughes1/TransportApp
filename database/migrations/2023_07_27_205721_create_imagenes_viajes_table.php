<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImagenesViajesTable extends Migration
{
    public function up()
    {
        Schema::create('imagenes_viajes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('viaje_id');
            $table->string('image_link')->nullable();
            $table->string('image_path')->nullable();
            $table->timestamps();
            
            $table->foreign('viaje_id')->references('id')->on('viajes')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('imagenes_viajes');
    }
}
