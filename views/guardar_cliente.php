<?php

require __DIR__ . '/../models/config/model_base.php';
require __DIR__ . '/../models/entities/cliente.php';
require __DIR__ . '/../models/config/connection_db.php';
require __DIR__ . '/../models/queries/ClientesQuery.php';
require __DIR__ . '/../controllers/ClienteController.php';

use app\models\entities\cliente;
use app\controllers\ClienteController;

$cliente = new cliente(
    0,
    $_POST['nombre'],
    $_POST['telefono'],
    $_POST['correo'],
    $_POST['numero_licencia']
);

$controller = new ClienteController();

$controller->crear($cliente);

header("Location: opcionclientes.php");

exit;