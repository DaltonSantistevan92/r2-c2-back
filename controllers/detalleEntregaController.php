<?php

require_once 'app/cors.php';
require_once 'app/request.php';
require_once 'core/conexion.php';
require_once 'models/detalle_entregaModel.php';
require_once 'models/productoModel.php';


class DetalleEntregaController
{
    private $cors;
    private $db;

    public function __construct()
    {
        $this->cors = new Cors();
        $this->db = new Conexion();
    }

    public function guardar($entrega_id, $detalles = [])
    {
        $response = [];
        if(count($detalles) > 0 ){
            foreach($detalles as $de){
                $nuevo = new Detalle_Entrega();
                $nuevo->entrega_id = intval($entrega_id);
                $nuevo->producto_id = intval($de->producto_id);
                $nuevo->cantidad =  intval($de->cantidad);
                $nuevo->save();

                $stock = $nuevo->cantidad * (-1);

                $this->actualizar_producto($de->producto_id,$stock);
            }

            $detallesEntrega_save = Detalle_Entrega::where('entrega_id',$entrega_id)->get();

            $response = [
                'status' => true,
                'mensaje' => 'Se han guardado los productos',
                'detalle_entrega' => $detallesEntrega_save,
            ];
        }else{
            $response = [
                'status' => true,
                'mensaje' => 'No hay productos para guardar',
                'detalle_entrega' => null,
            ];
        }
         return $response;
    }

    protected function actualizar_producto($id_producto, $stock){
        $producto  = Producto::find($id_producto);
        $producto->stock += $stock;
        $producto->save();
    }


}