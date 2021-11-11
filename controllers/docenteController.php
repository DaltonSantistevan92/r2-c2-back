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
