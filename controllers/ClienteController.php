<?php
namespace app\controllers;

use app\models\entities\Clientes;
use app\models\Queries\ClientesQuery;

class ClienteController {
    public function getLista()
    {
        return ClientesQuery::getAllClientes();
    }

    public function crear($cliente) {
        return ClientesQuery::insertarClientes($cliente);
    }

    public function eliminar($id) {
        return ClientesQuery::eliminarClientes($id);
    }
}
