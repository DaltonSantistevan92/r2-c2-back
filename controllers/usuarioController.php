<?php

require_once 'app/cors.php';
require_once 'app/request.php';
require_once 'core/conexion.php';
require_once 'app/error.php';
require_once 'app/helper.php';
require_once 'models/usuarioModel.php';
require_once 'models/personaModel.php';
require_once 'models/representanteModel.php';
require_once 'controllers/personaController.php';

class UsuarioController{

    private $cors;
    private $personaController;

    public function __construct()
    {
        $this->cors = new Cors();
        $this->personaController = new PersonaController();
    }

    public function getRepresentante(){
        $this->cors->corsJson();
        $representante = Usuario::where('rol_id',3)->get();
        $response = [];


        foreach($representante as $item){
            $item->persona;
            $item->rol;
        }

        if($representante){
            $response = [
                'status' => true,
                'mensaje' => 'Existen Datos',
                'representante' => $representante
            ];
        }else {
            $response = [
                'status' => false,
                'mensaje' => 'No Existen Datos',
                'representante' => null
            ];
        }
        echo json_encode($response);
    }

    public function buscar($params)
    {
        $this->cors->corsJson();
        $id = intval($params['id']);
        $usuario = Usuario::find($id);
        $response = [];

        if ($usuario) { 
            $response = [
                'status' => true,
                'usuario' => $usuario,
                'persona' => $usuario->persona,
                'rol' => $usuario->rol,
            ];
        } else {
            $response = [
                'status' => false,
                'mensaje' => 'No se encuentra el usuario',
                'usuario' => null,
                'persona' => null,
                'rol' => null
            ];
            
        }
        echo json_encode($response);
    }

    public function dataTable()
    {
        $this->cors->corsJson();
        $usuarios = Usuario::where('estado', 'A')->orderBy('persona_id')->get();

        $data = [];    $i = 1;

        foreach ($usuarios as $u) {
            $url = BASE . 'resources/' . $u->foto;
            //$estado = $u->estado == 'A' '<span class="badge bg-success">Activado</span>'?
            $icono = $u->estado == 'I' ? '<i class="fa fa-check-circle fa-lg"></i>' : '<i class="fa fa-trash fa-lg"></i>';
            $clase = $u->estado == 'I' ? 'btn-success btn-sm' : 'btn-dark btn-sm';
            $other = $u->estado == 'A' ? 0 : 1;

            $botones = '<div class="btn-group">
                            <button class="btn btn-purple btn-sm" onclick="editar_usuario(' . $u->id . ')">
                                <i class="fa fa-edit fa-lg"></i>
                            </button>
                            <button class="btn ' . $clase . '" onclick="eliminar(' . $u->id . ',' . $other . ')">
                                ' . $icono . '
                            </button>
                        </div>';

            $data[] = [
                0 => $i,
                1 => '<div class="box-img-usuario"><img src=' . "$url" . '></div>',
                2 => $u->persona->nombres,
                3 => $u->persona->apellidos,
                4 => $u->rol->rol,
                5 => $botones,
            ];
            $i++;
        }

        $result = [
            'sEcho' => 1,
            'iTotalRecords' => count($data),
            'iTotalDisplayRecords' => count($data),
            'aaData' => $data,
        ];
        echo json_encode($result);
    } 

