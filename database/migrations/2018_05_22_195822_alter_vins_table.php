<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterVinsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vins', function (Blueprint $table) {
            $table->string('lineas_afectadas_por_campanas')->nullable()->after('created_by');
            $table->date('fecha_inicio_campana')->nullable()->after('lineas_afectadas_por_campanas');
            $table->string('modelos_vehiculos_afectados')->nullable()->after('fecha_inicio_campana');
            $table->longText('info_adicional')->nullable()->after('modelos_vehiculos_afectados');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('vins', function (Blueprint $table) {
            $table->dropColumn(['lineas_afectadas_por_campanas', 'fecha_inicio_campana', 'modelos_vehiculos_afectados', 'info_adicional']);
        });
    }
}
