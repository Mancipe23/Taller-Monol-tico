<?php

require __DIR__ . '/../models/config/connection_db.php';
require __DIR__ . '/../models/queries/VehiculosQuery.php';
require __DIR__ . '/../controllers/VehiculoController.php';

use app\controllers\VehiculoController;

$controller = new VehiculoController();

$controller->eliminar($_GET['id']);

header("Location: opcionvehiculo.php");

exit;