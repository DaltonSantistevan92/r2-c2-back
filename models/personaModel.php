<?php

require_once 'vendor/autoload.php';
require_once 'core/conexion.php';
require_once 'models/usuarioModel.php';
require_once 'models/representanteModel.php';


use Illuminate\Database\Eloquent\Model;

class Persona extends Model{

    protected $table = "personas";
    protected $filleable = ['cedula', 'nombres', 'apellidos', 'telefono', 'correo', 'sexo', 'estado'];
    public $timestamps = false;
    
    //uno a muchos
    public function usuario(){
        return $this->hasMany(Usuario::class);
    }

    //uno a muchos
    public function representante(){
        return $this->hasMany(Representante::class);
    }
}