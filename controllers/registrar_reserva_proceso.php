<?php
require_once __DIR__ . '/../models/config/model_base.php';
require_once __DIR__ . '/../models/config/connection_db.php';
require_once __DIR__ . '/../models/entities/reservas.php';
require_once __DIR__ . '/../models/Queries/ReservasQuery.php';
require_once __DIR__ . '/../models/Queries/VehiculosQuery.php';
require_once __DIR__ . '/../controllers/ReservasController.php';
require_once __DIR__ . '/../controllers/VehiculoController.php';

use app\controllers\ReservasController;
use app\controllers\VehiculoController;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_cliente  = intval($_POST['id_cliente']);
    $id_vehiculo = intval($_POST['id_vehiculo']);
    $fecha_inicio = $_POST['fecha_inicio'];
    $fecha_fin    = $_POST['fecha_fin'];

    $controller = new ReservasController();
    $resultado  = $controller->crear($id_cliente, $id_vehiculo, $fecha_inicio, $fecha_fin);

    if ($resultado) {
        $vehiculoController = new VehiculoController();
        $vehiculoController->cambiarEstado($id_vehiculo, 'En Alquiler');

        header("Location: ../views/lista_reservas.php?res=ok");
        exit();
    } else {
        echo "Error: No se pudo registrar la reserva.";
    }
}
?>