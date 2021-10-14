<?php

require_once 'app/error.php';

class UsuarioAccion
{

    public function __construct()
    {
        //echo "Soy la clase accionUsuario<br>";
    }

    //Configurar rutas y controllers
    public function index($metodo_http, $ruta, $params = null)
    {

        switch ($metodo_http) {
            case 'get':
                if ($ruta == '/usuario/listar' && $params) {
                    Route::get('/usuario/listar/:id', 'usuarioController@buscar',$params);
                } else
                if ($ruta == '/usuario/representante') {
                    Route::get('/usuario/representante', 'usuarioController@getRepresentante');
                } else
                if ($ruta == '/usuario/datatable') {
                    Route::get('/usuario/datatable', 'usuarioController@dataTable');
                }
                 else {
                    //$error = new Error();
                    ErrorClass::e(404, "La ruta no existe");
                }
                break;

            case 'post':
                if ($ruta == '/usuario/login') {
                    Route::post('/usuario/login', 'usuarioController@login');
                } else
                if ($ruta == '/usuario/guardar') {
                    Route::post('/usuario/guardar', 'usuarioController@guardar');
                } else
                if ($ruta == '/usuario/fichero') {
                    Route::post('/usuario/fichero', 'usuarioController@subirFichero', true);
                }else 
                if($ruta == '/usuario/editar'){
                    Route::post('/usuario/editar', 'usuarioController@editar');
                }else 
                if($ruta == '/usuario/eliminar'){
                    Route::post('/usuario/eliminar', 'usuarioController@eliminar');
                } else {
                    ErrorClass::e(404, "La ruta no existe");
                }
                break;

        }
    }
}
