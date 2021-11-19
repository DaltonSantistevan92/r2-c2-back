<?php

require_once 'vendor/autoload.php';
require_once 'core/conexion.php';
require_once 'models/proveedorModel.php';
require_once 'models/usuarioModel.php';
require_once 'models/detalle_abastecerModel.php';


use Illuminate\Database\Eloquent\Model;

class Abastecer extends Model{

    protected $table = "abastecer";
    protected $filleable = ['proveedor_id','usuario_id','codigo','fecha','estado'];

    //muchos a uno
    public function proveedor(){
        return $this->belongsTo(Proveedor::class);
    }

    //muchos a uno
    public function usuario(){
        return $this->belongsTo(Usuario::class);
    }

    public function detalle_abastecer(){
        return $this->hasMany(Detalle_Abastecer::class);
    }



}