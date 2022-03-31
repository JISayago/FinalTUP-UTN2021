<?php

namespace App\Models;
use App\Models\PedidoIndividual;
use App\Models\Carrito;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;


    public function pedido_individual(){
       return $this->hasOne(PedidoIndividual::class,'cliente_id');
    }

    public function carrito(){
        return $this->hasOne(Carrito::class,'cliente_id');
     }
}
