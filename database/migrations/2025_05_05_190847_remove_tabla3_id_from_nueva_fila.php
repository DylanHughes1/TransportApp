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
        Schema::table('nueva_fila', function (Blueprint $table) {
            if (Schema::hasColumn('nueva_fila', 'tabla3_id')) {
                $table->dropForeign(['tabla3_id']); // Asegura que se elimina bien la FK
                $table->dropColumn('tabla3_id'); // Luego eliminás la columna
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('nueva_fila', function (Blueprint $table) {
            $table->foreignId('tabla3_id')
                ->constrained('tabla3_sueldo')
                ->onDelete('cascade');
        });
    }
};
