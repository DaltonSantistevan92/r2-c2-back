<?php

require_once 'app/error.php';

class AbastecerAccion{

    public function __construct(){ }

    public function index($metodo_http, $ruta, $params = null){

        switch ($metodo_http) {
            case 'get':
                if($ruta == '/abastecer/listar' && $params) {
                    Route::get('/abastecer/listar/:id', 'abastecerController@buscar',$params);
                }else
                if($ruta == '/abastecer/listar'){
                    Route::get('/abastecer/listar', 'abastecerController@listar');
                }else
                if($ruta == '/abastecer/getOrden' && $params){
                    Route::get('/abastecer/getOrden/:tipo', 'abastecerController@getOrden',$params); 
                }        
                break;

            case 'post':
                if ($ruta == '/abastecer/guardar') {
                    Route::post('/abastecer/guardar', 'abastecerController@guardar');
                }else
                if($ruta == '/abastecer/aumentarOrden'){
                    Route::post('/abastecer/aumentarOrden', 'abastecerController@aumentarOrden');
                }
                break;
        }
    }
}
