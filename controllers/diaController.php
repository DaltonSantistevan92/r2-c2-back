<?php

require_once 'app/cors.php';
require_once 'app/app.php';
require_once 'app/error.php';
require_once 'app/cors.php';
require_once 'app/request.php';
require_once 'core/conexion.php';
require_once 'models/diaModel.php';



class DiaController
{

    private $cors;
    private $conexion;

    public function __construct()
    {
        $this->cors = new Cors();
        $this->conexion = new Conexion();
    }

    public function listar(){
        $this->cors->corsJson();
        $response = [];  $diaPadre = []; $diaInicio = []; $diaFin= [];
        
        $dia = Dia::where('estado','A')->get();
      
        if($dia){          
            foreach($dia as $item){    
                $diaFin = $item->detalle;
                $diaPadre[] = $diaFin;
    
                $diaInicio =  $diaPadre[0];
    
                for ($i=0; $i < count($diaPadre); $i++) { 
                   $diaFin =  $diaPadre[$i];
                }
            }
            $response = [
                'status' => true,
                'mensaje' => 'existen datos',
                'data' => $dia,
                'dia' => $diaInicio .' a '. $diaFin
            ];
        }else{
            $response = [
                'status' => false,
                'mensaje' => 'no existen datos',
                'data' => null,
                'dia' => null
            ];
        }
        echo json_encode($response);
    }

   

}