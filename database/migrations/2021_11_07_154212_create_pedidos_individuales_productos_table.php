<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePedidosIndividualesProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedidos_individuales_productos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('producto_id');
            $table->unsignedBigInteger('pedido_individual_id');
            $table->timestamps();

            $table->foreign("producto_id")
            ->references("id")
            ->on("productos")
            ->onDelete("cascade")
            ->onUpdate("cascade");

            $table->foreign("pedido_individual_id")
            ->references("id")
            ->on("pedidos_individuales")
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
        Schema::dropIfExists('pedidos_individuales_productos');
    }
}
