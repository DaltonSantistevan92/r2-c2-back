<?php
require_once 'app/cors.php';
require_once 'models/areaModel.php';


class AreaController{

    private $cors;

    public function __construct(){
        $this->cors = new Cors();
    }

    public function listar(){
        $this->cors->corsJson();
        $area = Area::where('estado', 'A')->orderBy('detalle','Asc')->get();
        $response = [];

        if ($area) {
            $response = [
                'status' => true,
                'mensaje' => 'Existem datos',
                'area' => $area
            ];
        } else {
            $response = [
                'status' => false,
                'mensaje' => 'No existem datos',
                'area' => []
            ];
        }
        echo json_encode($response);
    }

    public function guardar(Request $request){

        $this->cors->corsJson();
        $dataArea = $request->input('area');

        $existe = Area::where('detalle', $dataArea->detalle)->first();
        $response = [];

        if($existe){
            $response = [
                'status' => false,
                'message' => 'El area ingresada ya existe !!'
            ];
        }else{
            $new = new Area();
            $new->detalle = trim(ucfirst($dataArea->detalle));
            $new->estado = 'A';
            $new->save();

            $response = [
                'status' => true,
                'message' => 'Area registrada correctamente'
            ];
        }

        echo json_encode($response);
    }

    public function delete(Request $request){

        $dataArea = $request->input('area');

        $area = Area::find(intval($dataArea->id));
        $response = [];

        if($area){
            $area->estado = 'I';
            $area->save();

            $response = [
                'status' => true,
                'message' => 'Area eliminada !'
            ];
        }else{
            $response = [
                'status' => false,
                'message' => 'El area no se encuentra'
            ];
        }   
        echo json_encode($response);
    }
}