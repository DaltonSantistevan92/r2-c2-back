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

            

        }
    }
}
