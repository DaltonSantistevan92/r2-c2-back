<?php

require_once 'app/cors.php';
require_once 'app/app.php';
require_once 'app/error.php';
require_once 'app/cors.php';
require_once 'app/request.php';
require_once 'core/conexion.php';
require_once 'models/horasModel.php';


class HorasController
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
        
        $hora = Horas::where('estado','A')->get();

        if($hora){
            $response = [
                'status' => true,
                'mensaje' => 'existen datos',
                'hora' => $hora
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

    public function guardarHora(Request $request){
        $this->cors->corsJson();
        $response = [];

        $horaRequest = $request->input('horas'); 
        
        if($horaRequest){
            
            $nuevaHora = new Horas();
            $nuevaHora->inicio = $horaRequest->inicio;
            $nuevaHora->fin = $horaRequest->fin;
            $nuevaHora->estado = 'A';
            
            $existeHora = Horas::where('inicio',$horaRequest->inicio)
                                ->where('fin',$horaRequest->fin)
                                ->get()->first();
                                
            if($existeHora){
                $response = [
                    'status' => false,
                    'mensaje' => 'La hora inicio y fin ya existe',
                    'hora' => null
                ];
            }else{
                if($nuevaHora->save()){
                    $response = [
                        'status' => true,
                        'mensaje' => 'La hora se registro correctamente',
                        'hora' => $nuevaHora,
                    ];
                }else{
                    $response = [
                        'status' => false,
                        'mensaje' => 'La hora no se pudo registrar',
                        'hora' => null
                    ];
                }
            }
        }else{
            $response = [
                'status' => false,
                'mensaje' => 'no hay datos',
                'hora' => null
            ];
        }
        echo json_encode($response);
    }

}