<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePedidoNaturasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedidos_natura', function (Blueprint $table) {
            $table->id();
            $table->decimal('total');
            $table->unsignedBigInteger('ciclo_id');
            $table->string('ciclo_nombre');            
            $table->boolean('pagado');
            $table->boolean('recibido');
            $table->timestamps();

            $table->foreign("ciclo_id")
            ->references("id")
            ->on("ciclos")
            ->onDelete("cascade")
            ->onUpdate("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pedido_naturas');
    }
}
