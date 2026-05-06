<?php

namespace app\models\queries;

use app\models\config\ConnectionDB;
use app\models\entities\reservas; 

class ReservasQuery
{
    static function getAllReservas()
    {
        // Usamos alias para que coincidan con los nombres que espera el constructor de la entidad
        $sql = "SELECT id_reserva AS id, id_cliente AS cliente_id, id_vehiculo AS vehiculo_id, 
                       fecha_inicio, fecha_fin, estado_reserva AS estado 
                FROM reservas";
        
        $connDb = new ConnectionDB();
        $result = $connDb->execute($sql);
        $list = [];
        
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $reserva = new reservas($row['id'], $row['cliente_id'], $row['vehiculo_id'], 
                                        $row['fecha_inicio'], $row['fecha_fin'], $row['estado']);
                array_push($list, $reserva);
            }
        }
        $connDb->close();
        return $list;
    }

    static function createReserva($entity)
    {
        $sql = "INSERT INTO reservas (id_cliente, id_vehiculo, fecha_inicio, fecha_fin, estado_reserva) VALUES (?,?,?,?,?)";
        $connDb = new ConnectionDB();
        $result = $connDb->executeUpdateData($sql, [
            "type" => "iisss",
            "datos" => [
                $entity->get('cliente_id'),
                $entity->get('vehiculo_id'),
                $entity->get('fecha_inicio'), 
                $entity->get('fecha_fin'),
                $entity->get('estado')
            ]
        ]);
        $connDb->close();
        return $result;
    }

    static function actualizarEstado($id, $nuevoEstado)
    {
        $sql = "UPDATE reservas SET estado_reserva = ? WHERE id_reserva = ?";
        $connDb = new ConnectionDB();
        $result = $connDb->executeUpdateData($sql, [
            "type" => "si", 
            "datos" => [$nuevoEstado, $id]
        ]);
        $connDb->close();
        return $result;
    }

    static function getHistorial($cliente_id = null, $vehiculo_id = null)
    {
        $sql = "SELECT r.id_reserva AS id, r.id_cliente AS cliente_id, r.id_vehiculo AS vehiculo_id, 
                       r.fecha_inicio, r.fecha_fin, r.estado_reserva AS estado, 
                       c.nombre AS cliente_nombre, v.modelo 
                FROM reservas r
                JOIN clientes c ON r.id_cliente = c.id_cliente
                JOIN vehiculos v ON r.id_vehiculo = v.id_vehiculo
                WHERE 1=1";
        
        if ($cliente_id != null) {
            $sql .= " AND r.id_cliente = " . intval($cliente_id);
        }
        if ($vehiculo_id != null) {
            $sql .= " AND r.id_vehiculo = " . intval($vehiculo_id);
        }
        $sql .= " ORDER BY r.fecha_inicio DESC";
        
        $connDb = new ConnectionDB();
        $result = $connDb->execute($sql);
        $list = [];
        
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $obj = new reservas($row['id'], $row['cliente_id'], $row['vehiculo_id'], 
                                   $row['fecha_inicio'], $row['fecha_fin'], $row['estado']);
                $obj->set('cliente_nombre', $row['cliente_nombre']);
                // Nota: Quitamos 'marca' porque no estaba en nuestro nuevo SQL de vehiculos
                $obj->set('vehiculo_info', $row['modelo']); 
                $list[] = $obj;
            }
        }
        $connDb->close();
        return $list; 
    }

    static function ReservasActivasClientes($cliente_id)
    {
        $sql = "SELECT COUNT(*) as total FROM reservas WHERE id_cliente = ? AND estado_reserva = 'Activa'";
        $connDb = new ConnectionDB();
        $result = $connDb->executeQuery($sql, [
            'type'  => 'i',
            'datos' => [$cliente_id]
        ]);
        $row = $result->fetch_assoc();
        $connDb->close();
        return $row['total'] > 0;
    }

    static function ReservasActivasVehiculo($vehiculo_id)
    {
        $sql = "SELECT COUNT(*) as total FROM reservas WHERE id_vehiculo = ? AND estado_reserva = 'Activa'";
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
        $sql = "SELECT r.id_reserva AS id, r.id_cliente AS cliente_id, r.id_vehiculo AS vehiculo_id, 
                       r.fecha_inicio, r.fecha_fin, r.estado_reserva AS estado, 
                       c.nombre AS cliente_nombre, v.modelo
                FROM reservas r
                JOIN clientes c ON r.id_cliente = c.id_cliente
                JOIN vehiculos v ON r.id_vehiculo = v.id_vehiculo
                WHERE r.estado_reserva = 'Activa'";
        
        $connDb = new ConnectionDB();
        $result = $connDb->execute($sql);
        $list = [];
        while ($row = $result->fetch_assoc()) {
            $reserva = new reservas($row['id'], $row['cliente_id'], $row['vehiculo_id'], 
                                    $row['fecha_inicio'], $row['fecha_fin'], $row['estado']);
            $reserva->set('cliente_nombre', $row['cliente_nombre']);
            $reserva->set('vehiculo_info',  $row['modelo']);
            $list[] = $reserva;
        }
        $connDb->close();
        return $list;
    }
}