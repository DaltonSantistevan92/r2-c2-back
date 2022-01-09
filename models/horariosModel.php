<?php

require_once 'vendor/autoload.php';
require_once 'core/conexion.php';
require_once 'models/gradosModel.php';
require_once 'models/periodoModel.php';
require_once 'models/paraleloModel.php';


use Illuminate\Database\Eloquent\Model;

class Horarios extends Model{

    public $timestamps = false;
    protected $table = "horarios";
    protected $filleable = ['nombre_horario','grado_id','periodo_id','paralelo_id','estado']; 

    public function grado(){
        return $this->belongsTo(Grados::class);
    }
    
    public function periodo(){
        return $this->belongsTo(Periodo::class);
    }

    public function paralelo(){
        return $this->belongsTo(Paralelo::class);
    }
    
    
}