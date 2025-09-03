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
        Schema::create('nominas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('truckdriver_id')->constrained('truck_drivers')->onDelete('cascade');


            $table->date('periodo_desde')->nullable();
            $table->date('periodo_hasta')->nullable();


            // Snapshots y totales
            $table->decimal('sueldo_basico_snapshot', 12, 2)->default(0);
            $table->decimal('subtotal_remunerativo', 14, 2)->default(0);
            $table->decimal('subtotal_no_remunerativo', 14, 2)->default(0);
            $table->decimal('total_descuentos', 14, 2)->default(0);
            $table->decimal('neto', 14, 2)->default(0);


            // json con el detalle del cálculo (opcional, útil para auditoría)
            $table->json('json_snapshot')->nullable();


            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('aprobado_el')->nullable();

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
        Schema::dropIfExists('nominas');
    }
};
