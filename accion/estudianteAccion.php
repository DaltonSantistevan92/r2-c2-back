<?php

require_once 'app/error.php';

class EstudianteAccion{

    public function __construct(){ }

    public function index($metodo_http, $ruta, $params = null){

        switch ($metodo_http) {
            case 'get':
                if($ruta == '/estudiante/listar' && $params) {
                    Route::get('/estudiante/listar/:id', 'estudianteController@buscar',$params);
                }else 
                if ($ruta == '/estudiante/listar') {
                    Route::get('/estudiante/listar', 'estudianteController@listar');
                }else 
                if ($ruta == '/estudiante/buscarEstudiante' && $params) {
                    Route::get('/estudiante/buscarEstudiante/:texto', 'estudianteController@buscarEstudiante', $params);
                }else
                if($ruta == '/estudiante/datatable'){
                    Route::get('/estudiante/datatable', 'estudianteController@datatable');
                }
                break;

            case 'post':
                if($ruta == '/estudiante/guardar') {
                    Route::post('/estudiante/guardar', 'estudianteController@guardar');
                }else
                if($ruta == '/estudiante/editar') {
                    Route::post('/estudiante/editar', 'estudianteController@editar');
                }else
                if($ruta == '/estudiante/eliminar') {
                    Route::post('/estudiante/eliminar', 'estudianteController@eliminar');
                }
                break;
        }
    }
}
