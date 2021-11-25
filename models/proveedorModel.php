<?php

require_once 'vendor/autoload.php';
require_once 'core/conexion.php';
require_once 'models/abastecerModel.php';


use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model{

    protected $table = "proveedores";
    //public $timestamps = false;


    //uno a muchos
    public function abastecer(){
        return $this->hasMany(Abastecer::class);
    }
}