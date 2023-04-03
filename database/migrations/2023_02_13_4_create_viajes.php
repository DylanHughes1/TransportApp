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
            $table->date('fecha_llegada')->nullable();          
            $table->integer('km_viaje')->nullable(); ;

            $table->string('destino')->nullable();
            $table->integer('km_salida')->nullable();
            $table->integer('c_porte')->nullable();
            $table->string('producto')->nullable();
            $table->integer('carga_kg')->nullable();
            $table->integer('descarga_kg')->nullable();
            $table->integer('km_llegada')->nullable();

            $table->integer('control_desc')->nullable();
            $table->integer('km_1_2')->nullable();     
            
            $table->boolean('km_vacios')->nullable();  
            $table->integer('peaje')->nullable();  
            $table->boolean('arreglo_pinchadura')->nullable();
            $table->integer('retiro_plata_adelanto')->nullable();
            $table->longText('observacion')->nullable();
            
            $table->unsignedBigInteger('solicitudes_id')->nullable();
            $table->foreign('solicitudes_id')->references('id')->on('solicitudes')->onDelete('cascade');
   
            $table->unsignedBigInteger('truckdriver_id')->nullable();
            $table->foreign('truckdriver_id')
                ->references('id')
                ->on('truck_drivers')
                ->onDelete('cascade');

            $table->unsignedBigInteger('registro_combustible_id')->nullable();
            $table->foreign('registro_combustible_id')->references('id')->on('registro_combustible')->onDelete('cascade');
           
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
