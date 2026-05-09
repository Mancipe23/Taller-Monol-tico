<?php
require_once __DIR__ . '/../models/config/model_base.php';
require_once __DIR__ . '/../models/config/connection_db.php';
require_once __DIR__ . '/../models/entities/Vehiculos.php';
require_once __DIR__ . '/../models/Queries/VehiculosQuery.php';
require_once __DIR__ . '/VehiculoController.php';

use app\controllers\VehiculoController;
use app\models\entities\Vehiculos;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $marca     = $_POST['marca'] ?? 'Sin Marca';
    $modelo    = $_POST['modelo'] ?? 'Sin Modelo';
    $anio      = $_POST['anio'] ??  (2000); 
    $categoria = $_POST['categoria'] ?? 'Sedán';
    $estado    = 'Disponible';
    $nuevoVehiculo = new Vehiculos(
        0, 
        $marca, 
        $modelo, 
        intval($anio), 
        $categoria, 
        $estado
    );

    $controller = new VehiculoController();
    $resultado  = $controller->crear($nuevoVehiculo);
 }
    if ($resultado) {
        header("Location: ../views/opcionvehiculo.php?res=ok");
        exit();
    } else {
         echo "Error: No se pudo registrar el vehículo.";
}
?>