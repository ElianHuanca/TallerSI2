<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemOrdenRepuestoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_orden_repuesto', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ordenRepuestosId')->nullable();
            $table->string('nombre');
            $table->string('cantidad');
            $table->string('estado')->nullable();
            $table->foreign('ordenRepuestosId')->references('id')->on('orden_repuestos')->onDelete('set null');
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
        Schema::dropIfExists('item_orden_repuesto');
    }
}
