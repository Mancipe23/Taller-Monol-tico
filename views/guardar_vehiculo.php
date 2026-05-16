<?php

require __DIR__ . '/../models/config/model_base.php';
require __DIR__ . '/../models/entities/Vehiculos.php';
require __DIR__ . '/../models/config/connection_db.php';
require __DIR__ . '/../models/queries/VehiculosQuery.php';
require __DIR__ . '/../controllers/VehiculoController.php';

use app\models\entities\Vehiculos;
use app\controllers\VehiculoController;

$vehiculo = new Vehiculos(
    0,
    $_POST['marca'],
    $_POST['modelo'],
    $_POST['anio'],
    $_POST['categoria'],
    'Disponible'
);
$controller = new VehiculoController();

$controller->crear($vehiculo);

header("Location: opcionvehiculo.php");

exit;