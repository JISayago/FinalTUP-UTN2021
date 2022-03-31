<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIngresosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ingresos', function (Blueprint $table) {
            $table->id();
            $table->decimal('valor_ingreso');
            $table->date('fecha_pago_ingreso');
            $table->string('detalle_ingreso');
            $table->unsignedBigInteger('cliente_id');
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
        Schema::dropIfExists('ingresos');
    }
}
