<?php

require_once 'app/cors.php';
require_once 'app/request.php';
require_once 'core/conexion.php';
require_once 'app/error.php';
require_once 'app/helper.php';
require_once 'models/productoModel.php';



class ProductoController
{

    private $cors;
    private $conexion;


    public function __construct()
    {
        $this->cors = new Cors();
        $this->conexion = new Conexion();
    }

    public function listar()
    {
        $this->cors->corsJson();
        $dataProducto = Producto::where('estado','A')->get();
        $response = [];

        foreach($dataProducto as $item){
            $item->categoria;
        }

        if($dataProducto){
            $response = [
                'status' => true,
                'mensaje' => 'Existen datos',
                'producto' => $dataProducto
            ];
        }else{
            $response = [
                'status' => false,
                'mensaje' => 'No existen datos',
                'producto' => null
            ];
        }
        echo json_encode($response);
    }

    public function buscar($params)
    {
        $this->cors->corsJson();
        $id = intval($params['id']);
        $producto = Producto::find($id);
        $response = [];

        if ($producto) {
            $producto->categoria;

            $response = [
                'status' => true,
                'producto' => $producto,
            ];
        } else {
            $response = [
                'status' => false,
                'mensaje' => 'No se encuentra el producto',
                'producto' => null,
            ];
        }
        echo json_encode($response);
    }

    public function guardar(Request $request)
    {
        $this->cors->corsJson();
        $productoRequest = $request->input('producto');
        $categoria_id = intval($productoRequest->categoria_id);
        $nombre = ucfirst($productoRequest->nombre);
        $peso = $productoRequest->peso;
        $descripcion = ucfirst($productoRequest->descripcion);
        $img = $productoRequest->img;
        $fecha_caducidad = $productoRequest->fecha_caducidad;
        $response = [];  $mensaje = '';

        if ($productoRequest) {
            $nuevoProducto = new Producto();

            //validar que no se repita el mismo nombre
            $existe = Producto::where('nombre', $nombre)->get()->first();

            if ($existe) {
                $response = [
                    'status' => false,
                    'mensaje' => 'El nombre del producto ya existe',
                    'producto' => null,
                ];
            } else {

                if($categoria_id == 1){ //insumo
                   $mensaje = $fecha_caducidad;
                }else
                if($categoria_id == 2){//libro
                    $mensaje = '';
                }

                $nuevoProducto->categoria_id = $categoria_id;
                $nuevoProducto->nombre = $nombre;
                $nuevoProducto->caja = 0;
                $nuevoProducto->peso = $peso;
                $nuevoProducto->stock = 0;
                $nuevoProducto->descripcion = $descripcion;
                $nuevoProducto->img = $img;
                $nuevoProducto->fecha_caducidad = $mensaje;
                $nuevoProducto->estado = 'A';

                if ($nuevoProducto->save()) {
                    $response = [
                        'status' => true,
                        'mensaje' => 'El producto se ha guardado',
                        'producto' => $nuevoProducto,
                    ];
                } else {
                    $response = [
                        'status' => false,
                        'mensaje' => 'No se pudo guardar',
                        'producto' => null,
                    ];
                }
            }
        } else {
            $response = [
                'status' => false,
                'mensaje' => 'No ahi datos'
            ];
        }
        echo json_encode($response);
    }

    public function subirFicheroImagen($file) 
    {
        $this->cors->corsJson();

        $target_path = "resources/productos/";

        $imagen = $file['fichero'];
        $target_path = $target_path . basename($imagen['name']);

        $enlace_actual = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
        $enlace_actual = str_replace('index.php', '', $enlace_actual);

        $response = [];

        if (move_uploaded_file($imagen['tmp_name'], $target_path)) {
            $response = [
                'status' => true,
                'mensaje' => 'Fichero subido',
                'imagen' => $imagen['name'],
                'direccion' => $enlace_actual . '/' . $target_path,
            ];
        } else {
            $response = [
                'status' => false,
                'mensaje' => 'No se pudo guardar el fichero',
                'imagen' => null,
                'direccion' => null,
            ];
        }

        echo json_encode($response);
    } 

    public function dataTableInsumo()
    {
        $this->cors->corsJson();
        $producto = Producto::where('estado', 'A')->where('categoria_id',1)->orderBy('nombre')->get();

        $data = [];    $i = 1;

        foreach ($producto as $p) {
            $url = BASE . 'resources/productos/' . $p->img;
            $icono = $p->estado == 'I' ? '<i class="fa fa-check-circle fa-lg"></i>' : '<i class="fa fa-trash fa-lg"></i>';
            $clase = $p->estado == 'I' ? 'btn-success btn-sm' : 'btn-dark btn-sm';
            $other = $p->estado == 'A' ? 0 : 1;

            $botones = '<div class="btn-group">
                            <button class="btn btn-primary btn-sm" onclick="editar_producto(' . $p->id . ')">
                                <i class="fa fa-edit fa-lg"></i>
                            </button>
                            <button class="btn ' . $clase . '" onclick="eliminar_producto(' . $p->id . ',' . $other . ')">
                                ' . $icono . '
                            </button>
                        </div>';

            $data[] = [
                0 => $i,
                1 => '<div class="box-img-producto"><img src=' . "$url" . '></div>',
                2 => $p->nombre,
                3 => $p->categoria->detalle,
                4 => $p->peso,
                5 => $p->caja,
                6 => $p->stock,
                7 => $p->fecha_caducidad,
                8 => $botones,
            ];
            $i++;
        }

        $result = [
            'sEcho' => 1,
            'iTotalRecords' => count($data),
            'iTotalDisplayRecords' => count($data),
            'aaData' => $data,
        ];
        echo json_encode($result);
    }

