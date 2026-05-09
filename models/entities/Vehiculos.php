<?php
namespace app\models\entities;

use app\models\config\ModelBase;

require_once __DIR__ . '/../config/model_base.php';

class Vehiculos extends ModelBase
{
    protected $id        = 0;
    protected $marca     = null;
    protected $modelo    = null;
    protected $anio      =0;
    protected $categoria = null;
    protected $estado    = 'Disponible';

    public function __construct($id, $marca, $modelo, $anio, $categoria, $estado = 'Disponible',)
    {
        $this->id         = $id;
        $this->marca      = $marca;
        $this->modelo     = $modelo;
        $this->anio       = $anio;
        $this->categoria  = $categoria;
        $this->estado     = $estado;
    }

    public function getAllData()
    {
        return [
            'id'         => $this->id,
            'marca'      => $this->marca,
            'modelo'     => $this->modelo,
            'anio' => $this->anio,
            'categoria'  => $this->categoria,
            'estado'     => $this->estado,
        ];
    }
}