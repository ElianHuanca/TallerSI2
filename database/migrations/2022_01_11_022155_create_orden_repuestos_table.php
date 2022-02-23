<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdenRepuestosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orden_repuestos', function (Blueprint $table) {
            $table->id();
            $table->string('estado');
            $table->unsignedBigInteger('ordenTrabajoId')->nullable();
            $table->foreign('ordenTrabajoId')->references('id')->on('ordens')->onDelete('set null');
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
        Schema::dropIfExists('orden_repuestos');
    }
}
