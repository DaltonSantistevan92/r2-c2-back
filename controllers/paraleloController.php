<?php
require_once 'app/cors.php';
require_once 'models/paraleloModel.php';


class ParaleloController
{

    private $cors;

    public function __construct()
    {
        $this->cors = new Cors();
    }

    public function listar()
    {
        $this->cors->corsJson();
        $paralelos = Paralelo::where('estado', 'A')->get();
        $response = [];

        if ($paralelos) {
            $response = [
                'status' => true,
                'mensaje' => 'Existem datos',
                'data' => $paralelos
            ];
        } else {
            $response = [
                'status' => false,
                'mensaje' => 'No existem datos',
                'data' => []
            ];
        }
        echo json_encode($response);
    }
}
