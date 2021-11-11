<?php

require_once 'vendor/autoload.php';
require_once 'core/conexion.php';
require_once 'models/categoriaModel.php';

use Illuminate\Database\Eloquent\Model;

class Producto extends Model{

    public $timestamps = false;
    protected $table = "productos";
    protected $filleable = ['categoria_id','nombre','peso','stock','descripcion','fecha_caducidad','estado'];
    
    //uno a muchos
    public function categoria(){
        return $this->belongsTo(Categoria::class);
    }
}