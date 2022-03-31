<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AgregarColumnasProductoEnPedidoIndividual extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pedidos_individuales_productos', function (Blueprint $table) {
        $table->string('codigo_producto');
        $table->string('descripcion_producto');
        $table->string('precio_producto');
        $table->integer('cantidad_pedida_producto');
        });
       
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
