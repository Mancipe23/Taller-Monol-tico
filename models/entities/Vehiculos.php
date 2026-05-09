<?php
namespace app\models\entities;

use app\models\config\ModelBase;

require_once __DIR__ . '/../config/model_base.php';

class Vehiculos extends ModelBase
{
    protected $id        = 0;
    protected $marca     = null;
    protected $placa     = null;
    protected $modelo    = null;
    protected $categoria = null;
    protected $estado    = 'Disponible';
    protected $precio_dia = 0;

    public function __construct($id, $marca, $placa, $modelo, $categoria, $estado = 'Disponible', $precio_dia = 0)
    {
        $this->id         = $id;
        $this->marca      = $marca;
        $this->placa      = $placa;
        $this->modelo     = $modelo;
        $this->categoria  = $categoria;
        $this->estado     = $estado;
        $this->precio_dia = $precio_dia;
    }

    public function getAllData()
    {
        return [
            'id'         => $this->id,
            'marca'      => $this->marca,
            'placa'      => $this->placa,
            'modelo'     => $this->modelo,
            'categoria'  => $this->categoria,
            'estado'     => $this->estado,
            'precio_dia' => $this->precio_dia,
        ];
    }
}