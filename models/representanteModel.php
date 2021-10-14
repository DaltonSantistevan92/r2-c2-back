<?php

require_once 'vendor/autoload.php';
require_once 'core/conexion.php';
require_once 'models/personaModel.php';
require_once 'models/parentescoModel.php';
require_once 'models/especialModel.php';


use Illuminate\Database\Eloquent\Model;

class Representante extends Model{

    protected $table = "representantes";
    protected $filleable = ['persona_id', 'parentesco_id', 'especial_id', 'fecha_nac ', 'estado'];
    public $timestamps = false;

    //Muchos a uno
    public function persona(){
        return $this->belongsTo(Persona::class);
    }

    public function parentesco(){
        return $this->belongsTo(Parentesco::class);
    } 

    public function especial(){
        return $this->belongsTo(Especial::class);
    } 
}