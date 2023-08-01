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
        Schema::create('nueva_fila', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tabla3_id');
            $table->string('nombre');
            $table->decimal('valor');
            $table->timestamps();

            $table->foreign('tabla3_id')->references('id')->on('tabla3_sueldo')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nueva_fila');
    }
};
