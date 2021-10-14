<?php

require_once 'app/cors.php';
require_once 'app/request.php';
require_once 'app/error.php';
require_once 'models/rolModel.php';

class RolController{

    private $cors;
  

    public function __construct()
    {
        $this->cors = new Cors();
       
    }

    public function listar($params){
        $this->cors->corsJson();
        $id = intval($params['id']);

        $rol = Rol::find($id);
        $response = [];
    
        if($rol){
            $response = [
                'status' => true,
                'mensaje' => 'Existen Datos',
                'rol' => $rol
            ];
        }else{
            $response = [
                'status' => false,
                'mensaje' => 'No existen Datos',
                'rol' => null
            ];
        }
        echo json_encode($response);
    }

    public function guardar(Request $request){
        $this->cors->corsJson();
        $rolRequest = $request->input('rol');
        $rol = ucfirst($rolRequest->rol);
        $descripcion = ucfirst($rolRequest->descripcion);
        $response = [];

        if($rolRequest){
            $nuevoRol = new Rol;
            //validar si existe el nombre del rol
            $existeRol = Rol::where('rol',$rol)->get()->first();
            
            if ($existeRol) {
                $response = [
                    'status' => false,
                    'mensaje' => 'El rol ya existe',
                    'rol' => null,
                ];
            }else {
                $nuevoRol->rol = $rol;
                $nuevoRol->descripcion =$descripcion;
                $nuevoRol->estado = 'A';

                if($nuevoRol->save()){
                    $response = [
                        'status' => true,
                        'mensaje' => 'Guardando los datos',
                        'rol' => $nuevoRol,
                    ];
                }else{
                    $response = [
                        'status' => false,
                        'mensaje' => 'No se pudo guradar',
                        'rol' =>  null,
                    ];
                }
            }
        }else{
            $response = [
                'status' => false,
                'mensaje' => 'No hay datos para procesar',
                'rol' => null,
            ];
        }
        echo json_encode($response);
    }

    //lista como dataTable
    public function getRoles(){
        $this->cors->corsJson();
        $response = [];

        $roles = Rol::where('estado','A')->orderBy('rol')->get();
        if($roles){
            $response = [
                'status' => true,
                'mensaje' => 'Existen datos',
                'roles' => $roles               
            ];
        }else{
            $response = [
                'status' => false,
                'mensaje' => 'No existen datos',
                'roles' => null              
            ];
        }
        echo json_encode($response);
    }

    public function eliminar(Request $request){
        $this->cors->corsJson();
        $rolRequest = $request->input('rol');
        $id = intval($rolRequest->id);
        
        $rol = Rol::find($id);
        $response = [];
        
        if($rol){
            $rol->estado = 'I';
            $rol->save();

            $response = [
                'status' => true,
                'mensaje' => 'Se ha eliminado el rol', 
            ];
        }else{
            $response = [
                'status' => false,
                'mensaje' => 'No se ha podido eliminar el usuario', 
            ];
        }
        echo json_encode($response);
    }

    public function editar(Request $request){
        $this->cors->corsJson();
        $rolRequest = $request->input('rol');
        $id = intval($rolRequest->id);

        $rol = ucfirst($rolRequest->rol);
        $descripcion = ucfirst($rolRequest->descripcion);
        $response = [];

        $rolData = Rol::find($id);

        if($rolRequest){
            if($rolData){
                $rolData->rol = $rol;
                $rolData->descripcion = $descripcion;
                $rolData->save();

                $response = [
                    'status' => true,
                    'mensaje' => 'El Rol se ha actualizado',
                    'rol' => $rolData,
                ];
            }else{
                $response = [
                    'status' => false,
                    'mensaje' => 'No se puede actualizar el rol',
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

