<?php

require_once 'app/error.php';

class HorarioAccion{

    public function __construct(){ }

    public function index($metodo_http, $ruta, $params = null){

        switch ($metodo_http) {
            case 'get':
                if($ruta == '/horario/listar' && $params) {
                    Route::get('/horario/listar/:id', 'horarioController@buscar',$params);
                }else
                if($ruta == '/horario/listar'){
                    Route::get('/horario/listar', 'horarioController@listar');
                }else
                if($ruta == '/horario/datatable' && $params){
                    Route::get('/horario/datatable/:id_periodo', 'horarioController@datatable' ,$params);
                }else
                if($ruta == '/horario/info' && $params){
                    Route::get('/horario/info/:id_periodo', 'horarioController@getByHorario' ,$params);
                }   
                break;

            case 'post':
                if ($ruta == '/horario/guardar') {
                    Route::post('/horario/guardar', 'horarioController@guardar');
                }else 
                if ($ruta == '/horario/eliminar') {
                    Route::post('/horario/eliminar', 'horarioController@eliminar');
                }
                break;
        }
    }
}
