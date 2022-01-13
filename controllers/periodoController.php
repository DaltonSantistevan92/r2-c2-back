<?php
require_once 'app/cors.php';
require_once 'models/periodoModel.php';


class PeriodoController{

    private $cors;

    public function __construct(){
        $this->cors = new Cors();
    }

    public function guardar(Request $request){
        $periodo = $request->input('periodo');
        $response = [];

       if($periodo){
            $auxTexto = str_replace(' ', '', $periodo->detalle);
            $existe = false;

            $all = Periodo::where('estado', 'A')->get();
            foreach($all as $item){
                $temp = str_replace(' ', '', $item->detalle);

                if($temp == $auxTexto){
                    $existe = true;
                    break;
                }
            }

            if($existe){
                $response = [
                    'status' => false,
                    'mensaje' => 'El periodo ya se encuentra registrado !!' 
                ];
            }else{
                $nuevo = new Periodo();
                $nuevo->detalle = $periodo->detalle;
                $nuevo->desde = $periodo->desde;
                $nuevo->hasta = $periodo->hasta;
                $nuevo->definir = 'N';
                $nuevo->estado = 'A';
                $nuevo->save();

                $response = [
                    'status' => true,
                    'mensaje' => 'Se ha registrado el periodo'
                ];
            }
       }else{
           $response = [
               'status' => false,
               'mensaje' => 'No hay datos para procesar'
           ];
       }
       echo json_encode($response);
    }

    public function listar(){

        $this->cors->corsJson();
        $periodos = Periodo::where('estado','A')->get();
        $response = [];

        if($periodos){
            $response = [
                'status' => true,
                'mensaje' => 'Existem datos',
                'data' => $periodos
            ];
        }else{
            $response = [
                'status' => false,
                'mensaje' => 'No existem datos',
                'data' => []
            ];
        }
        echo json_encode($response);
    }

    public function buscar($params){
        $this->cors->corsJson();
        $id = intval($params['id']);
        $response = [];

        $periodo = Periodo::find($id);

        if($periodo){
            $response = [
                'status' => true,
                'mensaje' => 'Existen Datos',
                'periodo' =>$periodo
            ];
        }else{
            $response = [
                'status' => false,
                'mensaje' => 'No Existen Datos',
                'periodo' => null
            ];
        }
        echo json_encode($response);
    }

    public function definir(Request $request){

        $periodo = $request->input('periodo');
        $response = [];

        if($periodo){
            $periodo->id = intval($periodo->id);
    
            $all = Periodo::where('estado', 'A')->get();
            foreach($all as $item){
                $item->definir = 'N';
                $item->save();
            }
    
            $dato = Periodo::find($periodo->id);
            $dato->definir = 'S';
            $dato->save();
    
            $response = [
                'status' => true,
                'mensaje' => 'El periodo >>'.$dato->detalle.'<< esta establecido'
            ];
        }else{
            $response = [
                'status' => false,
                'No se puede establecer'
            ];
        }

        echo json_encode($response);
    }

    public function eliminar(Request $request){
        $this->cors->corsJson();
        $periodoRequest = $request->input('periodo');
        $id = intval($periodoRequest->id);
        $response = [];
        
        $periodo = Periodo::find($id);
        if($periodo){
            $periodo->estado = 'I';
            $periodo->save();
            $response = [
                'status' => true,
                'mensaje' => 'se ha eliminado el periodo',
                'periodo' => $periodo   
            ];
        }else {
            $response = [
                'status' => false,
                'mensaje' => 'No se ha eliminado el periodo',
                'periodo' => null   
            ];
        }
        echo json_encode($response);

    }

    public function editar(Request $request){
        $this->cors->corsJson();
        $periodoRequest = $request->input('periodo');
        $id = intval($periodoRequest->id);
        $detalle = intval($periodoRequest->detalle);
        $response = [];

        $dataPeriodo = Periodo::find($id);

        if($periodoRequest){
            if($dataPeriodo){
                $dataPeriodo->detalle = $detalle;
                $dataPeriodo->save();

                $response = [
                    'status' => true,
                    'mensaje' => 'El Periodo se ha actualizado',
                    'periodo' => $dataPeriodo,
                ];
            }else {
                $response = [
                    'status' => false,
                    'mensaje' => 'No se puede actualizar el periodo',
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


} 