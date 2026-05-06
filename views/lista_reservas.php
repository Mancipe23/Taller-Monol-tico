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
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RentCar Pro - Lista de Reservas</title>
    <link rel="stylesheet" href="../public/style.css">
</head>
<body>

<div class="container fade-in">
    <h1>Lista de Reservas</h1>
    <p class="subtitle">Administra los alquileres y estados actuales del sistema</p>

    <div class="action-bar">
        <a href="inicio.php" class="btn-back">← Volver</a>
        <div>
            <a href="historialalquiler.php" class="btn-back">📋 Ver Historial</a>
            <a href="crear_reserva.php" class="btn-add">➕ Nueva Reserva</a>
        </div>
    </div>

    <div class="table-responsive">
        <table class="main-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Cliente ID</th>
                    <th>Vehículo ID</th>
                    <th>Inicio</th>
                    <th>Fin</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($reservas): ?>
                    <?php foreach ($reservas as $r): ?>
                        <?php 
                            $estado = strtolower($r->get('estado')); 
                            // Mapeo de clases CSS según el estado
                            $tagClass = ($estado == 'activa') ? 'available' : (($estado == 'cancelada') ? 'cancelled' : 'rented');
                        ?>
                        <tr>
                            <td><strong>#<?= $r->get('id') ?></strong></td>
                            <td>👤 <?= $r->get('cliente_id') ?></td>
                            <td>🚗 <?= $r->get('vehiculo_id') ?></td>
                            <td><?= $r->get('fecha_inicio') ?></td>
                            <td><?= $r->get('fecha_fin') ?: '<span style="color: #999;">Pendiente</span>' ?></td>
                            <td>
                                <span class="tag <?= $tagClass ?>">
                                    <?= ucfirst($estado) ?>
                                </span>
                            </td>
                            <td>
                                <?php if ($estado == 'activa'): ?>
                                    <a href="completar_reserva.php?id=<?= $r->get('id') ?>&vehiculo_id=<?= $r->get('vehiculo_id') ?>" class="btn-icon" title="Completar">✅</a>
                                    <a href="cancelar_reserva.php?id=<?= $r->get('id') ?>&vehiculo_id=<?= $r->get('vehiculo_id') ?>" class="btn-icon delete" title="Cancelar">❌</a>
                                <?php else: ?>
                                    <span style="color: #ccc; font-size: 0.8rem;">Sin acciones</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" style="text-align: center; padding: 40px;">No hay reservas registradas en el sistema.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>