<?php

require_once 'vendor/autoload.php';
require_once 'core/conexion.php';
require_once 'models/baseModel.php';
require_once 'models/horasModel.php';
require_once 'models/asignacionesModel.php';



use Illuminate\Database\Eloquent\Model;

class Detalle_Base extends Model{

    //public $timestamps = false;
    protected $table = "detalle_base";
    protected $filleable = ['base_id','asignaciones_id','horas_id','estado'];
    
    public function base(){
        return $this->belongsTo(Base::class);
    }

    public function horas(){
        return $this->belongsTo(Horas::class);
    }

    public function asignaciones(){
        return $this->belongsTo(Asignaciones::class);
    }
    


}