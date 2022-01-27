<?php

require_once 'app/error.php';

class CategoriaAccion{

    public function __construct(){ }

    public function index($metodo_http, $ruta, $params = null){

        switch ($metodo_http) {
            case 'get':
                if($ruta == '/categoria/listar'){
                    Route::get('/categoria/listar', 'categoriaController@listar');
                }else
                if ($ruta == '/categoria/buscarCategoriaProducto' && $params) {
                    Route::get('/categoria/buscarCategoriaProducto/:id', 'categoriaController@buscarCategoriaProducto', $params);
                } else
                if ($ruta == '/categoria/listarViatico') {
                    Route::get('/categoria/listarViatico', 'categoriaController@listarViatico');
                }   
                break;

            

        }
    }
}
