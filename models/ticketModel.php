<?php

require_once 'vendor/autoload.php';
require_once 'core/conexion.php';
require_once 'models/estudianteModel.php';
require_once 'models/representanteModel.php';
require_once 'models/horario_atencionModel.php';
require_once 'models/entregasModel.php';



use Illuminate\Database\Eloquent\Model;

class Ticket extends Model{ 

    public $timestamps = false;
    protected $table = "tickets";
    protected $filleable = ['estudiante_id','representante_id','horario_atencion_id','codigo','fecha','fecha_entrega','privilegio','orden','estado'];

    //muchos a uno
    public function estudiante(){
        return $this->belongsTo(Estudiante::class);
    }

    public function representante(){
        return $this->belongsTo(Representante::class);
    }

    public function horario_atencion(){
        return $this->belongsTo(Horario_Atencion::class);
    }

     //uno a muchos
     public function entrega(){
        return $this->hasMany(Entrega::class);
    }
}