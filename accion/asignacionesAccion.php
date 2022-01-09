<?php

require_once 'app/error.php';

class AsignacionesAccion{

    public function __construct(){ }

    public function index($metodo_http, $ruta, $params = null){

        switch ($metodo_http) {
            case 'get':
                if($ruta == '/asignaciones/listar' && $params) {
                    Route::get('/asignaciones/listar/:id', 'asignacionesController@buscar',$params);
                }else
                if($ruta == '/asignaciones/listar'){
                    Route::get('/asignaciones/listar', 'asignacionesController@listar');
                }else
                if($ruta == '/asignaciones/datatable' && $params){
                    Route::get('/asignaciones/datatable/:id_grado/:id_paralelo', 'asignacionesController@datatable',$params);
                }     
                break;

            case 'post':
                if ($ruta == '/asignaciones/guardar') {
                    Route::post('/asignaciones/guardar', 'asignacionesController@guardar');
                }/* else
                if($ruta == '/asignaciones/aumentarOrden'){
                    Route::post('/asignaciones/aumentarOrden', 'asignacionesController@aumentarOrden');
                } */
                break;
        }
    }
}
