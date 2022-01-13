<?php
require_once 'app/cors.php';
require_once 'models/paraleloModel.php';


class ParaleloController
{

    private $cors;

    public function __construct()
    {
        $this->cors = new Cors();
    }

    public function buscar($params){
        $this->cors->corsJson();

        $id = intval($params['id']);

        $paralelo = Paralelo::find($id);
        $response = [];

        if ($paralelo) {
            $response = [
                'status' => true,
                'mensaje' => 'Existem datos',
                'paralelo' => $paralelo
            ];
        } else {
            $response = [
                'status' => false,
                'mensaje' => 'No existem datos',
                'paralelo' => []
            ];
        }
        echo json_encode($response);
    }

    public function listar()
    {
        $this->cors->corsJson();
        $paralelos = Paralelo::where('estado', 'A')->get();
        $response = [];

        if ($paralelos) {
            $response = [
                'status' => true,
                'mensaje' => 'Existem datos',
                'data' => $paralelos
            ];
        } else {
            $response = [
                'status' => false,
                'mensaje' => 'No existem datos',
                'data' => []
            ];
        }
        echo json_encode($response);
    }

    public function guardar(Request $request){
        $this->cors->corsJson();
        $paraleloRequest = $request->input('paralelo');
        $response = [];

        if($paraleloRequest){
            $detalle = ucfirst($paraleloRequest->detalle);

            $nuevoParalelo = new Paralelo();
            $nuevoParalelo->detalle = $detalle;
            $nuevoParalelo->estado = 'A';

            $existeParalelo = Paralelo::where('detalle',$detalle)->get()->first();

            if($existeParalelo){
                $response = [
                    'status' => false,
                    'mensaje' => 'El nombre del paralelo ya existe',
                    'paralelo' => null
                ];
            }else{
                if($nuevoParalelo->save()){
                    $response = [
                        'status' => true,
                        'mensaje' => 'El paralelo se registró correctamente',
                        'paralelo' => $nuevoParalelo
                    ];
                }else{
                    $response = [
                        'status' => false,
                        'mensaje' => 'El paralelo no se registrar',
                        'paralelo' => null
                    ];
                }
            }
        }else{
            $response = [
                'status' => false,
                'mensaje' => 'no hay datos para procesar',
                'paralelo' => null
            ];
        }
        echo json_encode($response);
    }

    public function editar(Request $request){
        $this->cors->corsJson();
        $paraleloRequest = $request->input('paralelo');
        $id = intval($paraleloRequest->id);
        $detalle = ucfirst($paraleloRequest->detalle);
        $response = [];

        $dataParalelo = Paralelo::find($id);

        if($paraleloRequest){
            if($dataParalelo){
                $dataParalelo->detalle = $detalle;
                $dataParalelo->save();

                $response = [
                    'status' => true,
                    'mensaje' => 'El Paralelo se ha actualizado',
                    'paralelo' => $dataParalelo,
                ];
            }else {
                $response = [
                    'status' => false,
                    'mensaje' => 'No se puede actualizar el paralelo',
                ];
            }
        }else{
            $response = [
                'status' => false,
                'mensaje' => 'No hay datos...!!'
            ];
        }
        echo json_encode($response);
    }

    public function eliminar(Request $request){
        $this->cors->corsJson();
        $paraleloRequest = $request->input('paralelo');
        $id = intval($paraleloRequest->id);
        $response = [];
        
        $paralelo = Paralelo::find($id);
        if($paralelo){
            $paralelo->estado = 'I';
            $paralelo->save();
            $response = [
                'status' => true,
                'mensaje' => 'se ha eliminado el paralelo',
                'paralelo' => $paralelo   
            ];
        }else {
            $response = [
                'status' => false,
                'mensaje' => 'No se ha eliminado el paralelo',
                'paralelo' => null   
            ];
        }
        echo json_encode($response);

    }

    
}
