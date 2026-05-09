<?php
require_once __DIR__ . '/../models/config/connection_db.php';
require_once __DIR__ . '/../models/config/model_base.php';
require_once __DIR__ . '/../models/entities/Vehiculos.php';
require_once __DIR__ . '/../models/queries/VehiculosQuery.php';
require_once __DIR__ . '/VehiculoController.php';

use app\controllers\VehiculoController;
use app\models\entities\Vehiculos;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $marca     = $_POST['marca'];
    $modelo    = $_POST['modelo'];
    $anio      = intval($_POST['anio']); 
    $categoria = $_POST['categoria'];
    $estado    = 'Disponible'; 
    $nuevoVehiculo = new Vehiculos(0, $marca, $modelo, $anio, $categoria, $estado);

    $controller = new VehiculoController();
    $resultado = $controller->crear($nuevoVehiculo);

    if ($resultado) {
        header("Location: ../views/opcionvehiculo.php?res=ok");
        exit();
    } else {
        echo "Error: No se pudo registrar el vehículo. Verifica la base de datos.";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Vehículo - Summer Car</title>
    <link rel="stylesheet" href="../public/style.css">
</head>
<body class="fade-in">

    <div class="container">
        <header>
            <h1>Registrar Nuevo Vehículo</h1>
            <p class="subtitle">Ingresa los datos técnicos de la nueva unidad</p>
        </header>

        <div class="action-bar">
            <a href="opcionvehiculo.php" class="btn-back">← Cancelar</a>
        </div>

        <div class="table-responsive">
            <form action="../controllers/registrar_vehiculo_proceso.php" method="POST" class="form-container">
                <div class="form-group">
                    <label>Marca del Vehículo:</label>
                    <input type="text" name="marca" placeholder="Ej: Toyota" required>
                </div>

                <div class="form-group">
                    <label>Modelo / Línea:</label>
                    <input type="text" name="modelo" placeholder="Ej: Corolla" required>
                </div>

                <div class="form-group">
                    <label>Año:</label>
                    <input type="number" name="anio" placeholder="2024" required>
                </div>

                <div class="form-group">
                    <label>Categoría:</label>
                    <select name="categoria">
                        <option value="Sedán">Sedán</option>
                        <option value="SUV">SUV</option>
                        <option value="Camioneta">Camioneta</option>
                        <option value="Deportivo">Deportivo</option>
                    </select>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn-add">Guardar Vehículo</button>
                </div>
            </form>
        </div>
    </div>

</body>
</html>