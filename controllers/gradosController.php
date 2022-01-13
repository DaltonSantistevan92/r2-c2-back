<?php
require_once 'app/cors.php';
require_once 'models/gradosModel.php';


class GradosController
{

    private $cors;

    public function __construct()
    {
        $this->cors = new Cors();
    }


    public function buscarid($params){
        $this->cors->corsJson();

        $id = intval($params['id']);

        $grados = Grados::find($id);
        $response = [];

        if ($grados) {
            $response = [
                'status' => true,
                'mensaje' => 'Existem datos',
                'grados' => $grados
            ];
        } else {
            $response = [
                'status' => false,
                'mensaje' => 'No existem datos',
                'grados' => []
            ];
        }
        echo json_encode($response);
    }

    public function listar(){
        $this->cors->corsJson();
        $grados = Grados::where('estado', 'A')->get();
        $response = [];

        if ($grados) {
            $response = [
                'status' => true,
                'mensaje' => 'Existem datos',
                'grados' => $grados
            ];
        } else {
            $response = [
                'status' => false,
                'mensaje' => 'No existem datos',
                'grados' => []
            ];
        }
        echo json_encode($response);
    }

    public function guardar(Request $request){
        $this->cors->corsJson();
        $gradoRequest = $request->input('grado');
        $response = [];

        if($gradoRequest){
            $nombre_grado = ucfirst($gradoRequest->nombre_grado);

            $nuevoGrado = new Grados();
            $nuevoGrado->nombre_grado = $nombre_grado;
            $nuevoGrado->estado = 'A';

            $existeGrado = Grados::where('nombre_grado',$nombre_grado)->get()->first();

            if($existeGrado){
                $response = [
                    'status' => false,
                    'mensaje' => 'El nombre del grado ya existe',
                    'grado' => null
                ];
            }else{
                if($nuevoGrado->save()){
                    $response = [
                        'status' => true,
                        'mensaje' => 'El grado se registró correctamente',
                        'grado' => $nuevoGrado
                    ];
                }else{
                    $response = [
                        'status' => false,
                        'mensaje' => 'El grado no se registrar',
                        'grado' => null
                    ];
                }
            }
        }else{
            $response = [
                'status' => false,
                'mensaje' => 'no hay datos para procesar',
                'grado' => null
            ];
        }

        echo json_encode($response);

    }

    public function editar(Request $request){
        $this->cors->corsJson();
        $gradoRequest = $request->input('grado');
        $id = intval($gradoRequest->id);
        $nombre_grado =ucfirst($gradoRequest->nombre_grado);
        $response = [];

        $dataGrado = Grados::find($id);

        if($gradoRequest){
            if($dataGrado){
                $dataGrado->nombre_grado = $nombre_grado;
                $dataGrado->save();

                $response = [
                    'status' => true,
                    'mensaje' => 'El Grado se ha actualizado',
                    'grado' => $dataGrado,
                ];
            }else {
                $response = [
                    'status' => false,
                    'mensaje' => 'No se puede actualizar el grado',
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
        $gradoRequest = $request->input('grado');
        $id = intval($gradoRequest->id);
        $response = [];
        
        $grado = Grados::find($id);
        if($grado){
            $grado->estado = 'I';
            $grado->save();
            $response = [
                'status' => true,
                'mensaje' => 'se ha eliminado el grado',
                'grado' => $grado   
            ];
        }else {
            $response = [
                'status' => false,
                'mensaje' => 'No se ha eliminado el grado',
                'grado' => null   
            ];
        }
        echo json_encode($response);

    }

}