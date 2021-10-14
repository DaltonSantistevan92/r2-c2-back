<?php

require_once 'app/error.php';

class ParentescoAccion
{

    public function index($metodo_http, $ruta, $params = null)
    {

        switch ($metodo_http) {
            case 'get':
                if ($ruta == '/parentesco/listar' && $params) {
                    Route::get('/parentesco/listar/:id', 'parentescoController@listar',$params);
                } else
                if ($ruta == '/parentesco/listar') {
                    Route::get('/parentesco/listar', 'parentescoController@getParentesco');
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
