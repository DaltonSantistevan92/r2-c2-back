<?php

require_once 'vendor/autoload.php';
require_once 'core/conexion.php';
//require_once 'models/productoModel.php';

use Illuminate\Database\Eloquent\Model;

class Horarios extends Model{

    //public $timestamps = false;
    protected $table = "horarios";
    protected $filleable = ['nombre_horario','grado_id','periodo_id','paralelo_id','estado'];
    
    
}