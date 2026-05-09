<?php
require __DIR__ . '/../models/config/model_base.php';
require __DIR__ . '/../models/entities/cliente.php';
require __DIR__ . '/../models/config/connection_db.php';
require __DIR__ . '/../models/Queries/ClientesQuery.php';
require __DIR__ . '/../controllers/ClienteController.php';

use app\controllers\ClienteController;

$controller = new ClienteController();
$clientes   = $controller->getLista();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clientes</title>
    <link rel="stylesheet" href="../public/style.css">
</head>
<body class="fade-in">
<div class="container">

    <h1>Gestión de Clientes</h1>
    <p class="subtitle">Administra los clientes registrados</p>

    <div class="action-bar">
        <a href="inicio.php" class="btn-back">← Volver</a>
        <a href="registrar_cliente.php" class="btn-add">➕ Registrar Cliente</a>
    </div>

    <div class="table-responsive">
        <table class="main-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Documento</th>
                    <th>Nombre</th>
                    <th>Teléfono</th>
                    <th>Email</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($clientes)): ?>
                    <?php foreach ($clientes as $c): ?>
                        <tr>
                            <td><?= htmlspecialchars($c->get('id')) ?></td>
                            <td><?= htmlspecialchars($c->get('documento')) ?></td>
                            <td><?= htmlspecialchars($c->get('nombre')) ?></td>
                            <td><?= htmlspecialchars($c->get('telefono')) ?></td>
                            <td><?= htmlspecialchars($c->get('email')) ?></td>
                            <td>
                                <a href="eliminar_cliente.php?id=<?= $c->get('id') ?>"
                                   class="btn-icon delete"
                                   onclick="return confirm('¿Estás seguro?')">🗑️</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" style="text-align:center; padding:30px;">
                            No hay clientes registrados.
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

</div>
</body>
</html>