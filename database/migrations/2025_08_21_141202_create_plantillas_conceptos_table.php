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
        Schema::create('plantillas_conceptos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->decimal('valor_unitario_default', 12, 2)->default(0);
            $table->enum('tipo', ['remunerativo', 'no_remunerativo', 'descuento'])->default('remunerativo');
            $table->timestamps();
        });


        // Pivot para asociar plantillas a una nómina (si hace falta)
        Schema::create('nomina_plantilla', function (Blueprint $table) {
            $table->id();
            $table->foreignId('nomina_id')->constrained('nominas')->onDelete('cascade');
            $table->foreignId('plantilla_concepto_id')->constrained('plantillas_conceptos')->onDelete('cascade');
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
        Schema::dropIfExists('plantillas_conceptos');
    }
};
