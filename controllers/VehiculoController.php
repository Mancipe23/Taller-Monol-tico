<?php

// Requerimos los archivos necesarios. 
require_once '../models/config/connection_db.php';
require_once '../models/config/model_base.php';
require_once '../models/entities/vehiculo.php';
require_once '../models/Queries/VehiculosQuery.php';

use app\models\entities\Vehiculo;
use app\models\Queries\VehiculosQuery;

// Verificamos que la petición sea POST y que venga la variable 'accion'
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['accion'])) {
    
    // --- LÓGICA PARA CREAR ---
    if ($_POST['accion'] == 'crear') {
        $marca     = $_POST['marca'];
        $modelo    = $_POST['modelo'];
        $anio      = $_POST['anio'];
        $categoria = $_POST['categoria'];
        $estado    = $_POST['estado']; 

        $nuevoVehiculo = new Vehiculo(0, $marca, $modelo, $anio, $categoria, $estado);
        $resultado = VehiculosQuery::insertarVehiculo($nuevoVehiculo);

        if ($resultado) {
            header("Location: ../index.php?mensaje=guardado");
            exit();
        } else {
            echo "Hubo un error al intentar guardar el vehículo.";
        }
    } 
    
    // --- LÓGICA PARA ELIMINAR ---
    elseif ($_POST['accion'] == 'eliminar') {
        // Recibimos el ID del vehículo que queremos borrar
        $id = $_POST['id'];

        // Llamamos al método que creamos en VehiculosQuery
        $resultado = VehiculosQuery::eliminarVehiculo($id);

        if ($resultado) {
            header("Location: ../index.php?mensaje=eliminado");
            exit();
        } else {
            echo "Hubo un error al intentar eliminar el vehículo.";
        }
    }

} else {
    header("Location: ../index.php");
    exit();
}

