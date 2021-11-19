<?php

require_once 'app/cors.php';
require_once 'app/request.php';
require_once 'core/conexion.php';
require_once 'models/abastecerModel.php';
require_once 'models/ordenModel.php';
require_once 'controllers/detalleAbastecerController.php';


class AbastecerController
{
    private $cors;
    private $db;

    public function __construct()
    {
        $this->cors = new Cors();
        $this->db = new Conexion();
    }

    public function getOrden($params)
    {
        $tipo = $params['tipo'];
        $registro = Orden::where('tipo',$tipo)->orderBy('id', 'DESC')->first();
        $response = [];

        if ($registro == null) {
            $response = [
                'status' => true,
                'tipo' => $tipo,
                'mensaje' => 'Primer registro',
                'orden' => '00001',
            ];
        } else {
            $numero = intval($registro->num_orden);
            $siguiente = '0000' . ($numero += 1);
            $response = [
                'status' => true,
                'tipo' => $tipo,
                'mensaje' => 'Aumentando registro',
                'orden' => $siguiente,
            ];
        }
        echo json_encode($response);
    }

    public function aumentarOrden(Request $request)
    {
        $this->cors->corsJson();
        $tipoRequest = $request->input('orden');
        $num_orden = $tipoRequest->num_orden;
        $tipo = $tipoRequest->tipo;
        $response = [];

        if ($tipoRequest == null) {
            $response = [
                'status' => false,
                'mensaje' => 'no ahi datos',
            ];
        } else {
            $nuevo = new Orden();
            $nuevo->num_orden = $num_orden;
            $nuevo->tipo = $tipo;
            $nuevo->estado = 'A';
            $nuevo->save();

            $response = [
                'status' => true,
                'mensaje' => 'Guardando datos',
                'orden' => $nuevo,
            ];
        }
        echo json_encode($response);
    }

    public function guardar(Request $request)
    {
        $this->cors->corsJson();
        $dataAbastecer = $request->input("abastecer");
        $detalles_abastecer = $request->input("detalle_abastecer");
        $response = [];

        if($dataAbastecer){
            $proveedor_id = intval($dataAbastecer->proveedor_id);
            $usuario_id = intval($dataAbastecer->usuario_id);
            $codigo = $dataAbastecer->codigo;

            $nuevo = new Abastecer();
            $nuevo->proveedor_id = $proveedor_id;
            $nuevo->usuario_id = $usuario_id;
            $nuevo->codigo = $codigo;
            $nuevo->fecha = date('Y-m-d');
            $nuevo->estado = 'A';

            $existe = Abastecer::where('codigo',$codigo)->get()->first();

            if($existe){
                $response = [
                    'status' => false,
                    'mensaje' => 'El codigo ya existe',
                    'abastecer' => null,
                    'detalle' => null
                ];
            }else{
                if($nuevo->save()){

                    //Guardar detalle_abastecer
                    $detalleAbastecerController = new DetalleAbastecerController();
                    $extra = $detalleAbastecerController->guardar($nuevo->id,$detalles_abastecer);
                    
                    //Insertar nueva Transaccion

                    //actualizar el inventario

                    $response = [
                        'status' => true,
                        'mensaje' => 'Guardando los datos',
                        'abastecer' => $nuevo,
                        'detalle' => $extra 
                    ];
                }
            }
        }else{
            $response = [
                'status' => false,
                'mensaje' => 'No hay datos para procesar',
                'abastecer' => null,
                'detalle' => null
            ];
        }
        echo json_encode($response);
    }
}





