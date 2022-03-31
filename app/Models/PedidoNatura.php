<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\PedidoIndividuales;
use App\Models\Ciclo;

class PedidoNatura extends Model
{
    use HasFactory;
    
    public $table = "pedidos_natura";
    protected $fillable = ['ciclo_id','ciclo_nombre','total','pagado','recibido'];

    public function ciclo(){
        return $this->hasOne(Ciclo::class,'id','ciclo_id');
    }

    public function pedidos(){
        return $this->hasMany(PedidoIndividuales::class,'pedido_natura_individuales','pedido_natura_id','pedido_individual_id');
    }
}
