<?php

require_once 'app/error.php';

class CursoAccion{

    public function __construct(){ }

    public function index($metodo_http, $ruta, $params = null){

        switch ($metodo_http) {
            case 'get':
                if($ruta == '/curso/listar' && $params) {
                    Route::get('/curso/listar/:id', 'cursoController@buscar',$params);
                }else
                if($ruta == '/curso/listar'){
                    Route::get('/curso/listar', 'cursoController@listar');
                }
                break;

            case 'post':
               
                break;
        }
    }
}
