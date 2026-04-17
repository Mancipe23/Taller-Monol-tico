<?php
require __DIR__ . '/../models/config/model_base.php';
require __DIR__ . '/../models/entities/Reservas.php';
require __DIR__ . '/../models/config/connection_db.php';
require __DIR__ . '/../models/queries/ReservasQuery.php';
require __DIR__ . '/../models/queries/VehiculosQuery.php';
require __DIR__ . '/../controllers/ReservasController.php';

use app\controllers\ReservasController;

$controller = new ReservasController();

$controller->cancelar($_GET['id'], $_GET['vehiculo_id']);

header("Location: lista_reservas.php");
exit;