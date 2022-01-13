<?php

require_once 'app/error.php';

class GradosAccion{

    public function __construct(){ }

    public function index($metodo_http, $ruta, $params = null){

        switch ($metodo_http) {
            case 'get':
                if($ruta == '/grados/listar' && $params){
                    Route::get('/grados/listar/:id', 'gradosController@buscarid',$params);
                }else
                if($ruta == '/grados/listar'){
                    Route::get('/grados/listar', 'gradosController@listar');
                }
            break;

            case 'post':
                if($ruta == '/grados/guardar'){
                    Route::post('/grados/guardar', 'gradosController@guardar');
                }else
                if($ruta == '/grados/editar'){
                    Route::post('/grados/editar', 'gradosController@editar');
                }else
                if($ruta == '/grados/eliminar'){
                    Route::post('/grados/eliminar', 'gradosController@eliminar');
                }
            break;

            

        }
    }
}