<?php

require_once 'app/error.php';

class RolAccion
{

    public function index($metodo_http, $ruta, $params = null)
    {

        switch ($metodo_http) {
            case 'get':
                if ($ruta == '/rol/listar' && $params) {
                    Route::get('/rol/listar/:id', 'rolController@listar',$params);
                } else
                if ($ruta == '/rol/listar') {
                    Route::get('/rol/listar', 'rolController@getRoles');
                }
                
                break;

            case 'post':
                if ($ruta == '/rol/guardar') {
                    Route::post('/rol/guardar', 'rolController@guardar');
                }else 
                if ($ruta == '/rol/eliminar') {
                    Route::post('/rol/eliminar', 'rolController@eliminar');
                }else 
                if ($ruta == '/rol/editar') {
                    Route::post('/rol/editar', 'rolController@editar');
                }
                else {
                    ErrorClass::e(404, "La ruta no existe");
                }
                break;
  
        }
    }
}
