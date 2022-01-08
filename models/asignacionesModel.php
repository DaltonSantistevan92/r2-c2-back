<?php

require_once 'vendor/autoload.php';
require_once 'core/conexion.php';
require_once 'models/periodoModel.php';
require_once 'models/docenteModel.php';
require_once 'models/materiasModel.php';
require_once 'models/gradosModel.php';
require_once 'models/paraleloModel.php';




use Illuminate\Database\Eloquent\Model;

class Asignaciones extends Model{

    //public $timestamps = false;
    protected $table = "asignaciones";
    protected $filleable = ['periodo_id','docente_id','materia_id','grado_id','paralelo_id','estado'];
    
    
    public function periodo(){
        return $this->belongsTo(Periodo::class);
    }

    public function docente(){
        return $this->belongsTo(Docente::class);
    }

    public function materia(){
        return $this->belongsTo(Materias::class);
    }

    public function grado(){
        return $this->belongsTo(Grados::class);
    }

    public function paralelo(){
        return $this->belongsTo(Paralelo::class);
    }

}