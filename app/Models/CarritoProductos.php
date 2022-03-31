<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarritoProductos extends Model
{
    use HasFactory;

    public $table = "carrito_productos";

    public function productos(){
        return $this->hasMany(Producto::class,'carrito_productos','producto_id');
    }


}
