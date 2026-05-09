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
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RentCar Pro - Historial</title>
    <link rel="stylesheet" href="../public/style.css">
</head>
<body>

<div class="container fade-in">
    <h1>Historial de Reservas</h1>
    <p class="subtitle">Consulta el registro histórico de alquileres realizados</p>

    <div class="action-bar">
        <a href="inicio.php" class="btn-back">← Volver al Inicio</a>
        <a href="lista_reservas.php" class="btn-back">📅 Ver Reservas Activas</a>
    </div>

    <form method="GET" class="filter-form">
        <div class="filter-group">
            <label>ID Cliente</label>
            <input type="number" name="cliente_id" class="filter-input" placeholder="Ej: 1" value="<?= htmlspecialchars($cliente_id ?? '') ?>">
        </div>
        <div class="filter-group">
            <label>ID Vehículo</label>
            <input type="number" name="vehiculo_id" class="filter-input" placeholder="Ej: 5" value="<?= htmlspecialchars($vehiculo_id ?? '') ?>">
        </div>
        <button type="submit" class="btn-add">🔍 Filtrar</button>
        
        <?php if ($cliente_id || $vehiculo_id): ?>
            <a href="historialalquiler.php" class="clear-filters">Limpiar filtros</a>
        <?php endif; ?>
    </form>

    <div class="table-responsive">
        <table class="main-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Cliente</th>
                    <th>Vehículo</th>
                    <th>Fecha Inicio</th>
                    <th>Fecha Fin</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($reservas): ?>
                    <?php foreach ($reservas as $r): ?>
                        <?php 
                            $estado = strtolower($r->get('estado')); 
                            $tagClass = ($estado == 'activa' || $estado == 'completada') ? 'available' : (($estado == 'cancelada') ? 'cancelled' : 'rented');
                        ?>
                        <tr>
                            <td><strong>#<?= $r->get('id') ?></strong></td>
                            <td>👤 <?= $r->get('cliente_nombre') ?: $r->get('cliente_id') ?></td>
                            <td>🚗 <?= $r->get('vehiculo_info') ?: $r->get('vehiculo_id') ?></td>
                            <td>📅 <?= $r->get('fecha_inicio') ?></td>
                            <td>📅 <?= $r->get('fecha_fin') ?: '<span style="color: #999;">Abierta</span>' ?></td>
                            <td>
                                <span class="tag <?= $tagClass ?>">
                                    <?= ucfirst($estado) ?>
                                </span>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" style="text-align: center; padding: 40px; color: #999;">
                            No se encontraron registros que coincidan con la búsqueda.
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>