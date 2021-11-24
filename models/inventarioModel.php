<?php

require_once 'vendor/autoload.php';
require_once 'core/conexion.php';
require_once 'models/movimientoModel.php';
require_once 'models/productoModel.php';


use Illuminate\Database\Eloquent\Model;

class Inventario extends Model{

    protected $table = "inventario";
    protected $filleable = ['movimiento_id','producto_id','tipo','cantidad','cantidad_disponible','total','total_disponible'];
    
    //muchos a uno
    public function movimiento(){
        return $this->belongsTo(Movimiento::class);
    }

    //muchos a uno
    public function producto(){
        return $this->belongsTo(Producto::class);
    }



}