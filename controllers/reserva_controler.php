<?php
namespace app\controllers;

use app\models\queries\ReservasQuery;
use app\models\queries\VehiculosQuery; 
use app\models\entities\Reservas;

class ReservasController {
    public function listarTodas() {
        return ReservasQuery::getAllReservas();
    }
    public function crear($cliente_id, $vehiculo_id, $fecha_inicio, $fecha_fin) {
        if (ReservasQuery::ReservasActivasVehiculo($vehiculo_id)) {
            return ["error" => "Vehículo ocupado"];
        }
        if (ReservasQuery::ReservasActivasClientes($cliente_id)) {
            return ["error" => "Cliente tiene reserva activa"];
        }
        $reserva = new Reservas(0, $cliente_id, $vehiculo_id, $fecha_inicio, $fecha_fin, 'activa');
        $resultado = ReservasQuery::createReserva($reserva);
        return $resultado ? ["success" => "Reserva creada"] : ["error" => "Fallo creación"];
    }
    public function historial($cliente_id = null, $vehiculo_id = null) {
        return ReservasQuery::getHistorial($cliente_id, $vehiculo_id);
    }
    public function completar($id, $vehiculo_id) {
        $resultado = ReservasQuery::actualizarEstado($id, 'completada');
        if ($resultado) {
            VehiculosQuery::actualizarEstado($vehiculo_id, 'disponible');
        }
        return $resultado;
    }
    public function cancelar($id, $vehiculo_id)
{
    $resultado = ReservasQuery::actualizarEstado($id, 'cancelada');
    if ($resultado) {
        VehiculosQuery::actualizarEstado($vehiculo_id, 'disponible');
    }
    return $resultado;
}
}