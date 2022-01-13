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

            $nuevaDetalleBase = new Detalle_Base();
            $nuevaDetalleBase->base_id = $base_id;
            $nuevaDetalleBase->horas_id = $horas_id;
            $nuevaDetalleBase->estado = 'A';

            $existeDetalleBase = Detalle_Base::where('base_id',$base_id)
                                            ->where('horas_id',$horas_id)->get()->first();

            if($existeDetalleBase){
                $response = [
                    'status' => false,
                    'mensaje' => 'El detalle de la base ya existe',
                    'detalle_base' => null
                ];
            }else{
                if($nuevaDetalleBase->save()){
                    $response = [
                        'status' => true,
                        'mensaje' => 'El detalle base se registro correctamente',
                        'detalle_base' => $nuevaDetalleBase
                    ];
                }else{
                    $response = [
                        'status' => false,
                        'mensaje' => 'El detalle base no se pudo registrar',
                        'detalle_base' => null
                    ];
                }
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

}