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
        Schema::create('tabla1_sueldo', function (Blueprint $table) {

            $table->id();

            $table->decimal('hs_ext_km_recorrido')->nullable();
            $table->decimal('hs_ext_km_recorrido_100')->nullable();
            $table->decimal('perm_f_res')->nullable();
            $table->decimal('c_descarga')->nullable();
            $table->decimal('hs_50')->nullable();
            $table->decimal('hs_100')->nullable();
            $table->decimal('inasistencias_inj')->nullable();
            $table->decimal('subtotal1')->nullable();

            $table->decimal('antig')->nullable();
            $table->decimal('vacaciones')->nullable();

            $table->decimal('total_remun1')->nullable();
            
            $table->decimal('truckdriver_id');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tabla1_sueldo');
    }
};
