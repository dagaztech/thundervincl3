<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVinsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vins', function (Blueprint $table) {
            $table->increments('id');
            $table->string('vines');
            $table->string('campana');
            $table->string('vendedor');
            $table->string('ano');
            $table->string('modelo');
            $table->string('ciudad');
            $table->string('atendido');
            $table->integer('created_by');
            $table->softDeletes(); 
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
        Schema::dropIfExists('vins');
    }
}
