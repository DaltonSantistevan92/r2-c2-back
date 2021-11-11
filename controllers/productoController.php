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
        $stock = intval($productoRequest->stock);
        $descripcion = ucfirst($productoRequest->descripcion);
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
                $nuevoProducto->peso = $peso;
                $nuevoProducto->stock = $stock;
                $nuevoProducto->descripcion = $descripcion;
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

    public function dataTable()
    {
        $this->cors->corsJson();
        $producto = Producto::where('estado', 'A')->orderBy('nombre')->get();

        $data = [];    $i = 1;

        foreach ($producto as $p) {
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
                1 => $p->nombre,
                2 => $p->categoria->detalle,
                3 => $p->peso,
                4 => $p->stock,
                5 => $p->fecha_caducidad,
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
        $stock = intval($productoRequest->stock);
        $descripcion = ucfirst($productoRequest->descripcion);
        $fecha_caducidad = $productoRequest->fecha_caducidad;

        $response = [];       
        $producto = Producto::find($id);
       
        if($productoRequest){
            if($producto){
                $producto->categoria_id = $categoria_id;
                $producto->nombre = $nombre;
                $producto->peso = $peso;
                $producto->stock = $stock;
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

}
