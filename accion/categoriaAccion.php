<?php

require_once 'app/error.php';

class CategoriaAccion{

    public function __construct(){ }

    public function index($metodo_http, $ruta, $params = null){

        switch ($metodo_http) {
            case 'get':
                /* if($ruta == '/categoria/listar' && $params) {
                    Route::get('/categoria/listar/:id', 'categoriaController@buscar',$params);
                }else */
                if($ruta == '/categoria/listar'){
                    Route::get('/categoria/listar', 'categoriaController@listar');
                }
                break;

            

        }
    }
}
