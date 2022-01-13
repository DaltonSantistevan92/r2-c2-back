<?php

require_once 'vendor/autoload.php';
require_once 'core/conexion.php';
require_once 'models/horariosModel.php';

use Illuminate\Database\Eloquent\Model;

class Base extends Model{

    //public $timestamps = false;
    protected $table = "base";
    protected $filleable = ['nombre','horario_id','estado'];
    
    public function horario(){
        return $this->belongsTo(Horarios::class);
    }
}