<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePedidosindividualesTable extends Migration
{
    /**
    * Run the migrations.
    *
    * @return void
    */
    public function up()
    {
        Schema::create('pedidos_individuales', function (Blueprint $table) {
            $table->id();
            $table->integer('cantidad');
            $table->unsignedBigInteger('cliente_id');
            $table->decimal('total_pagar');
            $table->timestamps();

            $table->foreign("cliente_id")
            ->references("id")
            ->on("clientes")
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
        Schema::dropIfExists('pedidoindividual');
    }
}
