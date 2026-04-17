<?php
require __DIR__ . '/../models/config/model_base.php';
require __DIR__ . '/../models/entities/Reservas.php';
require __DIR__ . '/../models/config/connection_db.php';
require __DIR__ . '/../models/queries/ReservasQuery.php';
require __DIR__ . '/../controllers/ReservasController.php';

use app\controllers\ReservasController;

$controller = new ReservasController();

// filtros
$cliente_id = $_GET['cliente_id'] ?? null;
$vehiculo_id = $_GET['vehiculo_id'] ?? null;

$reservas = $controller->historial($cliente_id, $vehiculo_id);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Historial de Reservas</title>
</head>
<body>

<h2>Historial de Reservas</h2>

<form method="GET">
    Cliente ID: <input type="number" name="cliente_id">
    Vehículo ID: <input type="number" name="vehiculo_id">
    <button type="submit">Filtrar</button>
</form>

<br>

<table border="1">
    <tr>
        <th>ID</th>
        <th>Cliente</th>
        <th>Vehículo</th>
        <th>Fecha Inicio</th>
        <th>Fecha Fin</th>
        <th>Estado</th>
    </tr>

    <?php if ($reservas): ?>
        <?php foreach ($reservas as $r): ?>
            <tr>
                <td><?php echo $r->get('id'); ?></td>
                <td><?php echo $r->get('cliente_nombre'); ?></td>
                <td><?php echo $r->get('vehiculo_info'); ?></td>
                <td><?php echo $r->get('fecha_inicio'); ?></td>
                <td><?php echo $r->get('fecha_fin'); ?></td>
                <td><?php echo $r->get('estado'); ?></td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="6">No hay reservas</td>
        </tr>
    <?php endif; ?>

</table>

<br>
<a href=inicio.php">Volver</a>

</body>
</html>