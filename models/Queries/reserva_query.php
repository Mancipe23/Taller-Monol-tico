<?php

namespace app\models\queries;

use app\models\config\ConnectionDB;
use app\models\entities\reservas;

class ReservasQuery
{
     static function getAllReservas()
    {
        $sql = "select * from reservas";
        $connDb = new ConnectionDB();
        $result = $connDb->execute($sql);
        $list = [];
        while ($row = $result->fetch_assoc()) {
            $reservas = new reservas($row['id'],$row['cliente_id'], $row['vehiculo_id'], $row['fecha_inicio'], $row['fecha_fin'], $row['estado']);
            array_push($list, $reservas);
        }
        $connDb->close();
        return $list;
    }
        static function createReserva($entity)
    {
        $sql = "insert into reservas (cliente_id,vehiculo_id,fecha_inicio,fecha_fin,estado) values (?,?,?,?,?)";
        $connDb = new ConnectionDB();
        $result = $connDb->executeUpdateData($sql, [
            "type" => "iisss",
            "datos" => [$entity->get('cliente_id'),$entity->get('vehiculo_id'),$entity->get('fecha_inicio'), $entity->get('fecha_fin'),$entity->get('estado'),]
        ]);
        $connDb->close();
        return $result;
    }
    static function actualizarEstado($id, $nuevoEstado)
{
    $sql = "UPDATE reservas SET estado = ? WHERE id = ?";
    $connDb = new ConnectionDB();
    $result = $connDb->executeUpdateData($sql, [
        "type" => "si", 
        "datos" => [
            $nuevoEstado, 
            $id
        ]
    ]);
    $connDb->close();
    return $result;
}
static function getHistorial($cliente_id = null, $vehiculos_id = null)
{
    $sql = "SELECT r.*, c.nombre AS cliente_nombre, v.marca, v.modelo 
            FROM reservas r
            JOIN cliente c ON r.cliente_id = c.id
            JOIN vehiculos v ON r.vehiculos_id = v.id
            WHERE 1=1";

    if ($cliente_id != null) {
        $sql .= " AND r.cliente_id = " . intval($cliente_id);
    }

    if ($vehiculos_id != null) {
        $sql .= " AND r.vehiculo_id = " . intval($vehiculos_id);
    }

    $sql .= " ORDER BY r.fecha_inicio DESC";

    $connDb = new ConnectionDB();
    
    $result = $connDb->execute($sql);

    $list = [];
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $obj = new Reservas(
                $row['id'], 
                $row['cliente_id'], 
                $row['vehiculos_id'], 
                $row['fecha_inicio'], 
                $row['fecha_fin'], 
                $row['estado']
            );
            
            $obj->set('cliente_nombre', $row['cliente_nombre']);
            $obj->set('vehiculos_info', $row['marca'] . " " . $row['modelo']);
            
            $list[] = $obj;
        }
    }

    $connDb->close();
    return $list; 
}
static function tieneReservasActivasPorVehiculo($vehiculo_id)
    {
        $sql    = "SELECT COUNT(*) as total FROM reservas 
                WHERE vehiculo_id = ? AND estado = 'activa'";
        $connDb = new ConnectionDB();
        $result = $connDb->executeQuery($sql, [
            'type'  => 'i',
            'datos' => [$vehiculo_id]
        ]);
        $row = $result->fetch_assoc();
        $connDb->close();
        return $row['total'] > 0;
    }

    static function ReservasActivasClientes($clientes_id)
    {
        $sql    = "SELECT COUNT(*) as total FROM reservas 
                WHERE cliente_id = ? AND estado = 'activa'";
        $connDb = new ConnectionDB();
        $result = $connDb->executeQuery($sql, [
            'type'  => 'i',
            'datos' => [$clientes_id]
        ]);
        $row = $result->fetch_assoc();
        $connDb->close();
        return $row['total'] > 0;
    }
     static function ReservasActivasVehiculo($vehiculo_id)
    {
        $sql    = "SELECT COUNT(*) as total FROM reservas 
                WHERE vehiculo_id = ? AND estado = 'activa'";
        $connDb = new ConnectionDB();
        $result = $connDb->executeQuery($sql, [
            'type'  => 'i',
            'datos' => [$vehiculo_id]
        ]);
        $row = $result->fetch_assoc();
        $connDb->close();
        return $row['total'] > 0;
    }
        static function getReservasActivas()
    {
        $sql = "SELECT r.*, c.nombre AS clientes_nombre,
                    v.marca, v.modelo
                FROM reservas r
                JOIN clientes c ON r.cliente_id = c.id
                JOIN vehiculo v ON r.vehiculo_id = v.id
                WHERE r.estado = 'activa'";
        $connDb = new ConnectionDB();
        $result = $connDb->execute($sql);
        $list   = [];
        while ($row = $result->fetch_assoc()) {
            $reserva = new Reservas(
                $row['id'], $row['clientes_id'], $row['vehiculo_id'],
                $row['fecha_inicio'], $row['fecha_fin'], $row['estado']
            );
            $reserva->set('clientes_nombre', $row['clientes_nombre']);
            $reserva->set('vehiculo_info',  $row['marca'] . ' ' . $row['modelo']);
            $list[] = $reserva;
        }
        $connDb->close();
        return $list;
    }
    static function getDisponibles() {
    $sql = "SELECT * FROM vehiculos WHERE estado = 'disponible'";

}

}
 
 ?>