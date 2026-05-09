<?php
require_once __DIR__ . '/../models/config/model_base.php';
require_once __DIR__ . '/../models/config/connection_db.php';
require_once __DIR__ . '/../models/entities/Vehiculos.php';
require_once __DIR__ . '/../models/Queries/VehiculosQuery.php';
require_once __DIR__ . '/VehiculoController.php';

use app\controllers\VehiculoController;
use app\models\entities\Vehiculos;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $marca      = $_POST['marca'];
    $placa      = $_POST['placa'];
    $modelo     = $_POST['modelo'];
    $categoria  = $_POST['categoria'];
    $precio_dia = floatval($_POST['precio_dia']);
    $estado     = 'Disponible';

    $nuevoVehiculo = new Vehiculos(0, $marca, $placa, $modelo, $categoria, $estado, $precio_dia);

    $controller = new VehiculoController();
    $resultado  = $controller->crear($nuevoVehiculo);

    if ($resultado) {
        header("Location: ../views/opcionvehiculo.php?res=ok");
        exit();
    } else {
        echo "Error: No se pudo registrar el vehículo.";
    }
}
?>