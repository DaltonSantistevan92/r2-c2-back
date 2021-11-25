<?php

require_once 'app/error.php';

class InventarioAccion
{

    public function index($metodo_http, $ruta, $params = null)
    {

        switch ($metodo_http) {
            case 'get':
                if ($ruta == '/inventario/ver' && $params) {
                    Route::get('/inventario/ver/:id_producto', 'inventarioController@ver', $params);
                }else
                if ($ruta == '/inventario/kar' && $params) {
                    Route::get('/inventario/kar/:id_producto/:desde/:hasta', 'inventarioController@kar', $params);
                } 
                break; 
                

            case 'post':
                
                break;

        }
    }
}
