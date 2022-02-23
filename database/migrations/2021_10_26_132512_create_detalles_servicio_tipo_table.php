<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetallesServicioTipoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalles_servicio_tipo', function (Blueprint $table) {
            $table->id();
            $table->float('precio');
            $table->unsignedBigInteger('servicio_id');
            $table->unsignedBigInteger('tipo_servicio_id');
            $table->foreign('servicio_id')->references('id')->on('servicios');
            $table->foreign('tipo_servicio_id')->references('id')->on('tipo_servicios');
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
        Schema::dropIfExists('detalles_servicio_tipo');
    }
}
