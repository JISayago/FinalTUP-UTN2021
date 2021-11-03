<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PedidoIndividual extends Model
{
    use HasFactory;

    /* relaciones mucho a mucho (tiene 1 cliente - tiene muchos productos(creo q necesito stock)) porque
     pienso q se va a crear 1 por pedido aunque 
     se puede editar en caso de q no haya sido entregado */
}
