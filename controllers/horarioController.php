<?php

require_once 'app/cors.php';
require_once 'app/request.php';
require_once 'core/conexion.php';
require_once 'models/horariosModel.php';


class HorarioController
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
        $requetHorario = $request->input('horario');
        $response = [];

        if($requetHorario){
            $nombre_horario = ucfirst($requetHorario->nombre_horario);
            $grado_id = intval($requetHorario->grado_id);
            $periodo_id = intval($requetHorario->periodo_id);
            $paralelo_id = intval($requetHorario->paralelo_id);

            $nuevoHorario = new Horarios();
            $nuevoHorario->nombre_horario = $nombre_horario;
            $nuevoHorario->grado_id = $grado_id;
            $nuevoHorario->periodo_id = $periodo_id;
            $nuevoHorario->paralelo_id = $paralelo_id;
            $nuevoHorario->estado = 'A';

            $existeHorario = Horarios::where('nombre_horario',$nombre_horario)->get()->first();
            
            if($existeHorario){
                $response = [
                    'status' => false,
                    'mensaje' => 'El Horario ya existe',
                    'horario' => null
                ];
            }else{
                if($nuevoHorario->save()){
                    $response = [
                        'status' => true,
                        'mensaje' => 'El horario se ha registrado',
                        'materia' => $nuevoHorario
                    ];
                }else{
                    $response = [
                        'status' => false,
                        'mensaje' => 'El horario no se pudo registrar',
                        'materia' => null
                    ];
                }
            }
        }else{
            $response = [
                'status' => false,
                'mensaje' => 'No hay datos para procesar',
                'horario' => null
            ];
        }
        echo json_encode($response);
    }

    public function getByHorario($params){
        $this->cors->corsJson();
        $id_periodo = intval($params['id_periodo']);

        $response = [];
        $horarios = Horarios::where('periodo_id', $id_periodo)->get();
    
        if($horarios->count() > 0) $response = $horarios;
        echo json_encode($response);
    }

    public function datatable($params){
        $this->cors->corsJson();

        $id_periodo = intval($params['id_periodo']);

        $horarios = Horarios::where('estado', 'A')->where('periodo_id', $id_periodo)->get();
        $data = [];  

        if($horarios){
            $i = 1;
            foreach ($horarios as $h) {
                $icono = $h->estado == 'I' ? '<i class="fa fa-check-circle fa-lg"></i>' : '<i class="fa fa-trash fa-lg"></i>';
                $clase = $h->estado == 'I' ? 'btn-success btn-sm' : 'btn-dark btn-sm';
                $other = $h->estado == 'A' ? 0 : 1;
    
                $botones = '<div class="text-center">
                                <button class="btn btn-primary btn-sm" onclick="configuraciones(' . $h->id . ')">
                                    <i class="fas fa-cog"></i>
                                </button>
                                <button class="btn ' . $clase . '" onclick="eliminar_horario(' . $h->id . ',' . $other . ')">
                                    ' . $icono . '
                                </button>
                            </div>';
    
                $data[] = [
                    0 => $i,
                    1 => $h->nombre_horario,
                    2 => $h->grado->nombre_grado,
                    3 => $h->periodo->desde .'-'. $h->periodo->hasta,
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
        }
        echo json_encode($result);
    }

}

