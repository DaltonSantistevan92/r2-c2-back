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

    public function buscarCategoriaProducto($params){
        $this->cors->corsJson();
        $categoria_id = intval($params['id']);
        $response = [];

        $categoria = Categoria::find($categoria_id);
        if($categoria){
            $categoria->producto;

            $response = [
                'status' => true,
                'mensaje' => 'Si ahi datos',
                'categoria' => $categoria
            ];
        }else{
            $response = [
                'status' => false,
                'mensaje' => 'No ahi datos',
                'categoria' => null
            ];
        }
        echo json_encode($response);
    }

}