<?php

require_once 'app/error.php';

class ParaleloAccion{

    public function __construct(){ }

    public function index($metodo_http, $ruta, $params = null){

        switch ($metodo_http) {
            case 'get':
                if($ruta == '/paralelo/listar' && $params) {
                    Route::get('/paralelo/listar/:id', 'paraleloController@buscar',$params);
                }else
                if($ruta == '/paralelo/listar'){
                    Route::get('/paralelo/listar', 'paraleloController@listar');
                }
                break;

            case 'post':
                if ($ruta == '/paralelo/guardar') {
                    Route::post('/paralelo/guardar', 'paraleloController@guardar');
                }else
                if ($ruta == '/paralelo/editar') {
                    Route::post('/paralelo/editar', 'paraleloController@editar');
                }else
                if ($ruta == '/paralelo/eliminar') {
                    Route::post('/paralelo/eliminar', 'paraleloController@eliminar');
                }
                break;
        }
    }
}
