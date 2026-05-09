<?php
namespace app\models\Queries;

use app\models\config\ConnectionDB;
use app\models\entities\Vehiculos;

require_once __DIR__ . '/../entities/Vehiculos.php';

class VehiculosQuery
{
    static function getAllVehiculos()
    {
        $sql = "SELECT id, marca, placa, modelo, categoria, estado, precio_dia FROM vehiculos";
        $connDb = new ConnectionDB();
        $result = $connDb->execute($sql);
        $list = [];

        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $vehiculos = new Vehiculos(
                    $row['id'],
                    $row['marca'],
                    $row['placa'],
                    $row['modelo'],
                    $row['categoria'],
                    $row['estado'],
                    $row['precio_dia']
                );
                array_push($list, $vehiculos);
            }
        }

        $connDb->close();
        return $list;
    }

    public static function insertarVehiculos($vehiculos)
    {
        $connDb = new ConnectionDB();
        $sql = "INSERT INTO vehiculos (marca, placa, modelo, categoria, estado, precio_dia) 
                VALUES (?, ?, ?, ?, ?, ?)";
        $params = [
            'type'  => 'sssssd',
            'datos' => [
                $vehiculos->get('marca'),
                $vehiculos->get('placa'),
                $vehiculos->get('modelo'),
                $vehiculos->get('categoria'),
                $vehiculos->get('estado'),
                $vehiculos->get('precio_dia')
            ]
        ];

        $result = $connDb->executeUpdateData($sql, $params);
        $connDb->close();
        return $result;
    }

    public static function eliminarVehiculos($id)
    {
        $connDb = new ConnectionDB();
        $sql = "DELETE FROM vehiculos WHERE id = ?";
        $result = $connDb->executeUpdateData($sql, [
            'type'  => 'i',
            'datos' => [$id]
        ]);
        $connDb->close();
        return $result;
    }

    static function getDisponibles()
    {
        $sql = "SELECT id, marca, placa, modelo, categoria, estado, precio_dia 
                FROM vehiculos WHERE estado = 'Disponible'";
        $connDb = new ConnectionDB();
        $result = $connDb->execute($sql);
        $list = [];

        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $vehiculo = new Vehiculos(
                    $row['id'],
                    $row['marca'],
                    $row['placa'],
                    $row['modelo'],
                    $row['categoria'],
                    $row['estado'],
                    $row['precio_dia']
                );
                $list[] = $vehiculo;
            }
        }

        $connDb->close();
        return $list;
    }

    static function actualizarEstado($id, $nuevoEstado)
    {
        $sql = "UPDATE vehiculos SET estado = ? WHERE id = ?";
        $connDb = new ConnectionDB();
        $result = $connDb->executeUpdateData($sql, [
            'type'  => 'si',
            'datos' => [$nuevoEstado, $id]
        ]);
        $connDb->close();
        return $result;
    }
}