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
        Schema::table('lineas_nomina', function (Blueprint $table) {
            Schema::table('lineas_nomina', function (Blueprint $table) {
                if (! Schema::hasColumn('lineas_nomina', 'ajuste_key')) {
                    $table->string('ajuste_key')->nullable()->after('orden');
                    $table->index('ajuste_key', 'lineas_nomina_ajuste_key_index');
                }
            });
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('lineas_nomina', function (Blueprint $table) {
            Schema::table('lineas_nomina', function (Blueprint $table) {
                if (Schema::hasColumn('lineas_nomina', 'ajuste_key')) {
                    $table->dropIndex('lineas_nomina_ajuste_key_index'); // nombre del índice
                    $table->dropColumn('ajuste_key');
                }
            });
        });
    }
};
