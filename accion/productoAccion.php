<?php

require_once 'app/error.php';

class ProductoAccion{

    public function __construct(){ }

    public function index($metodo_http, $ruta, $params = null){

        switch ($metodo_http) {
            case 'get':
                if($ruta == '/producto/listar' && $params) {
                    Route::get('/producto/listar/:id', 'productoController@buscar',$params);
                }else
                if($ruta == '/producto/listar'){
                    Route::get('/producto/listar', 'productoController@listar');
                }else
                if($ruta == '/producto/datatable'){
                    Route::get('/producto/datatable', 'productoController@datatable');
                }
                break;

            case 'post':
                if ($ruta == '/producto/guardar') {
                    Route::post('/producto/guardar', 'productoController@guardar');
                }else
                if ($ruta == '/producto/editar'){
                    Route::post('/producto/editar', 'productoController@editar');
                }
                else
                if ($ruta == '/producto/eliminar'){
                    Route::post('/producto/eliminar', 'productoController@eliminar');
                }
                break;
        }
    }
}
