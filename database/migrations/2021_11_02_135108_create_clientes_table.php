<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->string('nombre')->unique();
            $table->decimal('saldo_deuda',7,2);
            $table->decimal('saldo_favor',7,2);
            $table->boolean('realizo_pedido');
            //agregar los id foraneaos seria en el id de la tabla de pedido(cliente_producto)
            //en caso de agregar la tabla de pago parcial tambien el recorrido para anular la deuda o a favor
            //tendroa q venir el id de esa tabla pago parcial (cliente_pedido)
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
        Schema::dropIfExists('clientes');
    }
}
