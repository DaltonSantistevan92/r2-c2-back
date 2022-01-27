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
                if($ruta == '/producto/dataTableInsumo'){
                    Route::get('/producto/dataTableInsumo', 'productoController@dataTableInsumo');
                }else
                if($ruta == '/producto/dataTableLibro'){
                    Route::get('/producto/dataTableLibro', 'productoController@dataTableLibro');
                }else
                if($ruta == '/producto/buscarProducto' && $params){
                    Route::get('/producto/buscarProducto/:texto', 'productoController@buscarProducto',$params);
                }else
                if($ruta == '/producto/caducarse' && $params){
                    Route::get('/producto/caducarse/:categoria_id/:year/:month', 'productoController@caducarse',$params);
                }
                break;

            case 'post':
                if ($ruta == '/producto/guardar') {
                    Route::post('/producto/guardar', 'productoController@guardar');
                }else
                if ($ruta == '/producto/subir') {
                    Route::post('/producto/subir', 'productoController@subirFicheroImagen',true);
                }else
                if ($ruta == '/producto/editar'){
                    Route::post('/producto/editar', 'productoController@editar');
                }else
                if ($ruta == '/producto/eliminar'){
                    Route::post('/producto/eliminar', 'productoController@eliminar');
                }
                break;
        }
    }
}
