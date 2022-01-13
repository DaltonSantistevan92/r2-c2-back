<?php

require_once 'vendor/autoload.php';
require_once 'core/conexion.php';
require_once 'models/detalle_baseModel.php';

use Illuminate\Database\Eloquent\Model;

class Horas extends Model{

    protected $table = "horas";
    protected $filleable = ['inicio','fin','estado']; 
    public $timestamps = false;
    
    public function detalle_base(){
        return $this->hasMany(Detalle_Base::class);
    }
    
}