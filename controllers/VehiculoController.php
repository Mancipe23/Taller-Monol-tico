<?php
namespace app\controllers;

use app\models\entities\Vehiculos;
use app\models\Queries\VehiculosQuery;

class VehiculoController {

    public function listar() {
        return VehiculosQuery::getAllVehiculos();
    }

    public function getLista() {
        return VehiculosQuery::getAllVehiculos();
    }

    public function disponibles() {
        return VehiculosQuery::getDisponibles();
    }

    public function crear($vehiculo) {
        return VehiculosQuery::insertarVehiculos($vehiculo);
    }

    public function eliminar($id) {
        return VehiculosQuery::eliminarVehiculos($id);
    }

    public function cambiarEstado($id, $estado) {
        return VehiculosQuery::actualizarEstado($id, $estado);
    }

    public function editar($id,$marca, $modelo, $anio, $categoria,$estado) {
    return VehiculosQuery::actualizarVehiculo($id, $marca, $modelo, $anio,$categoria,$estado);
    }
}