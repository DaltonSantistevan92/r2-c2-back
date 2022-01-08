<?php
require_once 'app/cors.php';
require_once 'models/areaModel.php';


class AreaController
{

    private $cors;

    public function __construct()
    {
        $this->cors = new Cors();
    }

    public function listar(){
        $this->cors->corsJson();
        $area = Area::where('estado', 'A')->orderBy('detalle','Asc')->get();
        $response = [];

        if ($area) {
            $response = [
                'status' => true,
                'mensaje' => 'Existem datos',
                'area' => $area
            ];
        } else {
            $response = [
                'status' => false,
                'mensaje' => 'No existem datos',
                'area' => []
            ];
        }
        echo json_encode($response);
    }

}