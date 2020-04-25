<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEquiposTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('equipos', function (Blueprint $table) {
            $table->id();
            $table->string('nro_equipo');
            $table->string('modelo');
            $table->string('imagen');
            $table->boolean('es_calibrable');
            $table->float('emp');
            $table->float('apreciacion');
            $table->string('rango');
            $table->unsignedBigInteger('tipo_equipo_id');
            $table->unsignedBigInteger('ubicacion_id');
            $table->unsignedBigInteger('instrumento_id');
            $table->foreign('tipo_equipo_id')->references('id')->on('tipo_equipos');
            $table->foreign('ubicacion_id')->references('id')->on('ubicacions');
            $table->foreign('instrumento_id')->references('id')->on('instrumentos');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('equipos');
    }
}
