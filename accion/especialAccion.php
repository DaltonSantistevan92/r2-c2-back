<?php

require_once 'app/error.php';

class EspecialAccion
{

    public function index($metodo_http, $ruta, $params = null)
    {

        switch ($metodo_http) {
            case 'get':
                if ($ruta == '/especial/listar' && $params) {
                    Route::get('/especial/listar/:id', 'especialController@listar',$params);
                } else
                if ($ruta == '/especial/listar') {
                    Route::get('/especial/listar', 'especialController@getEspecial');
                }
                
                break;

            /* case 'post':
                if ($ruta == '/parentesco/guardar') {
                    Route::post('/parentesco/guardar', 'parentescoController@guardar');
                }else 
                if ($ruta == '/parentesco/eliminar') {
                    Route::post('/parentesco/eliminar', 'parentescoController@eliminar');
                }else 
                if ($ruta == '/parentesco/editar') {
                    Route::post('/parentesco/editar', 'parentescoController@editar');
                }
                else {
                    ErrorClass::e(404, "La ruta no existe");
                }
                break; */
  
        }
    }
}
