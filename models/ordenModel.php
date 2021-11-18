<?php

require_once 'vendor/autoload.php';
require_once 'core/conexion.php';

use Illuminate\Database\Eloquent\Model;

class Orden extends Model{

    public $timestamps = false;
    protected $table = "ordenes";
    protected $filleable = ['num_orden','estado'];
    
    
}