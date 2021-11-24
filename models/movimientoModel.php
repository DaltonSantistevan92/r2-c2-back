<?php

require_once 'vendor/autoload.php';
require_once 'core/conexion.php';
require_once 'models/entregasModel.php';
require_once 'models/usuarioModel.php';
require_once 'models/inventarioModel.php';


use Illuminate\Database\Eloquent\Model;

class Movimiento extends Model{ 

    public $timestamps = false;
    protected $table = "movimientos";
    protected $filleable = ['entrega_id','abastecer_id','usuario_id','tipo','fecha'];
    
    //muchos a uno
    public function entrega(){
        return $this->belongsTo(Entrega::class);
    }

    //muchos a uno
    public function usuario(){
        return $this->belongsTo(Usuario::class);
    }

    //uno a muchos
    public function inventario(){
        return $this->hasMany(Inventario::class);
    }


}