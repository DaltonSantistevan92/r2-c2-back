<?php

require_once 'app/cors.php';
require_once 'app/request.php';
require_once 'core/conexion.php';
require_once 'models/entregasModel.php';
require_once 'models/ordenModel.php';
require_once 'models/ticketModel.php';
require_once 'models/movimientoModel.php';
require_once 'controllers/inventarioController.php';
require_once 'controllers/detalleEntregaController.php';

class EntregaController
{
    private $cors;
    private $conexion;

    public function __construct()
    {
        $this->cors = new Cors();
        $this->conexion = new Conexion();        
    }

    public function buscarxCodigo($params)  
    {
        $this->cors->corsJson();
        $texto = strtolower($params['texto']);
        $response = [];

        $sql = "SELECT t.id,t.codigo,t.orden,t.fecha_entrega,
        (p.nombres) as NomRepresentante, (p.apellidos) as ApeRepresentante,
        (pe.nombres) as NomEstudiante, (pe.apellidos) as ApeEstudiante FROM tickets t
        INNER JOIN representantes r ON r.id = t.representante_id
        INNER JOIN estudiantes e ON e.id = t.estudiante_id
        INNER JOIN personas p ON p.id = r.persona_id 
        INNER join personas pe ON pe.id = e.persona_id
        where t.estado = 'A' and t.status_id = 2 and (t.codigo like '%$texto%');";

        $array = $this->conexion->database::select($sql);

        if ($array) {
            $response = [
                'status' => true,
                'mensaje' => 'Existen datos',
                'ticket' => $array,
            ];
        } else {
            $response = [
                'status' => false,
                'mensaje' => 'No existen coincidencias',
                'ticket' => null,
            ];
        }
        echo json_encode($response);

       
    }

    public function getOrden($params)
    {
        $tipo = $params['tipo'];
        $registro = Orden::where('tipo',$tipo)->orderBy('id', 'DESC')->first();
        $response = [];

        if ($registro == null) {
            $response = [
                'status' => true,
                'tipo' => $tipo,
                'mensaje' => 'Primer registro',
                'orden' => '00001',
            ];
        } else {
            $numero = intval($registro->num_orden);
            $siguiente = '0000' . ($numero += 1);
            $response = [
                'status' => true,
                'tipo' => $tipo,
                'mensaje' => 'Aumentando registro',
                'orden' => $siguiente,
            ];
        }
        echo json_encode($response);
    }

    public function aumentarOrden(Request $request)
    {
        $this->cors->corsJson();
        $tipoRequest = $request->input('orden');
        $num_orden = $tipoRequest->num_orden;
        $tipo = $tipoRequest->tipo;
        $response = [];

        if ($tipoRequest == null) {
            $response = [
                'status' => false,
                'mensaje' => 'no ahi datos',
            ];
        } else {
            $nuevo = new Orden();
            $nuevo->num_orden = $num_orden;
            $nuevo->tipo = $tipo;
            $nuevo->estado = 'A';
            $nuevo->save();

            $response = [
                'status' => true,
                'mensaje' => 'Guardando datos',
                'orden' => $nuevo,
            ];
        }
        echo json_encode($response);
    }

    public function guardar(Request $request){
        $this->cors->corsJson();
        $entregaRequest = $request->input('entrega');
        $detalleentregaRequest = $request->input('detalle_entrega');
        $response = []; 

        if($entregaRequest){
            $ticket_id = intval($entregaRequest->ticket_id);
            $usuario_id = intval($entregaRequest->usuario_id);
            $codigo = $entregaRequest->codigo;

            $nuevoentrega = new Entrega();
            $nuevoentrega->ticket_id = $ticket_id;
            $nuevoentrega->usuario_id = $usuario_id;
            $nuevoentrega->fecha = date('Y-m-d');
            $nuevoentrega->hora = date('H:i:s');
            $nuevoentrega->codigo = $codigo;

            $existe = Entrega::where('codigo',$codigo)->get()->first();
            if($existe){
                $response = [
                    'status' => false,
                    'mensaje' => 'El codigo ya existe',
                    'entrega' => null,
                    'detalle_entrega' => null
                ];
            }else{
                if($nuevoentrega->save()){

                    //actualiza el privilegio del ticker a S
                    $objtoTicket = Ticket::find($ticket_id);
                    $objtoTicket->privilegio = 'S';
                    $objtoTicket->save();

                    //guarda a detalle entrega
                    $detalleEntregaController = new DetalleEntregaController();
                    $extra = $detalleEntregaController->guardar($nuevoentrega->id,$detalleentregaRequest);

                    //Inserta en Movimiento
                    $nuevoMovimiento = $this->nuevoMovimiento($nuevoentrega);

                    //actualiza el inventario
                    $inventarioController = new InventarioController; 
                    $responseInventario = $inventarioController->guardarIngresoProducto($nuevoMovimiento->id, $detalleentregaRequest, 'S');


                    $response = [
                        'status' => true,
                        'mensaje' => 'Guardando los datos',
                        'entrega' => $nuevoentrega,
                        'detalle_entrega' => $extra,
                        'movimiento' => $nuevoMovimiento,
                        'inventario' => $responseInventario
                    ];
                }else{
                    $response = [
                        'status' => false,
                        'mensaje' => 'No se puede guardar',
                        'entrega' => null,
                        'detalle_entrega' => null,
                        'movimiento' => null,
                        'inventario' => null
                    ];
                }
            }
        }else{
            $response = [
                'status' => false,
                'mensaje' => 'No ahi datos',
                'entrega' => null,
                'detalle_entrega' => null,
                'movimiento' => null,
                'inventario' => null
            ];
        }
        echo json_encode($response);
    }

  protected function nuevoMovimiento($nuevo){
        $nuevoMovimiento = new Movimiento();

        $nuevoMovimiento->entrega_id = $nuevo->id;
        $nuevoMovimiento->usuario_id = $nuevo->usuario_id;
        $nuevoMovimiento->tipo = 'S';
        $nuevoMovimiento->fecha = date('Y-m-d');
        $nuevoMovimiento->save();

        return $nuevoMovimiento;
    }

    




}