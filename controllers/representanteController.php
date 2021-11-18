<?php

require_once 'app/cors.php';
require_once 'app/request.php';
require_once 'core/conexion.php';
require_once 'app/error.php';
require_once 'app/helper.php';
require_once 'models/representanteModel.php';
require_once 'models/personaModel.php';

class RepresentanteController
{

    private $cors;
    private $conexion;

    public function __construct()
    {
        $this->cors = new Cors();
        $this->conexion = new Conexion();

    }

    public function guardar($representante, $id_persona, $id_parentesco, $id_especial, $fecha)
    {

        if ($representante) {
            $nuevoRepresentante = new Representante();
            $nuevoRepresentante->persona_id = $id_persona;
            $nuevoRepresentante->parentesco_id = $id_parentesco;
            $nuevoRepresentante->especial_id = $id_especial;
            $nuevoRepresentante->fecha_nac = $fecha;
            $nuevoRepresentante->estado = 'A';
            $nuevoRepresentante->save();

            return $nuevoRepresentante;
        } else {
            return null;
        }
    }

    public function buscar($params)
    {
        $this->cors->corsJson();
        $id = intval($params['id']);
        $representante = Representante::find($id);
        $response = [];

        if ($representante) {
            $response = [
                'status' => true,
                'representante' => $representante,
                'persona' => $representante->persona,
            ];
        } else {
            $response = [
                'status' => false,
                'mensaje' => 'No se encuentra el representante',
                'representante' => null,
                'persona' => null,
            ];

        }
        echo json_encode($response);
    }

    public function listar()
    {
        $this->cors->corsJson();
        $response = [];

        $representante = Representante::where('estado', 'A')->get();

        foreach ($representante as $repre) {
            $repre->persona;
        }

        if ($representante) {
            $response = [
                'status' => true,
                'mensaje' => 'Si ahi datos',
                'representante' => $representante,
            ];
        } else {
            $response = [
                'status' => false,
                'mensaje' => 'No ahi datos',
                'representante' => null,
            ];
        }
        echo json_encode($response);

    }

    public function buscarRepresentante($params)
    {
        $this->cors->corsJson();
        $texto = strtolower($params['texto']);
        $response = [];

        $sql = "SELECT r.id,u.id,p.cedula,p.nombres,p.apellidos,p.telefono,p.correo,p.sexo FROM personas p
        INNER JOIN  usuarios u ON u.persona_id=p.id
        inner join roles r on u.rol_id=3=r.id
        where p.estado = 'A' and (p.cedula like '%$texto%' or p.nombres like '%$texto%' or p.apellidos like '%$texto%')";

        $array = $this->conexion->database::select($sql);

        if ($array) {
            $response = [
                'status' => true,
                'mensaje' => 'Existen datos',
                'representante' => $array,
            ];
        } else {
            $response = [
                'status' => false,
                'mensaje' => 'No existen coincidencias',
                'representante' => null,
            ];
        }
        echo json_encode($response);

    }

    public function dataTable()
    {
        $this->cors->corsJson();
        $representante = Representante::where('estado', 'A')->orderBy('persona_id')->get();

        $data = [];
        $i = 1;

        foreach ($representante as $r) {
            $icono = $r->estado == 'I' ? '<i class="fa fa-check-circle fa-lg"></i>' : '<i class="fa fa-trash fa-lg"></i>';
            $clase = $r->estado == 'I' ? 'btn-success btn-sm' : 'btn-dark btn-sm';
            $other = $r->estado == 'A' ? 0 : 1;

            $botones = '<div class="btn-group">
                            <button class="btn btn-primary btn-sm" onclick="editar_representante(' . $r->id . ')">
                                <i class="fa fa-edit fa-lg"></i>
                            </button>
                            <button class="btn ' . $clase . '" onclick="eliminar(' . $r->id . ',' . $other . ')">
                                ' . $icono . '
                            </button>
                        </div>';

            $data[] = [
                0 => $i,
                1 => $r->persona->cedula,
                2 => $r->persona->nombres . ' ' . $r->persona->apellidos,
                3 => $r->persona->telefono,
                4 => $r->persona->correo,
                5 => $r->persona->sexo,
                6 => $r->parentesco->detalle,
                7 => $r->especial->descripcion,
                8 => $r->fecha_nac,
                9 => $botones,
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

    public function eliminar(Request $request)
    {
        $this->cors->corsJson();
        $representanteRequest = $request->input('representante');
        $id = intval($representanteRequest->id);

        $representante = Representante::find($id);
        $response = [];

        if ($representante) {
            $representante->estado = 'I';
            $representante->save();

            $response = [
                'status' => true,
                'mensaje' => 'Se ha eliminado el representante',
            ];
        } else {
            $response = [
                'status' => false,
                'mensaje' => 'No se ha podido eliminar el representante',
            ];
        }
        echo json_encode($response);
    }

    //post
    public function editar(Request $request)
    {
        $this->cors->corsJson();
        $repRequest = $request->input('representante');

        $id = intval($repRequest->id);
        $persona_id = intval($repRequest->persona_id);
        $parentesco_id = intval($repRequest->parentesco_id);
        $especial_id = intval($repRequest->especial_id);
        $fecha_nac = $repRequest->fecha_nac;

        $response = [];
        $repre = Representante::find($id);

        if ($repRequest) {
            if ($repre) {
                $repre->persona_id = $persona_id;
                $repre->parentesco_id = $parentesco_id;
                $repre->especial_id = $especial_id;
                $repre->fecha_nac = $fecha_nac;
                $repre->estado = 'A';

                $persona = Persona::find($repre->persona_id);
                $persona->nombres = ucfirst($repRequest->nombres);
                $persona->apellidos = ucfirst($repRequest->apellidos);
                $persona->telefono = $repRequest->telefono;
                $persona->correo = $repRequest->correo;
                $persona->sexo = $repRequest->sexo;
                $persona->save();
                $repre->save();

                $response = [
                    'status' => true,
                    'mensaje' => 'El Representante se ha actualizado',
                    'data' => $repre,
                ];
            } else {
                $response = [
                    'status' => false,
                    'mensaje' => 'No se puede actualizar el representante',
                ];
            }
        } else {
            $response = [
                'status' => false,
                'mensaje' => 'No hay datos...!!',
            ];
        }
        echo json_encode($response);
    }

}
