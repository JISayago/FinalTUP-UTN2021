<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNaturaProductosCicloTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {   

        Schema::create('natura_productos_ciclo', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pedido_natura_id');
            $table->unsignedBigInteger('producto_id');
            $table->string('codigo_producto');
            $table->string('descripcion_producto');
            $table->string('precio_producto');
            $table->integer('cantidad_ingresada_producto');
            $table->timestamps();

            $table->foreign("pedido_natura_id")
            ->references("id")
            ->on("pedidos_natura")
            ->onDelete("cascade")
            ->onUpdate("cascade");

            $table->foreign("producto_id")
            ->references("id")
            ->on("productos")
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
        Schema::dropIfExists('natura_productos_ciclo');
    }
}
