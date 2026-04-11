<?php

namespace app\models\queries;

use app\models\config\ConnectionDB;
use app\models\entities\reservas;

class reservaQuery
{
    public function crear($id_cliente, $id_vehiculo, $inicio, $fin) {

        // Verificar estado del vehículo
        $sql = "SELECT estado FROM vehiculos WHERE id = ?";
        $result = $this->db->executeUpdataData($sql, [
            "type" => "i",
            "datos" => [$id_vehiculo]
        ]);

        $vehiculo = $result->fetch_assoc();

        if ($vehiculo["estado"] != "disponible") {
            return "Vehículo no disponible";
        }

        // Insertar reserva
        $sql = "INSERT INTO reservas (id_cliente, id_vehiculo, fecha_inicio, fecha_fin, estado)
                VALUES (?, ?, ?, ?, 'activa')";

        $this->db->executeUpdataData($sql, [
            "type" => "iiss",
            "datos" => [$id_cliente, $id_vehiculo, $inicio, $fin]
        ]);

        // Cambiar estado vehículo
        $sql = "UPDATE vehiculos SET estado='alquilado' WHERE id=?";
        $this->db->executeUpdataData($sql, [
            "type" => "i",
            "datos" => [$id_vehiculo]
        ]);

        return "Reserva creada";
    }

    public function devolver($id_reserva) {

        $sql = "SELECT id_vehiculo FROM reservas WHERE id = ?";
        $result = $this->db->executeUpdataData($sql, [
            "type" => "i",
            "datos" => [$id_reserva]
        ]);

        $data = $result->fetch_assoc();
        $id_vehiculo = $data["id_vehiculo"];

        // Finalizar reserva
        $sql = "UPDATE reservas SET estado='finalizada' WHERE id=?";
        $this->db->executeUpdataData($sql, [
            "type" => "i",
            "datos" => [$id_reserva]
        ]);

        // Liberar vehículo
        $sql = "UPDATE vehiculos SET estado='disponible' WHERE id=?";
        $this->db->executeUpdataData($sql, [
            "type" => "i",
            "datos" => [$id_vehiculo]
        ]);

        return "Vehículo devuelto";
    }

    public function listar() {
        $sql = "
            SELECT r.id, c.nombre, v.marca, v.modelo, r.fecha_inicio, r.fecha_fin, r.estado
            FROM reservas r
            JOIN clientes c ON r.id_cliente = c.id
            JOIN vehiculos v ON r.id_vehiculo = v.id
        ";

        return $this->db->execute($sql);
    }
}