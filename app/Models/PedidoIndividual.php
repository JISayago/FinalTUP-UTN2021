<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Cliente;
use App\Models\Ciclo;
use App\Models\Producto;

class PedidoIndividual extends Model
{
    use HasFactory;
    public $table = "pedidos_individuales";


    public function cliente(){
        return $this->belongsTo(Cliente::class,'cliente_id','id');
    }
    
    public function ciclo(){
        return $this->hasOne(Ciclo::class,'id','ciclo_id');
    }

    public function productos(){
        return $this->hasMany(Producto::class,'pedidos_individuales_productos','pedido_individual_id','producto_id');
    }
}
