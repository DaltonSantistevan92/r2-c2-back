<?php

require_once 'vendor/autoload.php';
require_once 'core/conexion.php';
require_once 'models/usuarioModel.php';

use Illuminate\Database\Eloquent\Model;

class Rol extends Model{

    public $timestamps = false;
    protected $table = "roles";
    protected $filleable = ['rol', 'descripcion', 'estado'];

    public function usuario(){
        return $this->hasMany(Usuario::class);
    }
}