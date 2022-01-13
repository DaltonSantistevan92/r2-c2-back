<?php

require_once 'app/error.php';

class DiaAccion{

    public function __construct(){ }

    public function index($metodo_http, $ruta, $params = null){

        switch ($metodo_http) {
            case 'get':
                if($ruta == '/dia/listar') {
                    Route::get('/dia/listar', 'diaController@listar');
                }     
                break;

           
        }
    }
}
