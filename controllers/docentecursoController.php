<?php

require_once 'app/cors.php';
require_once 'app/app.php';
require_once 'app/error.php';
require_once 'app/cors.php';
require_once 'app/request.php';
require_once 'core/conexion.php';
require_once 'models/docentecursoModel.php';
require_once 'models/docenteModel.php';


class DocenteCursoController
{

    private $cors;

    public function __construct()
    {
        $this->cors = new Cors();
    }

    public function guardar($docente, $id_periodo, $id_docente, $id_curso, $id_paralelo)
    {

        if ($docente) {
            $nuevoDocCur = new DocenteCurso();
            $nuevoDocCur->periodo_id = $id_periodo;
            $nuevoDocCur->docente_id = $id_docente;
            $nuevoDocCur->curso_id = $id_curso;
            $nuevoDocCur->paralelo_id = $id_paralelo;
            $nuevoDocCur->estado = 'A';
            $nuevoDocCur->save();

            return $nuevoDocCur;
        } else {
            return null;
        }
    }

    public function dataTable()
    {
        $this->cors->corsJson();
        $DocCur = DocenteCurso::where('estado', 'A')->orderBy('docente_id')->get();

        $data = [];
        $i = 1;

        foreach ($DocCur as $item) {
            /* $url = BASE . 'resources/' . $u->foto; */
            //$estado = $u->estado == 'A' '<span class="badge bg-success">Activado</span>'?
            $icono = $item->estado == 'I' ? '<i class="fa fa-check-circle fa-lg"></i>' : '<i class="fa fa-trash fa-lg"></i>';
            $clase = $item->estado == 'I' ? 'btn-success btn-sm' : 'btn-dark btn-sm';
            $other = $item->estado == 'A' ? 0 : 1;

            $botones = '<div class="btn-group">
                            <button class="btn btn-primary btn-sm" onclick="editar_docenteCurso(' . $item->id . ')">
                                <i class="fa fa-edit fa-lg"></i>
                            </button>
                            <button class="btn ' . $clase . '" onclick="eliminar_docenteCurso(' . $item->id . ',' . $other . ')">
                                ' . $icono . '
                            </button>
                        </div>';

            $data[] = [
                0 => $i,
                1 => $item->docente->persona->nombres,
                2 => $item->docente->persona->apellidos,
                3 => $item->periodo->detalle,
                4 => $item->curso->curso,
                5 => $item->paralelo->detalle,
                6 => $botones,
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

    public function buscar($params)
    {
        $this->cors->corsJson();
        $id = intval($params['id']);
        $response = [];

        $dataDocCurso = DocenteCurso::find($id);
        $dataDocCurso->periodo;
        $dataDocCurso->curso;
        $dataDocCurso->docente->persona;
        $dataDocCurso->docente->docentecurso;
        $dataDocCurso->paralelo;

        if ($dataDocCurso) {

            $response = [
                'status' => true,
                'mensaje' => 'Existen Datos',
                'data' => $dataDocCurso
            ];
        } else {
            $response = [
                'status' => false,
                'mensaje' => 'No Existen Datos',
                'data' => null
            ];
        }
        echo json_encode($response);
    }

    public function eliminar(Request $request)
    {
        $this->cors->corsJson();
        $requeDocenteCurso = $request->input('docentecurso');
        $id = intval($requeDocenteCurso->id);
        $response = [];

        $dataDocenCurso = DocenteCurso::find($id);

        if ($dataDocenCurso) {
            $dataDocenCurso->estado = 'I';
            $dataDocenCurso->save();

            $response = [
                'status' => true,
                'mensaje' => 'Se ha eliminado el docente',
                'data' => $dataDocenCurso
            ];
        } else {
            $response = [
                'status' => false,
                'mensaje' => 'No Se ha eliminado el docente',
                'data' => null
            ];
        }
        echo json_encode($response);
    }

    public function editar(Request $request)
    {
        $this->cors->corsJson();
        $requeDocenteCurso = $request->input('docentecurso');

        $id = intval($requeDocenteCurso->id);
        $periodo_id = intval($requeDocenteCurso->periodo_id);
        $docente_id = intval($requeDocenteCurso->docente_id);
        $curso_id = intval($requeDocenteCurso->curso_id);
        $paralelo_id = intval($requeDocenteCurso->paralelo_id);
        $response = [];

        $dataDocenCurso = DocenteCurso::find($id);

        if ($requeDocenteCurso) {
            if ($dataDocenCurso) {
                $dataDocenCurso->periodo_id = $periodo_id;
                $dataDocenCurso->docente_id = $docente_id;
                $dataDocenCurso->curso_id = $curso_id;
                $dataDocenCurso->paralelo_id = $paralelo_id;

                $docente = Docente::find($docente_id);
                $persona = Persona::find($docente->persona_id);
                $persona->nombres = ucfirst($requeDocenteCurso->nombres);
                $persona->apellidos = ucfirst($requeDocenteCurso->apellidos);
                $persona->save();
                $docente->save();
                $dataDocenCurso->save();

                $response = [
                    'status' => true,
                    'mensaje' => 'El docente se ha actualizado',
                    'data' => $dataDocenCurso,
                ];
            } else {
                $response = [
                    'status' => false,
                    'mensaje' => 'El docente  no se ha actualizado',
                    'data' => null
                ];
            }
        } else {
            $response = [
                'status' => false,
                'mensaje' => 'No hay datos...!!'
            ];
        }
        echo json_encode($response);
    }
}
