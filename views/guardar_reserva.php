<?php
require __DIR__ . '/../models/config/model_base.php';
require __DIR__ . '/../models/entities/Reservas.php';
require __DIR__ . '/../models/config/connection_db.php';
require __DIR__ . '/../models/queries/ReservasQuery.php';
require __DIR__ . '/../models/queries/VehiculosQuery.php';
require __DIR__ . '/../controllers/ReservasController.php';

use app\controllers\ReservasController;

$controller = new ReservasController();

$resultado = $controller->crear(
    $_POST['cliente_id'],
    $_POST['vehiculo_id'],
    $_POST['fecha_inicio'],
    $_POST['fecha_fin']
);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Datos guardados</title>
</head>
<body> 
    <?php
echo $resultado['success'] ?? $resultado['error'];

echo "<br><a href='lista_reservas.php'>Volver</a>";
?>
<a href='lista_reservas.php'>Volver</a>";
</body> 
</html>