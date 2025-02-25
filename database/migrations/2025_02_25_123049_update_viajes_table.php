<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('viajes', function (Blueprint $table) {
            // Eliminar las columnas antiguas
            $table->dropColumn(['origen', 'destino', 'producto']);

            // Agregar las nuevas claves foráneas
            $table->unsignedBigInteger('origen_id')->nullable()->after('fecha_salida');
            $table->foreign('origen_id')->references('id')->on('origenes')->onDelete('set null');

            $table->unsignedBigInteger('destino_id')->nullable()->after('km_viaje');
            $table->foreign('destino_id')->references('id')->on('destinos')->onDelete('set null');

            $table->unsignedBigInteger('producto_id')->nullable()->after('c_porte');
            $table->foreign('producto_id')->references('id')->on('productos')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('viajes', function (Blueprint $table) {
            // Revertir los cambios
            $table->dropForeign(['origen_id']);
            $table->dropColumn('origen_id');

            $table->dropForeign(['destino_id']);
            $table->dropColumn('destino_id');

            $table->dropForeign(['producto_id']);
            $table->dropColumn('producto_id');

            // Volver a agregar las columnas antiguas
            $table->string('origen')->nullable();
            $table->string('destino')->nullable();
            $table->string('producto')->nullable();
        });
    }
};
