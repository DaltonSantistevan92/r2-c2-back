<?php

require_once 'app/error.php';

class MateriasAccion{

    public function __construct(){ }

    public function index($metodo_http, $ruta, $params = null){

        switch ($metodo_http) {
            case 'get':
                if($ruta == '/materias/listar' && $params) {
                    Route::get('/materias/listar/:id_area', 'materiasController@listar',$params);
                }else
                if($ruta == '/materias/datatable'){
                    Route::get('/materias/datatable', 'materiasController@datatable');
                }     
                break;

            case 'post':
                if ($ruta == '/materias/guardar') {
                    Route::post('/materias/guardar', 'materiasController@guardar');
                }elseif ($ruta == '/materias/eliminar') {
                    Route::post('/materias/eliminar', 'materiasController@eliminar');
                }
                break; 
        }
    }
}
