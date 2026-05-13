<?php
require __DIR__ . '/../models/config/model_base.php';
require __DIR__ . '/../models/entities/Reservas.php';
require __DIR__ . '/../models/config/connection_db.php';
require __DIR__ . '/../models/queries/ReservasQuery.php';
require __DIR__ . '/../models/queries/VehiculosQuery.php';
require __DIR__ . '/../controllers/ReservasController.php';

use app\controllers\ReservasController;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $controller = new ReservasController();

    $resultado = $controller->crear(
        $_POST['cliente_id'],
        $_POST['vehiculo_id'],
        $_POST['fecha_inicio'],
        $_POST['fecha_fin']
    );
    if (isset($resultado['success'])) {
        header("Location: lista_reservas.php?res=ok");
        exit();
    } else {
        header("Location: crear_reserva.php?error=" . urlencode($resultado['error']));
        exit();
    }
}