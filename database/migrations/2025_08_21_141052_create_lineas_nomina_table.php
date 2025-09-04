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
        Schema::create('lineas_nomina', function (Blueprint $table) {
            $table->id();
            $table->foreignId('nomina_id')->constrained('nominas')->onDelete('cascade');


            // tipo: remunerativo, no_remunerativo, descuento
            $table->enum('tipo', ['remunerativo', 'no_remunerativo', 'descuento'])->default('remunerativo');


            $table->string('nombre');
            $table->decimal('cantidad', 12, 2)->default(0);
            $table->decimal('valor_unitario', 12, 2)->default(0);
            $table->decimal('importe', 14, 2)->default(0); // cantidad * valor_unitario (guardado)


            // para descuentos porcentuales: guardar el porcentaje si aplica
            $table->decimal('porcentaje', 8, 4)->nullable(); // ej 0.11 para 11% (o guardar 11.00 y usar /100 en código)


            $table->boolean('es_remunerativo')->default(true);
            $table->integer('orden')->default(0);

            $table->string('ajuste_key')->nullable();
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
        Schema::dropIfExists('lineas_nomina');
    }
};
