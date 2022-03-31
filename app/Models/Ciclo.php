<?php

namespace App\Models;
use App\Models\PedidoIndividual;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ciclo extends Model
{
    use HasFactory;

    public function pedidos(){
        return $this->belongsToMany(PedidoIndividual::class,'ciclo_id');
    }
}
