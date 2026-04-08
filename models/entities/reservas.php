<?php

namespace app\models\entities;

use app\models\config\ModelBase;

class Reserva extends ModelBase
{
    protected $nombre_cliente = null;
    protected $email_cliente = null;
    protected $fecha_ini = null;
    protected $fecha_fin = null;

    public function __construct($nombre_cliente, $email_cliente,$fecha_ini,$fecha_fin)
    {
        $this->nombre_cliente = $nombre_cliente;
        $this->email_cliente= $email_cliente;
        $this->fecha_ini = $fecha_ini;
        $this->fecha_fin = $fecha_fin;
    }
} 