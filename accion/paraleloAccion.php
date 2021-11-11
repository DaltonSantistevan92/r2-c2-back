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
               /*  if ($ruta == '/periodo/guardar') {
                    Route::post('/periodo/guardar', 'periodoController@guardar');
                }else
                if ($ruta == '/periodo/definir'){
                    Route::post('/periodo/definir', 'periodoController@definir');
                }
                else
                if ($ruta == '/periodo/eliminar'){
                    Route::post('/periodo/eliminar', 'periodoController@eliminar');
                } */
                break;
        }
    }
}
