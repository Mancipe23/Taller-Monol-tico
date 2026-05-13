<?php
require __DIR__ . '/../models/config/model_base.php';
require __DIR__ . '/../models/entities/Vehiculos.php';
require __DIR__ . '/../models/entities/cliente.php';
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
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Nueva Reserva</title>
    <link rel="stylesheet" href="../public/style.css">
</head>
<body>
<div class="container">
    <h1>Crear Reserva</h1>
    <form action="guardar_reserva.php" method="POST" class="filter-form">
        <div class="filter-group full-width">
    <label>Seleccionar Cliente</label>
    <select name="cliente_id" class="filter-input" required>
        <option value="" disabled selected>-- Seleccione un cliente --</option>
        
        <?php foreach ($clientes as $c): ?>
            <option value="<?= $c->get('id') ?>">
                <?= htmlspecialchars($c->get('nombre')) ?>
            </option>
        <?php endforeach; ?>
    </select>
</div>  
     <div class="filter-group full-width">
            <label>VEHÍCULO</label>
            <select name="vehiculo_id" class="filter-input" required>
                <option value="" disabled selected>-- Seleccione un vehículo --</option>
                <?php foreach ($vehiculos as $v): ?>
                    <option value="<?= $v->get('id') ?>">
                        <?= htmlspecialchars($v->get('marca') . " " . $v->get('modelo')) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="filter-group full-width">
            <label>FECHA INICIO</label>
            <input type="date" name="fecha_inicio" class="filter-input" required>
        </div>

        <div class="filter-group full-width">
            <label>FECHA FIN</label>
            <input type="date" name="fecha_fin" class="filter-input" required>
        </div>

        <button type="submit" class="btn-add">Guardar Reserva</button>
    </form>
</div>
</body>
</html>