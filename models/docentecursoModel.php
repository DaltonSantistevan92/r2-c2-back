<?php

require_once 'vendor/autoload.php';
require_once 'core/conexion.php';
require_once 'models/periodoModel.php';
require_once 'models/cursoModel.php';
require_once 'models/docenteModel.php';
require_once 'models/paraleloModel.php';



use Illuminate\Database\Eloquent\Model;

class DocenteCurso extends Model{

    protected $table = "docente_curso";
    protected $filleable = ['periodo_id','docente_id','curso_id','paralelo_id','estado'];
    public $timestamps = false;

    //Muchos a uno
    public function periodo(){
        return $this->belongsTo(Periodo::class);
    }
    //Muchos a uno
    public function curso(){
        return $this->belongsTo(Curso::class);
    }
    //Muchos a uno
    public function docente(){
        return $this->belongsTo(Docente::class);
    }
    //Muchos a uno
    public function paralelo(){
        return $this->belongsTo(Paralelo::class);
    }


}