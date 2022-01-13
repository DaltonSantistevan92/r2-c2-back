<?php

require_once 'vendor/autoload.php';
require_once 'core/conexion.php';
require_once 'models/baseModel.php';
require_once 'models/horasModel.php';
require_once 'models/diaModel.php';


use Illuminate\Database\Eloquent\Model;

class Detalle_Base extends Model{

    //public $timestamps = false;
    protected $table = "detalle_base";
    protected $filleable = ['base_id','horas_id','dia_id','estado'];
    
    public function base(){
        return $this->belongsTo(Base::class);
    }

    public function horas(){
        return $this->belongsTo(Horas::class);
    }

    public function dia(){
        return $this->belongsTo(Dia::class);
    }
}