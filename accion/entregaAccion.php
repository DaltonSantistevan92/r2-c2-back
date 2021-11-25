<?php

require_once 'app/error.php';

class EntregaAccion{

    public function __construct(){ }

    public function index($metodo_http, $ruta, $params = null){

        switch ($metodo_http) {
            case 'get':
                if($ruta == '/entrega/listar' && $params) {
                    Route::get('/entrega/listar/:id', 'entregaController@buscar',$params);
                }else
                if($ruta == '/entrega/listar'){
                    Route::get('/entrega/listar', 'entregaController@listar');
                }else
                if($ruta == '/entrega/buscarxCodigo' && $params){
                    Route::get('/entrega/buscarxCodigo/:texto', 'entregaController@buscarxCodigo',$params);
                }else
                if($ruta == '/entrega/getOrden' && $params){
                    Route::get('/entrega/getOrden/:tipo', 'entregaController@getOrden',$params); 
                }     
                break;

            case 'post':
                if ($ruta == '/entrega/guardar') {
                    Route::post('/entrega/guardar', 'entregaController@guardar');
                }else
                if($ruta == '/entrega/aumentarOrden'){
                    Route::post('/entrega/aumentarOrden', 'entregaController@aumentarOrden');
                }
                break;
        }
    }
}
