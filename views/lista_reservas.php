<?php
require __DIR__ . '/../models/config/model_base.php';
require __DIR__ . '/../models/entities/Reservas.php';
require __DIR__ . '/../models/config/connection_db.php';
require __DIR__ . '/../models/queries/ReservasQuery.php';
require __DIR__ . '/../controllers/ReservasController.php';
use app\controllers\ReservasController;
$controller = new ReservasController();
$reservas = $controller->listarTodas();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Lista de Reservas</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
<h2>Lista de Reservas</h2>
<a href="crear_reserva.php"> Nueva Reserva</a> |
<a href="historialalquiler.php"> Ver Historial</a>
<br><br>
<table>
    <tr>
        <th>ID</th>
        <th>Cliente ID</th>
        <th>Vehículo ID</th>
        <th>Inicio</th>
        <th>Fin</th>
        <th>Estado</th>
        <th>Acciones</th>
    </tr>
    <?php if ($reservas): ?>
        <?php foreach ($reservas as $r): ?>
            <tr>
                <td><?= $r->get('id') ?></td>
                <td><?= $r->get('cliente_id') ?></td>
                <td><?= $r->get('vehiculo_id') ?></td>
                <td><?= $r->get('fecha_inicio') ?></td>
                <td><?= $r->get('fecha_fin') ?></td>
                <td><?= $r->get('estado') ?></td>
                <td>
                    <?php if ($r->get('estado') == 'activa'): ?>
                        <a href="completar_reserva.php?id=<?= $r->get('id') ?>&vehiculo_id=<?= $r->get('vehiculo_id') ?>">
                        </a>
                        <a href="cancelar_reserva.php?id=<?= $r->get('id') ?>&vehiculo_id=<?= $r->get('vehiculo_id') ?>">
                        </a>
                    <?php else: ?>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="7">No hay reservas</td>
        </tr>
    <?php endif; ?>
</table>

<br>
<a href="index.php"> Volver</a>
</body>
</html>