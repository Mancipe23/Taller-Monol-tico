<?php
require __DIR__ . '/../models/config/model_base.php';
require __DIR__ . '/../models/entities/Vehiculos.php';
require __DIR__ . '/../models/entities/cliente.php';
require __DIR__ . '/../models/config/connection_db.php';
require __DIR__ . '/../models/Queries/VehiculosQuery.php';
require __DIR__ . '/../models/Queries/ClientesQuery.php';
require __DIR__ . '/../controllers/VehiculoController.php';
require __DIR__ . '/../controllers/ClienteController.php';

use app\controllers\VehiculoController;
use app\controllers\ClienteController;

$vehiculoController = new VehiculoController();
$clienteController  = new ClienteController();
$vehiculos          = $vehiculoController->disponibles();
$clientes           = $clienteController->getLista();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nueva Reserva - RentCar Pro</title>
    <link rel="stylesheet" href="../public/style.css">
</head>
<body class="fade-in">
<div class="container">
    <header>
        <h1>Crear Reserva</h1>
    </header>

    <div class="action-bar">
        <a href="lista_reservas.php" class="btn-back">← Volver</a>
    </div>

    <div class="table-responsive">
        <form action="../controllers/registrar_reserva_proceso.php" method="POST" class="filter-form">

            <div class="filter-group full-width">
                <label>Seleccionar Cliente</label>
                <select name="id_cliente" class="filter-input" required>
                    <option value="">-- Seleccione un cliente registrado --</option>
                    <?php foreach ($clientes as $c): ?>
                        <option value="<?= $c->get('id') ?>">
                            <?= htmlspecialchars($c->get('nombre')) ?> (Doc: <?= htmlspecialchars($c->get('documento')) ?>)
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="filter-group full-width">
                <label>Vehículo Disponible</label>
                <select name="id_vehiculo" class="filter-input" required>
                    <option value="">-- Seleccione un auto --</option>
                    <?php foreach ($vehiculos as $v): ?>
                        <option value="<?= $v->get('id') ?>">
                            <?= htmlspecialchars($v->get('marca')) ?> <?= htmlspecialchars($v->get('modelo')) ?> (<?= htmlspecialchars($v->get('categoria')) ?>)
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="filter-group">
                <label>Fecha Inicio</label>
                <input type="date" name="fecha_inicio" class="filter-input" required>
            </div>

            <div class="filter-group">
                <label>Fecha Fin</label>
                <input type="date" name="fecha_fin" class="filter-input" required>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-add">Confirmar Reserva</button>
            </div>
        </form>
    </div>
</div>
</body>
</html>