    public function login(Request $request){
        $data = $request->input('credenciales');
        $entrada = $data->entrada; //cedula
        $clave = $data->clave;
        $encriptar = hash('sha256', $clave); //clave encriptada

        $this->cors->corsJson();
        $response = [];

        if ((!isset($entrada) || $entrada == "") || (!isset($clave) || $clave == "")) {
            $response = [
                'estatus' => false,
                'mensaje' => 'Falta datos',
            ];
        } else {
            $usuario = Usuario::where('persona_id',$entrada)->get()->first();
            $persona = Persona::where('cedula', $entrada)->get()->first(); //validar x cedula
            
            if($usuario || $persona){
                $us = $usuario;
                if($persona){
                    $us = $persona->usuario[0];
                }
                
                //Segun con la verificacion de credenciales
                if($encriptar == $us->clave){
                    $persona = Persona::find($us->persona->id);
                    //echo json_encode($persona); die();

                    $per = $us->persona->nombres . " " . $us->persona->apellidos;
                    $rol = $us->rol->rol;

                    $response = [
                        'status' => true,
                        'mensaje' => 'Sesion iniciada',
                        'rol' => $rol,
                        'persona' => $per,
                        'usuario' => $us
                    ];
                }else{
                    $response = [
                        'status' => false,
                        'mensaje' => 'La contraseña es incorrecta',
                    ];
                }
            }else{
                $response = [
                    'estatus' => false,
                    'mensaje' => 'La cedula no existe',
                ];

            }
                 
        }

        echo json_encode($response);
    }

    public function guardar(Request $request)
    {

        $this->cors->corsJson();
        $user = $request->input('usuario');
        $response = [];

        if (!isset($user) || $user == null) {
            $response = [
                'status' => false,
                'mensaje' => 'No hay datos para procesar',
                'usuario' => null,
            ];
        } else {
            $responsePersona = $this->personaController->guardarPersona($request);

            $id_pers = $responsePersona['persona']->id;

            $clave = $user->clave;
            $encriptar = hash('sha256', $clave);
            $user->rol_id = intval($user->rol_id);

            $usuario = new Usuario;
            $usuario->rol_id = $user->rol_id;
            $usuario->persona_id = $id_pers;
            $usuario->foto = $user->foto;
            $usuario->clave = $encriptar;
            $usuario->conf_clave = $encriptar;
            $usuario->estado = 'A';

                if ($usuario->save()) {
                    //verificamos un representante y guarda

                    $response = [
                        'status' => true,
                        'mensaje' => 'Se ha guardado el usuario',
                        'usuario' => $usuario,
                    ];
                } else {
                    $response = [
                        'status' => false,
                        'mensaje' => 'No se pudo guardar el usuario',
                        'usuario' => null,
                    ];
                }

        }
        echo json_encode($response);
    }

    public function subirFichero($file)
    {
        $this->cors->corsJson();
        $img = $file['fichero'];
        $path = 'resources/';

        $response = Helper::save_file($img, $path);
        echo json_encode($response);
    }

    //post
    public function editar(Request $request){
        
        $this->cors->corsJson();   
        $usuRequest = $request->input('usuario');

        $id = intval($usuRequest->id);
        $persona_id = intval($usuRequest->persona_id);
        $rol_id = intval($usuRequest->rol_id);
       
        $response = [];       
        $usu = Usuario::find($id);
        if($usuRequest){
            if($usu){
                $usu->rol_id = $rol_id;
                $usu->persona_id = $persona_id;
                $persona = Persona::find($usu->persona_id);
                $persona->nombres = ucfirst($usuRequest->nombres);
                $persona->apellidos = ucfirst($usuRequest->apellidos);
                $persona->save();
                $usu->save();  

                $response = [
                    'status' => true,
                    'mensaje' => 'El Usuario se ha actualizado',
                    'data' => $usu,
                ];
            }else {
                $response = [
                    'status' => false,
                    'mensaje' => 'No se puede actualizar el usuario',
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
        $usuarioRequest = $request->input('usuario');
        $id = intval($usuarioRequest->id);

        $usuario = Usuario::find($id);
        $response = [];

        if($usuario){
            $usuario->estado = 'I';
            $usuario->save();

            $response = [
                'status' => true,
                'mensaje' => 'Se ha eliminado el usuario', 
            ];
        }else{
            $response = [
                'status' => false,
                'mensaje' => 'No se ha podido eliminar el usuario', 
            ];
        }
        echo json_encode($response);
    }

}