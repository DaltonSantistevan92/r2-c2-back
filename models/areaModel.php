<?php

require_once 'vendor/autoload.php';
require_once 'core/conexion.php';
require_once 'models/materiasModel.php';

use Illuminate\Database\Eloquent\Model;

class Area extends Model{

    //public $timestamps = false;
    protected $table = "area";
    protected $filleable = ['detalle','estado'];
    
    //uno a muchos
    public function materia(){
        return $this->hasMany(Materias::class);
    }
}