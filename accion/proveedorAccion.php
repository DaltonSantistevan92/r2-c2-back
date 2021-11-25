<?php

require_once 'app/error.php';

class ProveedorAccion{

    public function __construct(){ }

    public function index($metodo_http, $ruta, $params = null){

        switch ($metodo_http) {
            case 'get':
                if($ruta == '/proveedor/listar'){
                    Route::get('/proveedor/listar', 'proveedorController@listar');
                }
                break;

            

        }
    }
}
