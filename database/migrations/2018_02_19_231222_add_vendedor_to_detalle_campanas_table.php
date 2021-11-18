<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddVendedorToDetalleCampanasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('detalle_campanas', function (Blueprint $table) {
            $table->string('vendedor')->after('importer_dealer');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('detalle_campanas', function (Blueprint $table) {
            $table->dropColumn('vendedor');
        });
    }
}
