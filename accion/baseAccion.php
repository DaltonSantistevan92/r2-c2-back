<?php

require_once 'app/error.php';

class BaseAccion{

    public function __construct(){ }

    public function index($metodo_http, $ruta, $params = null){

        switch ($metodo_http) {
            case 'get':
                if($ruta == '/base/get' && $params){
                    Route::get('/base/get/:id', 'baseController@find' ,$params);
                }else       
                if($ruta == '/base/listar') {
                    Route::get('/base/listar', 'baseController@listar');
                }
                break;

            case 'post':
                if ($ruta == '/base/guardar') {
                    Route::post('/base/guardar', 'baseController@guardar');
                }
                break; 
        }
    }
}
