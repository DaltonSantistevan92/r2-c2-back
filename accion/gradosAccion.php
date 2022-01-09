<?php

require_once 'app/error.php';

class GradosAccion{

    public function __construct(){ }

    public function index($metodo_http, $ruta, $params = null){

        switch ($metodo_http) {
            case 'get':
                if($ruta == '/grados/listar'){
                    Route::get('/grados/listar', 'gradosController@listar');
                }
                break;

            

        }
    }
}