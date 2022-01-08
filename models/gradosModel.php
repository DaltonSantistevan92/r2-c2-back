<?php

require_once 'vendor/autoload.php';
require_once 'core/conexion.php';
require_once 'models/asignacionesModel.php';

use Illuminate\Database\Eloquent\Model;

class Grados extends Model{

    //public $timestamps = false;
    protected $table = "grados";
    protected $filleable = ['nombre_grado','estado'];
    
    public function asignaciones(){
        return $this->hasMany(Asignaciones::class);
    }
    
}