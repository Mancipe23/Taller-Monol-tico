<?php

namespace app\models\entities;
use app\models\config\ModelBase;

class Clientes extends ModelBase
{
    protected $id = 0;
    protected $nombre = null;
    protected $telefono = null;
    protected $email = null;
    protected $numero_licencia = 0;

    public function __construct($id, $nombre, $telefono ,$email, $numero_licencia)
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this -> telefono = $telefono;
        $this->email = $email;
        $this->numero_licencia = $numero_licencia;
    }

   
}