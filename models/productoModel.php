<?php

require_once 'vendor/autoload.php';
require_once 'core/conexion.php';
require_once 'models/categoriaModel.php';
require_once 'models/detalle_abastecerModel.php';


use Illuminate\Database\Eloquent\Model;

class Producto extends Model{

    public $timestamps = false;
    protected $table = "productos";
    protected $filleable = ['categoria_id','nombre','caja','peso','stock','descripcion','img','fecha_caducidad','estado'];
    
    //uno a muchos
    public function categoria(){
        return $this->belongsTo(Categoria::class);
    }

    public function detalle_abastecer(){
        return $this->hasMany(Detalle_Abastecer::class);
    }

}