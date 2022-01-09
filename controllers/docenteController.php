<?php

require_once 'app/cors.php';
require_once 'app/app.php';
require_once 'app/error.php';
require_once 'app/cors.php';
require_once 'app/request.php';
require_once 'core/conexion.php';
require_once 'models/docenteModel.php';

class DocenteController
{

    private $cors;
    private $conexion;

    public function __construct()
    {
        $this->cors = new Cors();
        $this->conexion = new Conexion();
    }

    public function listar(){
        $this->cors->corsJson();
        $response = [];

        $docente = Docente::where('estado','A')->get();

        if($docente){
            foreach($docente as $d){
                $d->persona;
            }
            $response = [
                'status' => true,
                'mensaje' => 'existen datos',
                'docente' => $docente
            ];
        }else{
            $response = [
                'status' => false,
                'mensaje' => 'no existen datos',
                'docente' => null
            ];
        }
        echo json_encode($response);
    }

    public function buscarDocente($params)
    {
        $this->cors->corsJson();
        $texto = ucfirst($params['texto']);
        $response = [];

        $sql = "SELECT d.id,p.cedula,p.nombres,p.apellidos,p.telefono,p.correo FROM personas p
        INNER JOIN docentes d ON d.persona_id = p.id
        WHERE p.estado = 'A' and (p.cedula LIKE '$texto%' OR p.nombres LIKE '%$texto%' OR p.apellidos LIKE '%$texto%')";

        $array = $this->conexion->database::select($sql);

        if ($array) {
            $response = [
                'status' => true,
                'mensaje' => 'Existen datos',
                'docente' => $array,
            ];
        } else {
            $response = [
                'status' => false,
                'mensaje' => 'No existen coincidencias',
                'docente' => null,
            ];
        }
        echo json_encode($response);
    }

    public function guardar($docente, $id_persona)
    {

        if ($docente) {
            $nuevoDocente = new Docente();
            $nuevoDocente->persona_id = $id_persona;
            $nuevoDocente->estado = 'A';
            $nuevoDocente->save();

            return $nuevoDocente;
        } else {
            return null;
        }
    }
}
