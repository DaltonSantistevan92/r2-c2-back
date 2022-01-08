<?php

require_once 'vendor/autoload.php';
require_once 'core/conexion.php';
require_once 'models/docentecursoModel.php';
require_once 'models/personaModel.php';
require_once 'models/asignacionesModel.php';



use Illuminate\Database\Eloquent\Model;

class Docente extends Model{

    public $timestamps = false;
    protected $table = "docentes";
    protected $filleable = ['persona_id','estado'];
    
    //uno a muchos
    public function docentecurso(){
        return $this->hasMany(DocenteCurso::class);
    }

    public function persona(){
        return $this->belongsTo(Persona::class);
    }

    public function asignaciones(){
        return $this->hasMany(Asignaciones::class);
    }
}