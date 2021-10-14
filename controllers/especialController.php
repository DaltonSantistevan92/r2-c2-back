<?php

require_once 'app/cors.php';
require_once 'app/request.php';
require_once 'app/error.php';
require_once 'models/especialModel.php';

class EspecialController{

    private $cors;
  
    public function __construct()
    {
        $this->cors = new Cors();
       
    }

    public function getEspecial(){
        $this->cors->corsJson();
        $response = [];

        $especial = especial::where('estado','A')->orderBy('descripcion')->get();
        if($especial){
            $response = [
                'status' => true,
                'mensaje' => 'Existen datos',
                'especial' => $especial               
            ];
        }else{
            $response = [
                'status' => false,
                'mensaje' => 'No existen datos',
                'especial' => null              
            ];
        }
        echo json_encode($response);

    }

}