<?php

require_once 'vendor/autoload.php';
require_once 'core/conexion.php';
require_once 'models/ticketModel.php';

use Illuminate\Database\Eloquent\Model;

class Horario_Atencion extends Model{

    //public $timestamps = false;
    protected $table = "horarios_atencion";
    protected $filleable = ['hora_inicio','hora_fin','estado'];

    //uno a muchos
    public function ticket(){
        return $this->hasMany(Ticket::class);
    }
}