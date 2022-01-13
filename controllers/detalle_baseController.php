<?php

require_once 'app/cors.php';
require_once 'app/app.php';
require_once 'app/error.php';
require_once 'app/cors.php';
require_once 'app/request.php';
require_once 'core/conexion.php';
require_once 'models/detalle_baseModel.php';

class Detalle_BaseController
{

    private $cors;
    private $conexion;

    public function __construct()
    {
        $this->cors = new Cors();
        $this->conexion = new Conexion();
    }

    public function guardar($base_id, $detalles = [])
    {
        
        if(count($detalles) > 0 ){
            foreach($detalles as $deB){
                $nuevo = new Detalle_Base();
                $nuevo->base_id = intval($base_id);
                $nuevo->hora_id = intval($deB->hora_id);
                $nuevo->dia_id =  intval($deB->dia_id);
                $nuevo->estado =  'A';
                $nuevo->save();

            }
        }
         return $nuevo;
    }

}