<?php

require_once 'vendor/autoload.php';
require_once 'core/conexion.php';
require_once 'models/representanteModel.php';


use Illuminate\Database\Eloquent\Model;

class Especial extends Model{

    protected $table = "especiales";
    protected $filleable = ['descripcion','estado'];
    //public $timestamps = false;


    //uno a muchos
    public function representante(){
        return $this->hasMany(Representante::class);
    }
}