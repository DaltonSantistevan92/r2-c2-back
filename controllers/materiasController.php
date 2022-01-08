<?php

require_once 'app/cors.php';
require_once 'app/request.php';
require_once 'core/conexion.php';
require_once 'models/materiasModel.php';


class MateriasController
{
    private $cors;
    private $conexion;

    public function __construct()
    {
        $this->cors = new Cors();
        $this->conexion = new Conexion();        
    }

    public function guardar(Request $request){
        $this->cors->corsJson();

        $materiaRequest = $request->input('materia');
        $response = [];

        if($materiaRequest){
            $materia = ucfirst($materiaRequest->materia);
            $area_id = intval($materiaRequest->area_id);
            
            $nuevoMateria = new Materias();
            $nuevoMateria->materia = $materia;
            $nuevoMateria->area_id = $area_id;
            $nuevoMateria->color = $materiaRequest->color;
            $nuevoMateria->duracion = $materiaRequest->duracion;
            $nuevoMateria->estado = 'A';

            $existeMateria = Materias::where('materia',$materia)->get()->first();

            if($existeMateria){
                $response = [
                    'status' => false,
                    'mensaje' => 'La materia ya existe',
                    'materia' => null
                ];
            }else{
                if($nuevoMateria->save()){
                    $response = [
                        'status' => true,
                        'mensaje' => 'La materia se ha registrado',
                        'materia' => $nuevoMateria
                    ];
                }else{
                    $response = [
                        'status' => false,
                        'mensaje' => 'La materia no se pudo registrar',
                        'materia' => null
                    ];
                }    
            }
        }else{
            $response = [
                'status' => false,
                'mensaje' => 'No ahi datos para procesar',
                'materia' => null
            ];
        }
        echo json_encode($response);
    }



}