<?php

require_once 'app/error.php';

class TicketAccion{

    public function __construct(){ }

    public function index($metodo_http, $ruta, $params = null){

        switch ($metodo_http) {
            case 'get':
                if($ruta == '/ticket/listar' && $params) {
                    Route::get('/ticket/listar/:id', 'ticketController@buscar',$params);
                }else
                if($ruta == '/ticket/listaEntregado' && $params) { 
                    Route::get('/ticket/listaEntregado/:user_id', 'ticketController@listaEntregado', $params);
                }else
                if($ruta == '/ticket/mios' && $params){
                    Route::get('/ticket/mios/:user_id', 'ticketController@listar', $params);
                }else
                if($ruta == '/ticket/getOrden' && $params){
                    Route::get('/ticket/getOrden/:tipo', 'ticketController@getOrden',$params);
                }else
                if($ruta == '/ticket/actualizarTicket' && $params) {
                    Route::get('/ticket/actualizarTicket/:id_ticket/:status_id', 'ticketController@actualizarTicket',$params);
                }else
                if($ruta == '/ticket/ticketMasAtendidas' && $params) {
                    Route::get('/ticket/ticketMasAtendidas/:inicio/:fin/:representante_id', 'ticketController@ticketMasAtendidas',$params);
                }
                break;
            
            case 'post':
                if($ruta == '/ticket/guardar'){
                    Route::post('/ticket/guardar', 'ticketController@guardar');
                }else
                if($ruta == '/ticket/aumentarOrden'){
                    Route::post('/ticket/aumentarOrden', 'ticketController@aumentarOrden');
                }
                break;
        }
    }
}
