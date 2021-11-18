<?php
require_once 'app/app.php';
require_once 'app/cors.php';
require_once 'app/request.php';
require_once 'core/conexion.php';
require_once 'models/estudianteModel.php';
require_once 'controllers/personaController.php';


class EstudianteController
{

    private $cors;
    private $conexion;
    private $personaController;

    public function __construct()
    {
        $this->cors = new Cors();
        $this->conexion = new Conexion();
        $this->personaController = new PersonaController();
    }

    public function listar()
    {
        $this->cors->corsJson();
        $response = [];

        $estudiante = Estudiante::where('estado', 'A')->get();

        foreach ($estudiante as $est) {
            $est->persona;
        }

        if ($estudiante) {
            $response = [
                'status' => true,
                'mensaje' => 'Si ahi datos',
                'estudiante' => $estudiante,
            ];
        } else {
            $response = [
                'status' => false,
                'mensaje' => 'No ahi datos',
                'estudiante' => null,
            ];
        }
        echo json_encode($response);

    }

    public function buscar($params)
    {
        $this->cors->corsJson();
        $id = intval($params['id']);
        $estudiante = Estudiante::find($id);
        $response = [];

        if ($estudiante) {
            $response = [
                'status' => true,
                'estudiante' => $estudiante,
                'persona_id' => $estudiante->persona->id,
            ];
        } else {
            $response = [
                'status' => false,
                'mensaje' => 'No se encuentra el estudiante',
                'estudiante' => null,
                'persona_id' => null,
            ];
        }
        echo json_encode($response);
    }

    public function guardar(Request $request)
    {
        $this->cors->corsJson();
        $estudianteRequest = $request->input('estudiante');
        $response = [];

        if (!isset($estudianteRequest) || $estudianteRequest == null) {
            $response = [
                'status' => false,
                'mensaje' => 'No hay datos para procesar',
            ];
        } else {
            $responsePersona = $this->personaController->guardarPersona($request);

            if ($responsePersona['status'] == false) {
                $response = [
                    'status' => false,
                    'mensaje' => 'La persona ya se encuentra registrada',
                    'persona' => $responsePersona,
                ];
            } else {
                $id_persona = $responsePersona['persona']->id;

                $nuevo = new Estudiante();
                $nuevo->persona_id = $id_persona;
                $nuevo->estado = 'A';

                $existeEstudiante = Estudiante::where('persona_id', $id_persona)->get()->first();

                if ($existeEstudiante) {
                    $response = [
                        'status' => false,
                        'mensaje' => 'El estudiante ya se encuentra registrado',
                        'estudiante' => $existeEstudiante,
                    ];
                } else {
                    $nuevo->save();

                    $response = [
                        'status' => true,
                        'mensaje' => 'El estudiante se ha guardado',
                        'estudiante' => $nuevo,
                    ];
                }
            }
        }
        echo json_encode($response);
    }

    public function datatable()
    {
        $this->cors->corsJson();
        $estudiantes = Estudiante::where('estado', 'A')->orderBy('persona_id')->get();
        $data = [];
        $i = 1;

        foreach ($estudiantes as $e) {
            $icono = $e->estado == 'I' ? '<i class="fa fa-check-circle fa-lg"></i>' : '<i class="fa fa-trash fa-lg"></i>';
            $clase = $e->estado == 'I' ? 'btn-success btn-sm' : 'btn-dark btn-sm';
            $other = $e->estado == 'A' ? 0 : 1;

            $botones = '<div class="btn-group">
                            <button class="btn btn-primary btn-sm" onclick="editar_estudiante(' . $e->id . ')">
                                <i class="fa fa-edit fa-lg"></i>
                            </button>
                            <button class="btn ' . $clase . '" onclick="eliminar_estudiante(' . $e->id . ',' . $other . ')">
                                ' . $icono . '
                            </button>
                        </div>';

            $data[] = [
                0 => $i,
                1 => $e->persona->cedula,
                2 => $e->persona->nombres,
                3 => $e->persona->apellidos,
                4 => $e->persona->telefono,
                5 => $e->persona->correo,
                6 => $e->persona->sexo,
                7 => $botones,
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

    public function editar(Request $request)
    {
        $this->cors->corsJson();
        $estudianteRequest = $request->input('estudiante');
        $id = intval($estudianteRequest->id);
        $persona_id = intval($estudianteRequest->persona_id);
        $response = [];

        $estudiante = Estudiante::find($id);
        if ($estudianteRequest) {
            if ($estudiante) {
                $estudiante->persona_id = $persona_id;

                $persona = Persona::find($estudiante->persona_id);
                $persona->nombres = ucfirst($estudianteRequest->nombres);
                $persona->apellidos = ucfirst($estudianteRequest->apellidos);
                $persona->telefono = $estudianteRequest->telefono;
                $persona->correo = $estudianteRequest->correo;
                $persona->sexo = $estudianteRequest->sexo;
                $persona->save();
                $estudiante->save();

                $response = [
                    'status' => true,
                    'mensaje' => 'El Estudiante se ha actualizado',
                    'data' => $estudiante,
                ];
            } else {
                $response = [
                    'status' => false,
                    'mensaje' => 'No se puede actualizar el estudiante',
                ];
            }
        } else {
            $response = [
                'status' => false,
                'mensaje' => 'No hay datos'
            ];
        }
        echo json_encode($response);
    }

    public function eliminar(Request $request)
    {
        $this->cors->corsJson();
        $estudianteRequest = $request->input('estudiante');
        $id = intval($estudianteRequest->id);

        $estudiante = Estudiante::find($id);
        $response = [];

        if ($estudiante) {
            $estudiante->estado = 'I';
            $estudiante->save();

            $response = [
                'status' => true,
                'mensaje' => 'Se ha eliminado el estudiante',
            ];
        } else {
            $response = [
                'status' => false,
                'mensaje' => 'No se ha podido eliminar el estudiante',
            ];
        }
        echo json_encode($response);
    }

    public function buscarEstudiante($params)
    {
        $this->cors->corsJson();
        $texto = ucfirst($params['texto']);
        $response = [];
        
        $sql = "SELECT e.id, p.cedula, p.nombres, p.apellidos, p.telefono, p.correo FROM personas p 
        INNER JOIN estudiantes e ON e.persona_id = p.id 
        WHERE p.estado = 'A' and (p.cedula LIKE '%$texto%' OR p.nombres LIKE '%$texto%' OR p.apellidos LIKE '%$texto%')";

        $array = $this->conexion->database::select($sql);

        if ($array) {
            $response = [
                'status' => true,
                'mensaje' => 'Existen datos',
                'estudiantes' => $array,
            ];
        } else {
            $response = [
                'status' => false,
                'mensaje' => 'No existen coincidencias',
                'estudiantes' => null,
            ];
        }
        echo json_encode($response);
    }
}
