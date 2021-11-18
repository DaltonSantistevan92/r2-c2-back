<?php
require_once 'app/cors.php';
require_once 'app/helper.php';
require_once 'models/ticketModel.php';
require_once 'models/ordenModel.php';

class TicketController
{
    private $cors;
    private $limit_key = 5;

    public function __construct()
    {
        $this->cors = new Cors();
    }

    public function buscar($params){
        $this->cors->corsJson();
        $id = intval($params['id']);
        $response = [];

        $dataTicket = Ticket::find($id);

        if($dataTicket){
            $dataTicket->estudiante->persona;
            $dataTicket->representante->persona;
            $dataTicket->horario_atencion;

            $response = [
                'status' => true,
                'mensaje' => 'Existen datos',
                'ticket' => $dataTicket
            ];
        }else{
            $response = [
                'status' => false,
                'mensaje' => 'No ahi datos',
                'ticket' => null
            ];
        }
        echo json_encode($response);

    }

    public function listar()
    {
        $this->cors->corsJson();
        $response = [];

        $dataTicket = Ticket::where('estado', 'A')->where('status_id',1)->orderBy('id', 'DESC')->get();

        foreach ($dataTicket as $dt) {
            $aux = [
                'ticket' => $dt,
                'estudiante_id' => $dt->estudiante->persona->id,
                'representante_id' => $dt->representante->persona->id,
                'horario_atencion_id' => $dt->horario_atencion->id,
            ];
            $response[] = $aux;
        }
        echo json_encode($response);
    }

    public function listaEntregado()
    {
        $this->cors->corsJson();
        $response = [];

        $dataTicket = Ticket::where('estado', 'A')->where('status_id',2)->orderBy('id', 'DESC')->get();

        foreach ($dataTicket as $dt) {
            $aux = [
                'ticket' => $dt,
                'estudiante_id' => $dt->estudiante->persona->id,
                'representante_id' => $dt->representante->persona->id,
                'horario_atencion_id' => $dt->horario_atencion->id,
            ];
            $response[] = $aux;
        }
        echo json_encode($response);
    }

    public function getOrden()
    {
        $registro = Orden::where('estado', 'A')->orderBy('id', 'DESC')->first();
        $response = [];

        if ($registro == null) {
            $response = [
                'status' => true,
                'mensaje' => 'Primer registro',
                'orden' => '00001',
            ];
        } else {
            $numero = intval($registro->num_orden);
            $siguiente = '0000' . ($numero += 1);
            $response = [
                'status' => true,
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
        $response = [];

        if ($tipoRequest == null) {
            $response = [
                'status' => false,
                'mensaje' => 'no ahi datos',
            ];
        } else {
            $nuevo = new Orden();
            $nuevo->num_orden = $num_orden;
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

    public function guardar(Request $request)
    {
        $this->cors->corsJson();
        $ticketRequest = $request->input('ticket');
        $response = [];

        $helper = new Helper();
        $codigo = $helper->generate_key($this->limit_key);

        if ($ticketRequest) {
            $estudiante_id = intval($ticketRequest->estudiante_id);
            $representante_id = intval($ticketRequest->representante_id);
            $horario_atencion_id = intval($ticketRequest->horario_atencion_id);
            $fecha_entrega = $ticketRequest->fecha_entrega;
            $orden = $ticketRequest->orden;

            $nuevoTicket = new Ticket();
            $nuevoTicket->estudiante_id = $estudiante_id;
            $nuevoTicket->representante_id = $representante_id;
            $nuevoTicket->horario_atencion_id = $horario_atencion_id;
            $nuevoTicket->codigo = $codigo;
            $nuevoTicket->fecha = date('Y-m-d');
            $nuevoTicket->fecha_entrega = $fecha_entrega;
            $nuevoTicket->privilegio = 'N'; 
            $nuevoTicket->orden = $orden;
            $nuevoTicket->status_id = 1; //pendiente
            $nuevoTicket->estado = 'A';

            $existeOrden = Ticket::where('orden', $orden)->get()->first();

            if ($existeOrden) {
                $response = [
                    'status' => false,
                    'mensaje' => 'La Orden del Ticket ya existe',
                    'ticket' => null,
                ];
            } else {
                //busca en la tabla ticket el representante - estudiante si ya tiene asignado un ticket
                $existeRepreEstu = Ticket::where('representante_id', $representante_id)
                    ->where('estudiante_id', $estudiante_id)->get()->first();

                if ($existeRepreEstu) {
                    $response = [
                        'status' => false,
                        'mensaje' => 'El representante y el estudiante ya tienen asignado un ticket',
                        'ticket' => null,
                    ];
                } else {
                    $nuevoTicket->save();
                    $response = [
                        'status' => true,
                        'mensaje' => 'El nuevo Ticket se ha generado correctamente',
                        'ticket' => $nuevoTicket,
                    ];
                }
            }
        } else {
            $response = [
                'status' => false,
                'mensaje' => 'No ahi datos',
            ];
        }
        echo json_encode($response);
    }

    public function actualizarTicket($params){
        $this->cors->corsJson();
        $id_ticket = intval($params['id_ticket']);
        $status_id = intval($params['status_id']);
        $mensajes = '';       $response = [];

        $ticket = Ticket::find($id_ticket);

        if($ticket){
            $ticket->status_id = $status_id;
            $ticket->save();

            switch ($status_id) {            
                case 2:
                    $mensajes = 'El ticket se ha entregado'; break;
            }

            $response = [
                'status' => true,
                'mensaje' => $mensajes,
            ];
        }else {
            $response = [
                'status' => false,
                'mensaje' => 'No se puede actualizar el ticket',
            ];
        }
        echo json_encode($response);





    }



}
