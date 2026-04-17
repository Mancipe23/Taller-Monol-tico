<?php
require __DIR__ . '/../models/config/model_base.php';
require __DIR__ . '/../models/entities/Vehiculos.php';
require __DIR__ . '/../models/entities/Clientes.php';
require __DIR__ . '/../models/config/connection_db.php';
require __DIR__ . '/../models/queries/VehiculosQuery.php';
require __DIR__ . '/../models/queries/ClientesQuery.php';
require __DIR__ . '/../controllers/VehiculoController.php';
require __DIR__ . '/../controllers/ClienteController.php';

use app\controllers\VehiculoController;
use app\controllers\ClienteController;
$vehiculoController = new VehiculoController();
$clienteController = new ClienteController();
$vehiculos = $vehiculoController->disponibles();
$clientes = $clienteController->getLista();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Crear Reserva</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
<h2>Crear Reserva</h2>
<form action="guardar_reserva.php" method="POST">
    <select name="cliente_id" required>
        <?php foreach ($clientes as $c): ?>
            <option value="<?= $c->get('id') ?>">
                <?= $c->get('nombre') ?>
            </option>
        <?php endforeach; ?>
    </select>
    <br><br>
    <select name="vehiculo_id" required>
        <?php foreach ($vehiculos as $v): ?>
            <option value="<?= $v->get('id') ?>">
                <?= $v->get('marca') . " " . $v->get('modelo') ?>
            </option>
        <?php endforeach; ?>
    </select>
    <br><br>
    <input type="date" name="fecha_inicio" required>
    <br><br>
    <input type="date" name="fecha_fin" required>
    <br><br>
    <button type="submit">Guardar Reserva</button>
</form>
<br>
<a href="lista_reservas.php">Volver</a>

</body>
</html>