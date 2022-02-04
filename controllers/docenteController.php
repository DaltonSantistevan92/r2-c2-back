<?php

require_once 'app/cors.php';
require_once 'app/app.php';
require_once 'app/error.php';
require_once 'app/cors.php';
require_once 'app/request.php';
require_once 'core/conexion.php';
require_once 'models/docenteModel.php';

class DocenteController
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

        $docente = Docente::where('estado','A')->where('guia','N')->orWhere('guia','A')->get();

        if($docente){
            foreach($docente as $d){
                $d->persona;
            }
            $response = [
                'status' => true,
                'mensaje' => 'existen datos',
                'docente' => $docente
            ];
        }else{
            $response = [
                'status' => false,
                'mensaje' => 'no existen datos',
                'docente' => null
            ];
        }
        echo json_encode($response);
    }

    public function datatale(){
        $docentes = Docente::where('estado', 'A')->get();
        foreach($docentes as $d) $d->persona;

        $i = 1; $data = [];
        foreach ($docentes as $item) {
            /* $url = BASE . 'resources/' . $u->foto; */
            //$estado = $u->estado == 'A' '<span class="badge bg-success">Activado</span>'?
            $icono = $item->estado == 'I' ? '<i class="fa fa-check-circle fa-lg"></i>' : '<i class="fa fa-trash fa-lg"></i>';
            $clase = $item->estado == 'I' ? 'btn-success btn-sm' : 'btn-dark btn-sm';
            $other = $item->estado == 'A' ? 0 : 1;

            $botones = '<div class="btn-group">
                            <button class="btn btn-primary btn-sm" onclick="editar_docenteCurso(' . $item->id . ')">
                                <i class="fa fa-edit fa-lg"></i>
                            </button>
                            <button class="btn ' . $clase . '" onclick="eliminar_docenteCurso('.$item->id.')">
                                '.$icono .'
                            </button>
                        </div>';

            $data[] = [
                0 => $i,
                1 => $item->persona->cedula,
                2 => $item->persona->nombres,
                3 => $item->persona->apellidos,
                4 => $item->persona->telefono,
                5 => $botones,
            ];  $i++;
        }

        $result = [
            'sEcho' => 1,
            'iTotalRecords' => count($data),
            'iTotalDisplayRecords' => count($data),
            'aaData' => $data,
        ];

        echo json_encode($result);
    }

    public function buscarDocente($params)
    {
        $this->cors->corsJson();
        $texto = ucfirst($params['texto']);
        $response = [];

        // $sql = "SELECT d.id,p.cedula,p.nombres,p.apellidos,p.telefono,p.correo FROM personas p
        // INNER JOIN docentes d ON d.persona_id = p.id WHERE d.guia = 'N'
        // and p.estado = 'A' and (p.cedula LIKE '$texto%' OR p.nombres LIKE '%$texto%' OR p.apellidos LIKE '%$texto%')";

        $sql = "SELECT d.id,p.cedula,p.nombres,p.apellidos,p.telefono,p.correo FROM personas p
        INNER JOIN docentes d ON d.persona_id = p.id
        and p.estado = 'A' and (p.cedula LIKE '$texto%' OR p.nombres LIKE '%$texto%' OR p.apellidos LIKE '%$texto%')";

        $array = $this->conexion->database::select($sql);

        if ($array) {
            $response = [
                'status' => true,
                'mensaje' => 'Existen datos',
                'docente' => $array,
            ];
        } else {
            $response = [
                'status' => false,
                'mensaje' => 'No existen coincidencias',
                'docente' => null,
            ];
        }
        echo json_encode($response);
    }

    public function guardar($docente, $id_persona, $guia)
    {

        if ($docente) {
            $nuevoDocente = new Docente();
            $nuevoDocente->persona_id = $id_persona;
            $nuevoDocente->guia = $guia;
            $nuevoDocente->estado = 'A';
            $nuevoDocente->save();

            return $nuevoDocente;
        } else {
            return null;
        }
    }

    public function eliminar(Request $request){
        
        $data = $request->input('docente');
        $response = [];
        $docente = Docente::find(intval($data->id));
        
        if($docente){
            $docente->estado = 'I';
            $docente->save();

            $response = [
                'status' => true,
                'message' => 'El docente se ha eliminado'
            ];
        }else{
            $response = [
                'status' => false,
                'message' => 'No se puede eliminar !!'
            ];
        }

        echo json_encode($response);
    }
}
