<?php

require_once 'app/error.php';

class DocenteCursoAccion
{

    public function __construct()
    {
        
    }

    //Configurar rutas y controllers
    public function index($metodo_http, $ruta, $params = null)
    {

        switch ($metodo_http) {
            case 'get':
                if ($ruta == '/docentecurso/listar' && $params) {
                    Route::get('/docentecurso/listar/:id', 'docentecursoController@buscar', $params);
                }else
                if ($ruta == '/docentecurso/datatable') {
                    Route::get('/docentecurso/datatable', 'docentecursoController@dataTable');
                }else {
                    ErrorClass::e(404, "La ruta no existe");
                }
                break;

            case 'post': 
                if($ruta == '/docentecurso/editar'){
                    Route::post('/docentecurso/editar', 'docentecursoController@editar');
                }else 
                if($ruta == '/docentecurso/eliminar'){
                    Route::post('/docentecurso/eliminar', 'docentecursoController@eliminar');
                } else {
                    ErrorClass::e(404, "La ruta no existe");
                }
                break;

        }
    }
}
