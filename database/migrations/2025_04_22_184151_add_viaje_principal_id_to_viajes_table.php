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
        Schema::table('viajes', function (Blueprint $table) {
            $table->unsignedBigInteger('viaje_principal_id')->nullable()->after('id');

            $table->foreign('viaje_principal_id')
                ->references('id')->on('viajes')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('viajes', function (Blueprint $table) {
            $table->dropForeign(['viaje_principal_id']);
            $table->dropColumn('viaje_principal_id');
        });
    }
};
