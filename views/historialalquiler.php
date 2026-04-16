<h2>Historial de Alquileres</h2>

<table border="1" style="width:100%; border-collapse: collapse; text-align: center;">
    <thead style="background-color: #f2f2f2;">
        <tr>
            <th>ID</th>
            <th>Cliente</th>
            <th>Vehículo</th>
            <th>Fecha Inicio</th>
            <th>Fecha Fin</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($listaReservas as $res): ?>
            <tr>
                <td><?php echo $res->get('id'); ?></td>
                <td><?php echo $res->get('cliente_nombre'); ?></td>
                <td><?php echo $res->get('vehiculo_info'); ?></td>
                <td><?php echo $res->get('fecha_inicio'); ?></td>
                <td><?php echo $res->get('fecha_fin'); ?></td>
                <td>
                    <span style="padding: 5px; border-radius: 5px; background-color: <?php echo ($res->get('estado') == 'activa') ? '#d4edda' : '#f8d7da'; ?>">
                        <?php echo $res->get('estado'); ?>
                    </span>
                </td>
                <td>
                    <?php if ($res->get('estado') == 'activa'): ?>
                        <a href="index.php?controller=reservas&action=devolver&id=<?php echo $res->get('id'); ?>">Devolver</a>
                    <?php else: ?>
                        Completada
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>