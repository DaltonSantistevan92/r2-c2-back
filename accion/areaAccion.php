<?php

require_once 'app/error.php';

class AreaAccion{

    public function __construct(){ }

    public function index($metodo_http, $ruta, $params = null){

        switch ($metodo_http) {
            case 'get':
                if($ruta == '/area/listar'){
                    Route::get('/area/listar', 'areaController@listar');
                }
                break;

            case 'post':
                if($ruta == '/area/guardar'){
                    Route::post('/area/guardar', 'areaController@guardar');
                }else
                if($ruta == '/area/delete'){
                    Route::post('/area/delete', 'areaController@delete');
                }
                break;
        }
    }
}
