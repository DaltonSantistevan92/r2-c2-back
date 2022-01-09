<?php

require_once 'vendor/autoload.php';
require_once 'core/conexion.php';
require_once 'models/docentecursoModel.php';
require_once 'models/asignacionesModel.php';
require_once 'models/horariosModel.php';



use Illuminate\Database\Eloquent\Model;

class Periodo extends Model{

    //public $timestamps = false;
    protected $table = "periodos";
    protected $filleable = ['detalle','desde','hasta','definir','estado'];
    
    //uno a muchos
    public function docentecurso(){
        return $this->hasMany(DocenteCurso::class);
    }

    public function asignaciones(){
        return $this->hasMany(Asignaciones::class);
    }

    public function horario(){
        return $this->hasMany(Horarios::class);
    }
}