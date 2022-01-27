<?php

require_once 'vendor/autoload.php';
require_once 'core/conexion.php';
require_once 'models/ticketModel.php';

use Illuminate\Database\Eloquent\Model;

class Status extends Model{

    public $timestamps = false;
    protected $table = "status";
   

    public function ticket(){
        return $this->hasMany(Ticket::class);
    }
}