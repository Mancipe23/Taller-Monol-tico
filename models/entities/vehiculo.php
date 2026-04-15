<?php

namespace app\models\entities;
use app\models\config\ModelBase;
class Vehiculo extends ModelBase{
   
    protected $id = 0;
    protected $marca = null;
    protected $modelo;
    protected $anio;
    protected $categoria;
    protected $estado;
    public function __construct($id, $marca, $modelo, $anio, $categoria, $estado = 'Disponible') { //se utiliza el funcion __construct para definir un constructor que se ejecuta automáticamente al crear una nueva instancia de la clase. Este constructor recibe parámetros para inicializar los atributos del vehículo, y el estado por defecto se establece como 'Disponible'.
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