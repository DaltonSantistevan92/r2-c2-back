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

    public function datatable()
    {
        $this->cors->corsJson();
        $materias = Materias::where('estado', 'A')->orderBy('materia','Asc')->get();
        $data = [];
        $i = 1;

        foreach ($materias as $m) {
            $icono = $m->estado == 'I' ? '<i class="fa fa-check-circle fa-lg"></i>' : '<i class="fa fa-trash fa-lg"></i>';
            $clase = $m->estado == 'I' ? 'btn-success btn-sm' : 'btn-dark btn-sm';
            $other = $m->estado == 'A' ? 0 : 1;

            $botones = '<div class="btn-group">
                            <button class="btn ' . $clase . '" onclick="eliminar_materia(' . $m->id . ',' . $other . ')">
                                ' . $icono . '
                            </button>
                        </div>';

            $data[] = [
                0 => $i,
                1 => $m->materia,
                2 => $m->area->detalle,
                3 => $m->duracion,
                4 => $botones,
            ];
            $i++;
        }

        $result = [
            'sEcho' => 1,
            'iTotalRecords' => count($data),
            'iTotalDisplayRecords' => count($data),
            'aaData' => $data,
        ];
        echo json_encode($result);
    }



}