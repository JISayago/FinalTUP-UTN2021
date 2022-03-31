<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEgresosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('egresos', function (Blueprint $table) {
            $table->id();
            $table->decimal('valor_egreso');
            $table->date('fecha_pago_egreso');       
            $table->string('detalle_egreso');   
            $table->unsignedBigInteger('cliente_id')->nullable();
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
        Schema::dropIfExists('egresos');
    }
}
