<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\PedidoIndividual;
use App\Models\Carrito;

class Producto extends Model
{
    use HasFactory;
    
    public function pedido_individual(){
    return $this->belongsToMany(PedidoIndividual::class,'pedidos_individuales_productos','producto_id','pedido_individual_id');
    }

    public function carrito_productos(){
        return $this->belongsToMany(CarritoProductos::class,'carrito_productos','producto_id','id');
        }
}
