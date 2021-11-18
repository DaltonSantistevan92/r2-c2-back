<?php
require_once 'app/cors.php';
require_once 'models/horario_atencionModel.php';


class HorarioAtencionController
{

    private $cors;

    public function __construct()
    {
        $this->cors = new Cors();
    }

    public function listar(){
        $this->cors->corsJson();
        $horarioAtencion = Horario_Atencion::where('estado', 'A')->get();
        $response = [];

        if ($horarioAtencion) {
            $response = [
                'status' => true,
                'mensaje' => 'Existem datos',
                'horario_atencion' => $horarioAtencion
            ];
        } else {
            $response = [
                'status' => false,
                'mensaje' => 'No existem datos',
                'horario_atencion' => []
            ];
        }
        echo json_encode($response);
    }

}