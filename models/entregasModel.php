<?php

require_once 'vendor/autoload.php';
require_once 'core/conexion.php';
require_once 'models/detalle_entregaModel.php';
require_once 'models/ticketModel.php';
require_once 'models/usuarioModel.php';
require_once 'models/movimientoModel.php';



use Illuminate\Database\Eloquent\Model;

class Entrega extends Model{

    public $timestamps = false;
    protected $table = "entregas";
    protected $filleable = ['ticket_id','usuario_id','fecha','hora','codigo'];
    
    //uno a muchos
    public function detalle_entrega(){
        return $this->hasMany(Detalle_Entrega::class);
    }

    //muchos a uno
    public function ticket(){
        return $this->belongsTo(Ticket::class);
    }

    //muchos a uno
    public function usuario(){
        return $this->belongsTo(Usuario::class);
    }

    //uno a muchos
    public function movimiento(){
        return $this->hasMany(Movimiento::class);
    }
}