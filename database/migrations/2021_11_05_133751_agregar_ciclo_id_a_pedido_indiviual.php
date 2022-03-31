<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AgregarCicloIdAPedidoIndiviual extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
            Schema::table('pedidos_individuales', function(Blueprint $table){
            $table->unsignedBigInteger('ciclo_id');

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
        
    }
}
