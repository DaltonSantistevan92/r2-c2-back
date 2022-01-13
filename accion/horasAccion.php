<?php

require_once 'app/error.php';

class HorasAccion{

    public function __construct(){ }

    public function index($metodo_http, $ruta, $params = null){

        switch ($metodo_http) {
            case 'get':
                if($ruta == '/horas/listar') {
                    Route::get('/horas/listar', 'horasController@listar');
                }     
                break;

            case 'post':
                if ($ruta == '/horas/guardarHora') {
                    Route::post('/horas/guardarHora', 'horasController@guardarHora');
                }
                break;
        }
    }
}
