<?php

require_once 'app/error.php';

class DocenteAccion{

    public function __construct(){ }

    public function index($metodo_http, $ruta, $params = null){

        switch ($metodo_http) {
            case 'get':
                if($ruta == '/docente/buscarDocente' && $params){
                    Route::get('/docente/buscarDocente/:texto', 'docenteController@buscarDocente', $params);
                }else
                if($ruta == '/docente/listar'){
                    Route::get('/docente/listar', 'docenteController@listar');
                }
                break;

            

        }
    }
}
