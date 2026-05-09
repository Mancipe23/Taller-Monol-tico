<?php
require_once __DIR__ . '/../models/config/model_base.php';
require_once __DIR__ . '/../models/config/connection_db.php';
require_once __DIR__ . '/../models/entities/Vehiculos.php';
require_once __DIR__ . '/../models/Queries/VehiculosQuery.php';
require_once __DIR__ . '/../controllers/VehiculoController.php';

use app\controllers\VehiculoController;

$controller = new VehiculoController();
$vehiculos  = $controller->listar();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RentCar Pro - Vehículos</title>
    <link rel="stylesheet" href="../public/style.css">
</head>
<body class="fade-in">
<div class="container">
    <header>
        <h1>Gestión de Flota</h1>
        <p class="subtitle">Visualiza y administra tus vehículos disponibles</p>
    </header>

    <div class="action-bar">
        <a href="inicio.php" class="btn-back">← Volver</a>
        <a href="crear_vehiculo.php" class="btn-add">➕ Registrar Vehículo</a>
    </div>

    <div class="table-responsive">
        <table class="main-table">
            <thead>
                <tr>
                    <th>Placa</th>
                    <th>Marca</th>
                    <th>Modelo</th>
                    <th>Categoría</th>
                    <th>Precio/Día</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($vehiculos)): ?>
                    <?php foreach ($vehiculos as $v): ?>
                        <tr>
                            <td><strong><?= htmlspecialchars($v->get('placa')) ?></strong></td>
                            <td><?= htmlspecialchars($v->get('marca')) ?></td>
                            <td><?= htmlspecialchars($v->get('modelo')) ?></td>
                            <td><?= htmlspecialchars($v->get('categoria')) ?></td>
                            <td>$<?= number_format($v->get('precio_dia'), 2) ?></td>
                            <td>
                                <?php
                                    $estado = strtolower($v->get('estado'));
                                    $clase  = ($estado === 'disponible') ? 'available' : 'rented';
                                ?>
                                <span class="tag <?= $clase ?>"><?= ucfirst($estado) ?></span>
                            </td>
                            <td>
                                <button class="btn-icon" onclick='openEditModal(<?= json_encode($v->getAllData()) ?>)'>✏️</button>
                                <a href="eliminar_vehiculo.php?id=<?= $v->get('id') ?>"
                                   class="btn-icon delete"
                                   onclick="return confirm('¿Estás seguro?')">🗑️</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" style="text-align:center; padding:30px;">
                            No hay vehículos registrados.
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>