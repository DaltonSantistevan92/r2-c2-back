<?php

require_once 'app/error.php';

class Detalle_BaseAccion{

    public function __construct(){ }

    public function index($metodo_http, $ruta, $params = null){

        switch ($metodo_http) {
            case 'get':
                if($ruta == '/detalle_base/horario' && $params){
                    Route::get('/detalle_base/horario/:periodo_id/:grado_id/:paralelo_id', 'detalle_baseController@getByPeriodoGradoParalelo', $params);
                }else     
                if($ruta == '/detalle_base/listar' && $params) {
                    Route::get('/detalle_base/listar/:base_id/:hora_id', 'detalle_baseController@listar',$params);
                }else
                if($ruta == '/detalle_base/filter_hora' && $params){
                    Route::get('/detalle_base/filter_hora/:base_id/:hora_id', 'detalle_baseController@getByHoras', $params);
                }else
                if($ruta == '/detalle_base/hora' && $params){
                    Route::get('/detalle_base/hora/:base_id', 'detalle_baseController@getHoras', $params);
                }else
                if($ruta == '/detalle_base/horario_get' && $params){
                    Route::get('/detalle_base/horario_get/:horario_id', 'detalle_baseController@getHorario', $params);
                }
                break;

            case 'post':
                if ($ruta == '/detalle_base/guardar') {
                    Route::post('/detalle_base/guardar', 'detalle_baseController@guardar');
                }else
                if($ruta == '/detalle_base/update_asignacion'){
                    Route::post('/detalle_base/update_asignacion', 'detalle_baseController@updateDetalleBase');
                }
                break; 
        }
    }
}   
