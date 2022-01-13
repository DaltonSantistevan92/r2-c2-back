<?php

require_once 'vendor/autoload.php';
require_once 'core/conexion.php';


use Illuminate\Database\Eloquent\Model;

class Dia extends Model{

    public $timestamps = false;
    protected $table = "dias";
    protected $filleable = ['detalle','estado'];
    
    
}