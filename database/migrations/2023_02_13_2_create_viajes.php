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
        Schema::create('viajes', function (Blueprint $table) {
            $table->id();
            $table->date('fecha_salida')->nullable();
            $table->string('origen')->nullable();
            $table->longText('observacion_origen')->nullable();
            $table->date('fecha_llegada')->nullable();          
            $table->integer('km_viaje')->nullable(); ;

            $table->string('destino')->nullable();
            $table->longText('observacion_destino')->nullable();

            $table->decimal('km_salida')->nullable();
            $table->decimal('c_porte')->nullable();
            $table->string('producto')->nullable();
            $table->decimal('carga_kg')->nullable();
            $table->decimal('descarga_kg')->nullable();
            $table->decimal('km_llegada')->nullable();

            $table->decimal('control_desc')->nullable();
            $table->decimal('km_1_2')->nullable();     
             
            $table->longText('observacion')->nullable();

            $table->boolean('enCurso')->nullable()->default(true);

            $table->decimal('TN')->nullable();

            $table->integer('progreso')->default(0);
            $table->integer('progresoSolicitud')->default(0);

            $table->boolean('esVacio')->default(false);

            $table->boolean('viajeInicialCreado')->default(false);
            
            $table->unsignedBigInteger('truckdriver_id')->nullable();
            $table->foreign('truckdriver_id')
                ->references('id')
                ->on('truck_drivers')
                ->onDelete('cascade');
           
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
        Schema::dropIfExists('viajes');
    }
};
