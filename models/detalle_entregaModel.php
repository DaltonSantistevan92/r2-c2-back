<?php

require_once 'vendor/autoload.php';
require_once 'core/conexion.php';
require_once 'models/entregasModel.php';
require_once 'models/productoModel.php';


use Illuminate\Database\Eloquent\Model;

class Detalle_Entrega extends Model{

    public $timestamps = false;
    protected $table = "detalle_entrega";
    protected $filleable = ['entrega_id','producto_id','cantidad'];
    
    //muchos a uno
    public function entrega(){
        return $this->belongsTo(Entrega::class);
    }

    public function producto(){
        return $this->belongsTo(Producto::class);
    }
}