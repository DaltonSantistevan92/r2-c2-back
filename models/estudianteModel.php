<?php

require_once 'vendor/autoload.php';
require_once 'core/conexion.php';
require_once 'models/personaModel.php';
require_once 'models/ticketModel.php';


use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model{

    public $timestamps = false;
    protected $table = "estudiantes";
    protected $filleable = ['persona_id','estado'];
    
    public function persona(){
        return $this->belongsTo(Persona::class);
    }

    //uno a muchos
    public function ticket(){
        return $this->hasMany(Ticket::class);
    }
    
}