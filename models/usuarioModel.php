<?php

require_once 'vendor/autoload.php';
require_once 'core/conexion.php';
require_once 'models/personaModel.php';
require_once 'models/rolModel.php';
require_once 'models/abastecerModel.php';
require_once 'models/entregasModel.php';



use Illuminate\Database\Eloquent\Model;

class Usuario extends Model{

    protected $table = "usuarios";
    protected $hidden = ['conf_clave', 'clave'];
    protected $filleable = ['rol_id', 'persona_id', 'foto', 'clave', 'conf_clave', 'estado'];
   //public $timestamps = false;

    //Muchos a uno
    public function persona(){
        return $this->belongsTo(Persona::class);
    }

    public function rol(){
        return $this->belongsTo(Rol::class);
    }

    //uno a muchos
    public function abastecer(){
        return $this->hasMany(Abastecer::class);
    }

    //uno a muchos
    public function entrega(){
        return $this->hasMany(Entrega::class);
    }
}