    public function dataTableLibro()
    {
        $this->cors->corsJson();
        $producto = Producto::where('estado', 'A')->where('categoria_id',2)->orderBy('nombre')->get();

        $data = [];    $i = 1;

        foreach ($producto as $p) {
            $url = BASE . 'resources/productos/' . $p->img;
            $icono = $p->estado == 'I' ? '<i class="fa fa-check-circle fa-lg"></i>' : '<i class="fa fa-trash fa-lg"></i>';
            $clase = $p->estado == 'I' ? 'btn-success btn-sm' : 'btn-dark btn-sm';
            $other = $p->estado == 'A' ? 0 : 1;

            $botones = '<div class="btn-group">
                            <button class="btn btn-primary btn-sm" onclick="editar_producto(' . $p->id . ')">
                                <i class="fa fa-edit fa-lg"></i>
                            </button>
                            <button class="btn ' . $clase . '" onclick="eliminar_producto(' . $p->id . ',' . $other . ')">
                                ' . $icono . '
                            </button>
                        </div>';

            $data[] = [
                0 => $i,
                1 => '<div class="box-img-producto"><img src=' . "$url" . '></div>',
                2 => $p->nombre,
                3 => $p->categoria->detalle,
                4 => $p->caja,
                5 => $p->stock,
                6 => $botones,
            ];
            $i++;
        }

        $result = [
            'sEcho' => 1,
            'iTotalRecords' => count($data),
            'iTotalDisplayRecords' => count($data),
            'aaData' => $data,
        ];
        echo json_encode($result);
    }

    public function eliminar(Request $request){
        $this->cors->corsJson();
        $productoRequest = $request->input('producto');
        $id = intval($productoRequest->id);

        $producto = Producto::find($id);
        $response = [];

        if($producto){
            $producto->estado = 'I';
            $producto->save();

            $response = [
                'status' => true,
                'mensaje' => 'Se ha eliminado el producto', 
            ];
        }else{
            $response = [
                'status' => false,
                'mensaje' => 'No se ha podido eliminar el producto', 
            ];
        }
        echo json_encode($response);
    }

    public function editar(Request $request){    
        $this->cors->corsJson();
        $productoRequest = $request->input('producto');
        $id = intval($productoRequest->id);
        $categoria_id = intval($productoRequest->categoria_id);
        $nombre = ucfirst($productoRequest->nombre);
        $peso = $productoRequest->peso;
        $descripcion = ucfirst($productoRequest->descripcion);
        $fecha_caducidad = $productoRequest->fecha_caducidad;

        $response = [];       
        $producto = Producto::find($id);
       
        if($productoRequest){
            if($producto){
                $producto->categoria_id = $categoria_id;
                $producto->nombre = $nombre;
                $producto->peso = $peso;
                $producto->descripcion = $descripcion;
                $producto->fecha_caducidad = $fecha_caducidad;
                $producto->estado = 'A';
                $producto->save();  

                $response = [
                    'status' => true,
                    'mensaje' => 'El Producto se ha actualizado',
                    'data' => $producto,
                ];
            }else {
                $response = [
                    'status' => false,
                    'mensaje' => 'No se puede actualizar el producto',
                ];
            }
        }else{
            $response = [
                'status' => false,
                'mensaje' => 'No hay datos...!!'
            ];
        }
        echo json_encode($response);
    }

    public function buscarProducto($params)
    {
        $this->cors->corsJson();
        $texto = strtolower($params['texto']);

        $productos = Producto::where('nombre','like',$texto . '%')->where('estado','A')->get();
        
        foreach($productos as $pro){
            $categoria = $pro->categoria;

        }
        $response = [];

        if ($texto == "") {
            $response = [
                'status' => true,
                'mensaje' => 'Todos los registros',
                'productos' => $productos,
                'categoria' => $categoria
            ];
        } else {
            if (count($productos) > 0) {
                $response = [
                    'status' => true,
                    'mensaje' => 'Coincidencias encontradas',
                    'productos' => $productos,
                    'categoria' => $categoria
                ];
            } else {
                $response = [
                    'status' => false,
                    'mensaje' => 'No hay registros',
                    'productos' => null,
                    'categoria' => null
                ];
            }
        }
        echo json_encode($response);
    }

    public function caducarse($params){
        $this->cors->corsJson();  $response = [];
        $categoria_id = intval($params['categoria_id']);
        $year = intval($params['year']);
        $month = intval($params['month']);


        $dataProducto = Producto::where('categoria_id', $categoria_id)
                        ->whereYear('fecha_caducidad',$year)
                        ->whereMonth('fecha_caducidad', $month)->get();

        if(count($dataProducto) > 0){
            foreach($dataProducto as $item){
                $item->categoria;
            }
            $response = [
                'status' => true,
                'mensaje' => 'si hay datos',
                'producto' => $dataProducto
            ];

        }else{
            $response = [
                'status' => false,
                'mensaje' => 'no hay datos',
                'producto' => null
            ];
        }
        echo json_encode($response);
    }
}
