<?php

require_once 'app/error.php';

class MateriasAccion{

    public function __construct(){ }

    public function index($metodo_http, $ruta, $params = null){

        switch ($metodo_http) {
            case 'get':
                if($ruta == '/materias/listar' && $params) {
                    Route::get('/materias/listar/:id', 'materiasController@buscar',$params);
                }else
                if($ruta == '/materias/listar'){
                    Route::get('/materias/listar', 'materiasController@listar');
                }     
                break;

            case 'post':
                if ($ruta == '/materias/guardar') {
                    Route::post('/materias/guardar', 'materiasController@guardar');
                }
                break;
        }
    }
}
