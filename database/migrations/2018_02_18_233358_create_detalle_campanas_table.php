<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetalleCampanasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_campanas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('vin');
            $table->string('importer_dealer');
            $table->integer('criterio');
            $table->string('fecha_ejecucion_campana')->nullable();
            $table->decimal('labour', 10, 4);
            $table->decimal('parts', 10, 4);
            $table->integer('count')->nullable();
            $table->string('codigo_borrado')->nullable();
            $table->string('column9')->nullable();
            $table->string('column10')->nullable();
            $table->string('column12')->nullable();
            $table->string('dealer_que_ejecuta_campana')->nullable();
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
        Schema::dropIfExists('detalle_camapanas');
    }
}
