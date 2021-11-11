<?php
require_once 'app/cors.php';
require_once 'models/categoriaModel.php';


class CategoriaController
{

    private $cors;

    public function __construct()
    {
        $this->cors = new Cors();
    }

    public function listar(){
        $this->cors->corsJson();
        $categoria = Categoria::where('estado', 'A')->get();
        $response = [];

        if ($categoria) {
            $response = [
                'status' => true,
                'mensaje' => 'Existem datos',
                'data' => $categoria
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