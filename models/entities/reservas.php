<?php

namespace app\models\entities;

use app\models\config\ModelBase;

class Reservas extends ModelBase
{
    protected $id = 0;
    protected $cliente_id  = null;
    protected $vehiculo_id = null;
    protected $fecha_inicio = null;
    protected $fecha_fin = null;
    protected $estado = null;
    public function __construct($id, $cliente_id, $vehiculo_id, $fecha_inicio, $fecha_fin, $estado)
    {
        $this->id = $id;
        $this->cliente_id = $cliente_id;
        $this->vehiculo_id = $vehiculo_id;
        $this->fecha_inicio = $fecha_inicio;
        $this->fecha_fin = $fecha_fin;
        $this->estado = $estado;
    }

   
}