<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearCarritoProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carrito_productos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('producto_id');
            $table->unsignedBigInteger('carrito_id');
            $table->timestamps();

            $table->foreign("producto_id")
            ->references("id")
            ->on("productos")
            ->onDelete("cascade")
            ->onUpdate("cascade");

            $table->foreign("carrito_id")
            ->references("id")
            ->on("carritos")
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
        //
    }
}
