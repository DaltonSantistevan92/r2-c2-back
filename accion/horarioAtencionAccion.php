<?php

require_once 'app/error.php';

class HorarioAtencionAccion{

    public function __construct(){ }

    public function index($metodo_http, $ruta, $params = null){

        switch ($metodo_http) {
            case 'get':
                if($ruta == '/horarioAtencion/listar'){
                    Route::get('/horarioAtencion/listar', 'horarioAtencionController@listar');
                }
                break;

            

        }
    }
}
