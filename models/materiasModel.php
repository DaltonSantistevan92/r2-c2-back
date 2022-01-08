<?php

require_once 'vendor/autoload.php';
require_once 'core/conexion.php';
require_once 'models/areaModel.php';
require_once 'models/asignacionesModel.php';

use Illuminate\Database\Eloquent\Model;

class Materias extends Model{

    //public $timestamps = false;
    protected $table = "materias";
    protected $filleable = ['materia','area_id','color','duracion','estado'];
    
    public function area(){
        return $this->belongsTo(Area::class);
    }

    public function asignaciones(){
        return $this->hasMany(Asignaciones::class);
    }

    
}