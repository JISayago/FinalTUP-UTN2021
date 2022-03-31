<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Producto;
use App\Models\Cliente;

class Carrito extends Model
{
    use HasFactory;

    public $table = "carritos";

    public function cliente(){
        return $this->belongsTo(Cliente::class,'cliente_id','id');
    }  

    
}
