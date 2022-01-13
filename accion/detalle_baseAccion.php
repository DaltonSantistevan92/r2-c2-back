<?php

require_once 'app/error.php';

class Detalle_BaseAccion{

    public function __construct(){ }

    public function index($metodo_http, $ruta, $params = null){

        switch ($metodo_http) {
            case 'get':
                if($ruta == '/detalle_base/listar' && $params) {
                    Route::get('/detalle_base/listar/:base_id/:hora_id', 'detalle_baseController@listar',$params);
                }     
                break;

            case 'post':
                if ($ruta == '/detalle_base/guardar') {
                    Route::post('/detalle_base/guardar', 'detalle_baseController@guardar');
                }
                break; 
        }
    }
}
