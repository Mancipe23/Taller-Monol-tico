<?php
namespace app\models\entities;

use app\models\config\ModelBase;

require_once __DIR__ . '/../config/model_base.php';

class cliente extends ModelBase
{
    protected $id         = 0;
    protected $documento  = null;
    protected $nombre     = null;
    protected $telefono   = null;
    protected $email      = null;

    public function __construct($id, $documento, $nombre, $telefono, $email)
    {
        $this->id        = $id;
        $this->documento = $documento;
        $this->nombre    = $nombre;
        $this->telefono  = $telefono;
        $this->email     = $email;
    }

    public function getAllData()
    {
        return [
            'id'        => $this->id,
            'documento' => $this->documento,
            'nombre'    => $this->nombre,
            'telefono'  => $this->telefono,
            'email'     => $this->email,
        ];
    }
}