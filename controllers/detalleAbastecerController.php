<?php

require_once 'app/cors.php';
require_once 'app/request.php';
require_once 'core/conexion.php';
require_once 'models/detalle_abastecerModel.php';
require_once 'models/productoModel.php';
require_once 'models/abastecerModel.php';


class DetalleAbastecerController
{
    private $cors;
    private $conexion;

    public function __construct()
    {
        $this->cors = new Cors();
        $this->conexion = new Conexion();
    }

    public function guardar($abastecer_id, $detalles = [])
    {
        $response = [];
        if(count($detalles) > 0 ){
            foreach($detalles as $de){
                $nuevo = new Detalle_Abastecer();
                $nuevo->abastecer_id = intval($abastecer_id);
                $nuevo->producto_id = intval($de->producto_id);
                $nuevo->num_caja = intval($de->num_caja);
                $nuevo->cantidad =  intval($de->cantidad);
                $nuevo->save();

                $this->actualizar_producto($de->producto_id,$de->num_caja,$de->cantidad);
            }

            $detalles_save = Detalle_Abastecer::where('abastecer_id',$abastecer_id)->get();

            $response = [
                'status' => true,
                'mensaje' => 'Se han guardado los productos',
                'detalle_abastecer' => $detalles_save,
            ];
        }else{
            $response = [
                'status' => true,
                'mensaje' => 'No hay productos para guardar',
                'detalle_abastecer' => null,
            ];
        }
         return $response;

    }


    protected function actualizar_producto($id_producto,$caja,$stock)
    {
        $producto = Producto::find($id_producto);
        $producto->caja += $caja;
        $producto->stock += $stock;
        $producto->save();
    }
}

