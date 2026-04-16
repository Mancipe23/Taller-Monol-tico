<?php
require_once '../models/config/connection_db.php';
require_once '../models/config/model_base.php';
require_once '../models/entities/cliente.php';
require_once '../models/Queries/ClientesQuery.php';

use app\models\entities\Clientes;
use app\models\Queries\ClientesQuery;

if (isset($_POST['accion']) && $_POST['accion'] == 'crear') {
    
    // El orden de los parámetros debe coincidir con tu constructor en Cliente.php
    $nuevoCliente = new Clientes(
        null, // ID autoincremental
        $_POST['nombre'],
        $_POST['telefono'],
        $_POST['email'],
        $_POST['numero_licencia']
    );

    $resultado = ClientesQuery::insertarClientes($nuevoClientes);

    if ($resultado) {
        header("Location: ../views/clientes.php?mensaje=guardado");
    } else {
        echo "Error al registrar cliente.";
    }
    exit();

    // ... debajo de la lógica de crear ...
    if (isset($_POST['accion']) && $_POST['accion'] == 'eliminar') {
    $id = $_POST['id'];
    $resultado = ClientesQuery::eliminarClientes($id);

    if ($resultado) {
        header("Location: ../views/clientes.php?mensaje=eliminado");
    } else {
        echo "Error al eliminar cliente.";
    }
    exit();
    }
    
}