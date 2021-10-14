<?php

require_once 'app/cors.php';
require_once 'app/request.php';
require_once 'app/error.php';
require_once 'models/parentescoModel.php';

class ParentescoController{

    private $cors;
  
    public function __construct()
    {
        $this->cors = new Cors();
       
    }


    //lista como dataTable
    public function getParentesco(){
        $this->cors->corsJson();
        $response = [];

        $parentesco = Parentesco::where('estado','A')->orderBy('detalle')->get();
        if($parentesco){
            $response = [
                'status' => true,
                'mensaje' => 'Existen datos',
                'parentesco' => $parentesco               
            ];
        }else{
            $response = [
                'status' => false,
                'mensaje' => 'No existen datos',
                'parentesco' => null              
            ];
        }
        echo json_encode($response);
    }

    
 
}

