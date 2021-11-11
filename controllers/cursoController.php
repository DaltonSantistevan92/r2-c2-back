<?php
require_once 'app/cors.php';
require_once 'models/cursoModel.php';


class CursoController
{

    private $cors;

    public function __construct()
    {
        $this->cors = new Cors();
    }

    public function listar()
    {
        $this->cors->corsJson();
        $cursos = Curso::where('estado', 'A')->get();
        $response = [];

        if ($cursos) {
            $response = [
                'status' => true,
                'mensaje' => 'Existem datos',
                'data' => $cursos
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
