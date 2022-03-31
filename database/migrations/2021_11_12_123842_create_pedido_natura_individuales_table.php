<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePedidoNaturaIndividualesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedido_natura_individuales', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pedido_individual_id');
            $table->unsignedBigInteger('pedido_natura_id');
            $table->timestamps();

            $table->foreign("pedido_individual_id")
            ->references("id")
            ->on("pedidos_individuales")
            ->onDelete("cascade")
            ->onUpdate("cascade");

            $table->foreign("pedido_natura_id")
            ->references("id")
            ->on("pedidos_natura")
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
        Schema::dropIfExists('pedido_natura_individuales');
    }
}
