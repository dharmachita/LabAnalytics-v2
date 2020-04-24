<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatronsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patrons', function (Blueprint $table) {
            $table->id();
            $table->string('id_patron');
            $table->float('valor_nominal');
            $table->string('unidad_medida');
            $table->unsignedBigInteger('tipo_patron_id');
            $table->unsignedBigInteger('instrumento_id');
            $table->foreign('tipo_patron_id')->references('id')->on('tipo_patrons');
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
        Schema::dropIfExists('patrons');
    }
}
