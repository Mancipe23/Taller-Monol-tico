<?php

namespace app\models\entities;
use app\models\config\ModelBase;
class Vehiculos extends ModelBase{
   
    protected $id = 0;
    protected $marca = null;
    protected $modelo;
    protected $anio;
    protected $categoria;
    protected $estado;
    public function __construct($id, $marca, $modelo, $anio, $categoria, $estado = 'Disponible') { 
        $this->id = $id;
        $this->marca = $marca;
        $this->modelo = $modelo;
        $this->anio = $anio;
        $this->categoria = $categoria;
        $this->estado = $estado;
    } 

    public function get($propiedad) {
    return $this->$propiedad;
    }
 }