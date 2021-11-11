<?php

require_once 'app/error.php';

class PeriodoAccion{

    public function __construct(){ }

    public function index($metodo_http, $ruta, $params = null){

        switch ($metodo_http) {
            case 'get':
                if($ruta == '/periodo/listar' && $params) {
                    Route::get('/periodo/listar/:id', 'periodoController@buscar',$params);
                }else
                if($ruta == '/periodo/listar'){
                    Route::get('/periodo/listar', 'periodoController@listar');
                }/* else
                if($ruta == '/periodo/last'){
                    Route::get('/periodo/last', 'periodoController@last');
                } */
                break;

            case 'post':
                if ($ruta == '/periodo/guardar') {
                    Route::post('/periodo/guardar', 'periodoController@guardar');
                }else
                if ($ruta == '/periodo/definir'){
                    Route::post('/periodo/definir', 'periodoController@definir');
                }
                else
                if ($ruta == '/periodo/eliminar'){
                    Route::post('/periodo/eliminar', 'periodoController@eliminar');
                }
                break;
        }
    }
}
