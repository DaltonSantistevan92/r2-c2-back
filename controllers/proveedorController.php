<?php
require_once 'app/cors.php';
require_once 'models/proveedorModel.php';


class ProveedorController
{

    private $cors;

    public function __construct()
    {
        $this->cors = new Cors();
    }

    public function listar(){
        $this->cors->corsJson();
        $proveedor = Proveedor::where('estado', 'A')->get();
        $response = [];

        if ($proveedor) {
            $response = [
                'status' => true,
                'mensaje' => 'Existem datos',
                'data' => $proveedor
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