<?php

require_once 'vendor/autoload.php';
require_once 'core/conexion.php';
require_once 'models/representanteModel.php';


use Illuminate\Database\Eloquent\Model;

class Parentesco extends Model{

    protected $table = "parentescos";
    protected $filleable = ['detalle','estado'];
    //public $timestamps = false;


    //uno a muchos
    public function representante(){
        return $this->hasMany(Representante::class);
    }
}