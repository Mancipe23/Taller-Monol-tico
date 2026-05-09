<?php

require __DIR__ . '/../models/config/connection_db.php';
require __DIR__ . '/../models/queries/ClientesQuery.php';
require __DIR__ . '/../controllers/ClienteController.php';

use app\controllers\ClienteController;

$controller = new ClienteController();

$controller->eliminar($_GET['id']);

header("Location: opcionclientes.php");

exit;