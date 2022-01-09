<?php

require_once 'app/cors.php';
require_once 'app/request.php';
require_once 'core/conexion.php';
require_once 'models/asignacionesModel.php';


class AsignacionesController
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

        $asignacionRequet = $request->input('asignacion');
        $response = [];

        if($asignacionRequet){
            $periodo_id = intval($asignacionRequet->periodo_id);
            $docente_id = intval($asignacionRequet->docente_id);
            $materia_id = intval($asignacionRequet->materia_id);
            $grado_id = intval($asignacionRequet->grado_id);
            $paralelo_id = intval($asignacionRequet->paralelo_id);

            $nuevoAsignacion = new Asignaciones();
            $nuevoAsignacion->periodo_id = $periodo_id;
            $nuevoAsignacion->docente_id = $docente_id;
            $nuevoAsignacion->materia_id = $materia_id;
            $nuevoAsignacion->grado_id = $grado_id;
            $nuevoAsignacion->paralelo_id = $paralelo_id;
            $nuevoAsignacion->estado = 'A';

            $existe = Asignaciones::where('periodo_id',$periodo_id)->where('docente_id', $docente_id)
                                  ->where('materia_id',$materia_id)->where('grado_id',$grado_id)
                                  ->where('paralelo_id',$paralelo_id)->get()->first();

            if($existe){
                $response = [
                    'status' => false,
                    'mensaje' => 'La asignacion ya existe',
                    'asignacion' => null
                ];
            }else{
                if( $nuevoAsignacion->save()){
                    $response = [
                        'status' => true,
                        'mensaje' => 'La asignacion se ha registrado correctamente',
                        'asignacion' => $nuevoAsignacion
                    ];
                }else{
                    $response = [
                        'status' => false,
                        'mensaje' => 'La asignacion no se ha registrado, intente nuevamente',
                        'asignacion' => null
                    ];
                }

            }
        }else{
            $response = [
                'status' => false,
                'mensaje' => 'No ahi datos para procesar',
                'asignacion' => null
            ];
        }
        echo json_encode($response);

    }

    public function datatable($params){
        $periodo_id = intval($params['id_periodo']);
        $grado_id = intval($params['id_grado']);
        $paralelo_id = intval($params['id_paralelo']);

        $asignacion = Asignaciones::where('estado', 'A')
                                ->where('id_periodo',$periodo_id)
                                ->where('grado_id', $grado_id)
                                ->where('paralelo_id',$paralelo_id)->get();
                        
        $data = [];  

        if($asignacion){
            $i = 1;
            foreach ($asignacion as $asig) {
                $icono = $asig->estado == 'I' ? '<i class="fa fa-check-circle fa-lg"></i>' : '<i class="fa fa-trash fa-lg"></i>';
                $clase = $asig->estado == 'I' ? 'btn-success btn-sm' : 'btn-dark btn-sm';
                $other = $asig->estado == 'A' ? 0 : 1;

                $botones = '<div class="text-center">
                                <button class="btn ' . $clase . '" onclick="eliminar_horario(' . $asig->id . ',' . $other . ')">
                                    ' . $icono . '
                                </button>
                            </div>';
    
                $data[] = [
                    0 => $i,
                    1 => $asig->docente->persona->nombres .' '. $asig->docente->persona->apellidos,
                    2 => $asig->materia->materia,
                    3 => $asig->grado->nombre_grado,
                    4 => $asig->paralelo->detalle,
                    5 => $botones,
                ];
                $i++;
            }
            $result = [
                'sEcho' => 1,
                'iTotalRecords' => count($data),
                'iTotalDisplayRecords' => count($data),
                'aaData' => $data,
            ];
        }
        echo json_encode($result);




    }
}