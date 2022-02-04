<?php

require_once 'app/error.php';

class RepresentanteAccion
{

    public function __construct() {}

    //Configurar rutas y controllers
    public function index($metodo_http, $ruta, $params = null)
    {

        switch ($metodo_http) {
            case 'get':
                if ($ruta == '/representante/listar' && $params) {
                    Route::get('/representante/listar/:id', 'representanteController@buscar',$params);
                }else 
                if ($ruta == '/representante/listar') {
                    Route::get('/representante/listar', 'representanteController@listar');
                } else
                if ($ruta == '/representante/datatable') {
                    Route::get('/representante/datatable', 'representanteController@dataTable');
                } else
                if ($ruta == '/representante/buscarRepresentante' && $params) {
                    Route::get('/representante/buscarRepresentante/:texto', 'representanteController@buscarRepresentante', $params);
                }else {
                    ErrorClass::e(404, "La ruta no existe");
                }
                break;

            case 'post': 
                if($ruta == '/representante/editar'){
                    Route::post('/representante/editar', 'representanteController@editar');
                }else 
                if($ruta == '/representante/eliminar'){
                    Route::post('/representante/eliminar', 'representanteController@eliminar');
                } else {
                    ErrorClass::e(404, "La ruta no existe");
                }
                break;

        }
    }
}
