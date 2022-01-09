<?php
require_once 'app/cors.php';
require_once 'models/gradosModel.php';


class GradosController
{

    private $cors;

    public function __construct()
    {
        $this->cors = new Cors();
    }

    public function listar(){
        $this->cors->corsJson();
        $grados = Grados::where('estado', 'A')->get();
        $response = [];

        if ($grados) {
            $response = [
                'status' => true,
                'mensaje' => 'Existem datos',
                'grados' => $grados
            ];
        } else {
            $response = [
                'status' => false,
                'mensaje' => 'No existem datos',
                'grados' => []
            ];
        }
        echo json_encode($response);
    }

}