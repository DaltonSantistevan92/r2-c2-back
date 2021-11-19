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
                if($ruta == '/ticket/listaEntregado') { 
                    Route::get('/ticket/listaEntregado', 'ticketController@listaEntregado');
                }else
                if($ruta == '/ticket/listar'){
                    Route::get('/ticket/listar', 'ticketController@listar');
                }else
                if($ruta == '/ticket/getOrden' && $params){
                    Route::get('/ticket/getOrden/:tipo', 'ticketController@getOrden',$params);
                }else
                if($ruta == '/ticket/actualizarTicket' && $params) {
                    Route::get('/ticket/actualizarTicket/:id_ticket/:status_id', 'ticketController@actualizarTicket',$params);
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
