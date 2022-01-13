<?php

require_once 'app/cors.php';
require_once 'app/app.php';
require_once 'app/error.php';
require_once 'app/cors.php';
require_once 'app/request.php';
require_once 'core/conexion.php';
require_once 'models/baseModel.php';
require_once 'controllers/detalle_baseController.php';


class BaseController
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
        
        $base = Base::where('estado','A')->get();

        if($base){
            $response = [
                'status' => true,
                'mensaje' => 'existen datos',
                'base' => $base
            ];
        }else{
            $response = [
                'status' => false,
                'mensaje' => 'no existen datos',
                'base' => null
            ];
        }
        echo json_encode($response);
    }

    public function guardar(Request $request){
        $this->cors->corsJson();
        $response = [];

        $baseRequest = $request->input('base');
        $detalleBaseRequest = $request->input('detalle_base');

        if($baseRequest){
            $nombre = ucfirst($baseRequest->nombre);
            $horario_id = intval($baseRequest->horario_id);

            $nuevaBase = new Base();
            $nuevaBase->nombre = $nombre;
            $nuevaBase->horario_id = $horario_id;
            $nuevaBase->estado = 'A';

            $existeBase = Base::where('nombre',$nombre)->where('horario_id',$horario_id)->get()->first();

            if($existeBase){
                $response = [
                    'status' => false,
                    'mensaje' => 'El nombre y el horario de la base ya existe',
                    'base' => null
                ];
            }else{
                if($nuevaBase->save()){

                    //guarda a detalle base
                    $detalleBaseController = new Detalle_BaseController();
                    $extra = $detalleBaseController->guardar($nuevaBase->id,$detalleBaseRequest);

                    $response = [
                        'status' => true,
                        'mensaje' => 'La base se registro correctamente',
                        'base' => $nuevaBase,
                        'detalle_base' => $extra
                    ];
                }else{
                    $response = [
                        'status' => false,
                        'mensaje' => 'La base no se pudo registrar',
                        'base' => null
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