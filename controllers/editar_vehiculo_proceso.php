<?php
require_once __DIR__ . '/../models/config/model_base.php';
require_once __DIR__ . '/../models/config/connection_db.php';
require_once __DIR__ . '/../models/entities/Vehiculos.php';
require_once __DIR__ . '/../models/Queries/VehiculosQuery.php';
require_once __DIR__ . '/VehiculoController.php';

use app\controllers\VehiculoController;
use app\models\entities\Vehiculos;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id         = intval($_POST['id']);
    $placa      = $_POST['placa'];
    $marca      = $_POST['marca'];
    $modelo     = $_POST['modelo'];
    $categoria  = $_POST['categoria'];
    $precio_dia = floatval($_POST['precio_dia']);
    $estado     = $_POST['estado'];

    $vehiculo = new Vehiculos($id, $marca, $placa, $modelo, $categoria, $estado, $precio_dia);

    $controller = new VehiculoController();
    $resultado  = $controller->editar($id, $placa, $marca, $modelo, $categoria, $precio_dia, $estado);

    if ($resultado) {
        header("Location: ../views/opcionvehiculo.php?res=editado");
        exit();
    } else {
        echo "Error: No se pudo actualizar el vehículo.";
    }
}
?>