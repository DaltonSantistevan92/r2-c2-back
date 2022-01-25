<?php

require_once 'app/cors.php';
require_once 'app/app.php';
require_once 'app/error.php';
require_once 'app/cors.php';
require_once 'app/request.php';
require_once 'core/conexion.php';
require_once 'models/detalle_baseModel.php';

class Detalle_BaseController
{

    private $cors;
    private $conexion;

    public function __construct()
    {
        $this->cors = new Cors();
        $this->conexion = new Conexion();
    }

    public function listar($params){
        $this->cors->corsJson();
        $base_id = intval($params['base_id']);
        $hora_id = intval($params['hora_id']);

        $detaBase = Detalle_Base::where('base_id',$base_id)
                                ->where('hora_id',$hora_id)->get();

        if($detaBase){
            $response = [
                'status' => true,
                'mensaje' => 'existen datos',
                'hora' => $detaBase
            ];
        }else{
            $response = [
                'status' => false,
                'mensaje' => 'no existen datos',
                'hora' => null
            ];
        }                       
        echo json_encode($response);
    }

    public function guardar(Request $request){
        $this->cors->corsJson();
        $response = [];

        $detalleBaseRequest = $request->input('detalle_base');

        if($detalleBaseRequest){
            $base_id = intval($detalleBaseRequest->base_id);
            $horas_id = intval($detalleBaseRequest->horas_id);

            $existeDetalleBase = Detalle_Base::where('base_id',$base_id)
                                            ->where('horas_id',$horas_id)->get()->first();

            if($existeDetalleBase){
                $response = [
                    'status' => false,
                    'mensaje' => 'El detalle de la base ya existe',
                    'detalle_base' => null
                ];
            }else{
                for($i = 1; $i <= 5; $i++){  //Guardar de lunes a viernes
                    $nuevaDetalleBase = new Detalle_Base();
                    $nuevaDetalleBase->base_id = $base_id;
                    $nuevaDetalleBase->horas_id = $horas_id;
                    $nuevaDetalleBase->estado = 'A';
                    $nuevaDetalleBase->dia_id = $i;
                    $nuevaDetalleBase->save();
                }

                $response = [
                    'status' => true,
                    'mensaje' => 'no hay datos',
                    'base' => null
                ];
            }
        }else{
            $response = [
                'status' => false,
                'mensaje' => 'no hay datos',
                'base' => null
            ];
        }
        echo json_encode($response);
    }

    public function getHoras($params){
        $this->cors->corsJson();
        $response = [];

        $base_id = intval($params['base_id']);
        $base_id = intval($base_id);
        $baseHoras = Detalle_Base::where('base_id', $base_id)->orderBy('horas_id', 'Asc')->groupBy('horas_id')->get();

        if($baseHoras->count() > 0){
            $response = $baseHoras;
            foreach($baseHoras as $base){
                $base->base;    $base->horas;
            }
        }

        echo json_encode($response);
    }

    public function getByHoras($params){
        $this->cors->corsJson();
        $hora_id = intval($params['hora_id']);
        $response = [];

        $detalles = Detalle_Base::where('horas_id', $hora_id)->get();
        if($detalles->count() > 0){
            $response = $detalles;
            foreach($response as $det){
                if($det->asignaciones_id != null){
                    $det->asignaciones->docente->persona;
                    $det->asignaciones->materia;
                }
            }
        }
        echo json_encode($response);
    }

    public function getByPeriodoGradoParalelo($params){
        $this->cors->corsJson();
        $response = [];

        $periodo_id = intval($params['periodo_id']);
        $grado_id = intval($params['grado_id']);
        $paralelo_id = intval($params['paralelo_id']);

        $detalles = Asignaciones::where('periodo_id', $periodo_id)->where('grado_id', $grado_id)->where('paralelo_id', $paralelo_id)
            ->get();

        if($detalles->count() > 0){
            $response = $detalles;
            foreach($response as $det){
                $det->docente->persona;
                $det->materia;
            }
        }   

        echo json_encode($response);
    }

    public function updateDetalleBase(Request $request){
        $this->cors->corsJson();
        $response = [];

        $detalleData = $request->input('detalle_base');
        $detalleData->id = intval($detalleData->id);
        $detalleData->asignaciones_id = intval($detalleData->asignaciones_id);

        //Buscar el detalle
        $detalle = Detalle_Base::find($detalleData->id);

        if($detalle){
            $detalle->asignaciones_id = $detalleData->asignaciones_id;
            $detalle->save();

            $response = [
                'estado' => true,
                'mensaje' => 'Se ha asignado el docente con su materia en el horario !!'
            ];
        }else{
            $response = [
                'estado' => false,
                'mensaje' => 'El detalle no existe !!'
            ];
        }

        echo json_encode($response);
    }

    public function getHorario($params){

        $this->cors->corsJson();
        $response = [];

        $horario_id = intval($params['horario_id']);
        $existe = Horarios::find($horario_id);

        $_b = Base::where('horario_id', $horario_id)->first();

        if($existe){
            $base = Detalle_Base::where('base_id', $_b->id)
                ->groupBy('horas_id')->orderBy('horas_id', 'asc')->get();
    
            $response = []; $row = [];  $horas = [];
    
            if($base->count()){
                $response = $base;
    
                foreach($response as $b){
                    $horas[] = $b->horas;
                    $horaDias = Detalle_Base::select('asignaciones_id')->where('horas_id', $b->horas_id)->orderBy('dia_id')->get();
    
                    foreach($horaDias as $asig){
                        $asig->asignaciones->docente->persona;
                        $asig->asignaciones->materia;
                    }
    
                    $aux = [
                        'hora' => $b->horas,
                        'dias' => $horaDias
                    ];
    
                    $row[] =  $aux;
                }            
            }
        }

        echo json_encode($row);
    }
}