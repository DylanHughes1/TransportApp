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
        Schema::create('nueva_fila_tabla3', function (Blueprint $table) {
            $table->id();
            $table->foreignId('nueva_fila_id')->constrained('nueva_fila')->onDelete('cascade');
            $table->foreignId('tabla3_id')->constrained('tabla3_sueldo')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nueva_fila_tabla3');
    }
};
