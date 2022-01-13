<?php

require_once 'vendor/autoload.php';
require_once 'core/conexion.php';
require_once 'models/detalle_baseModel.php';

use Illuminate\Database\Eloquent\Model;

class Dia extends Model{

    public $timestamps = false;
    protected $table = "dias";
    protected $filleable = ['detalle','estado'];
    
    public function detalle_base(){
        return $this->hasMany(Detalle_Base::class);
    }
}