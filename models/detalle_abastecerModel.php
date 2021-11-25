<?php

require_once 'vendor/autoload.php';
require_once 'core/conexion.php';
require_once 'models/abastecerModel.php';
require_once 'models/productoModel.php';


use Illuminate\Database\Eloquent\Model;

class Detalle_Abastecer extends Model{

    protected $table = "detalle_abastecer";
    protected $filleable = ['abastecer_id','producto_id','num_caja','cantidad'];
    public $timestamps = false;

    //muchos a uno
    public function abastecer(){
        return $this->belongsTo(Abastecer::class);
    }

    //muchos a uno
    public function producto(){
        return $this->belongsTo(Producto::class);
    }

    

}