<?php
namespace app\models\Queries;

use app\models\config\ConnectionDB;
use app\models\entities\Vehiculos;

class VehiculosQuery
{
    static function getAllVehiculos()
    {
        $sql = "SELECT id, marca, modelo, anio, categoria, estado  FROM vehiculos";
        $connDb = new ConnectionDB();
        $result = $connDb->execute($sql);
        $list = [];
         if ($result) {
            while ($row = $result->fetch_assoc()) {
            $vehiculos = new Vehiculos(
                $row['id'], 
                $row['marca'],  
                $row['modelo'], 
                $row['anio'], 
                $row['categoria'], 
                $row['estado']
            );
            array_push($list, $vehiculos);
        }
        $connDb->close();
        return $list;
    }
}

    public static function insertarVehiculos($vehiculos) {
    $connDb = new ConnectionDB();
    $sql = "INSERT INTO vehiculos (marca, modelo, anio, categoria, estado) 
            VALUES (?, ?, ?, ?, ?)";
             $params = [
                 'type' => 'siiss',
            'datos' => [
        $vehiculos->get('marca'), 
        $vehiculos->get('modelo'), 
        $vehiculos->get('anio'), 
        $vehiculos->get('categoria'), 
        $vehiculos->get('estado')
      ]
  ];
    
    $result = $connDb->executeUpdateData($sql, $params);
    $connDb->close();
    return $result;
    }

    public static function eliminarVehiculos($id) {
    $connDb = new ConnectionDB();
    $sql = "DELETE FROM vehiculos WHERE id = ?";
    $result = $connDb->executeUpdateData($sql, [
            'type'  => 'i',
            'datos' => [$id]
        ]);
    $connDb->close();
    return $result;
    }
        static function getDisponibles() {
        $sql = "SELECT id, marca, modelo, anio, categoria, estado FROM vehiculos WHERE estado = 'disponible'";
        $connDb = new ConnectionDB();
        $result = $connDb->execute($sql);
        $list = [];
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $vehiculo = new Vehiculos(
                    $row['id'], 
                    $row['marca'], 
                    $row['modelo'], 
                    $row['anio'], 
                    $row['categoria'],
                    $row['estado']
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
            "type" => "si", 
            "datos" => [$nuevoEstado, $id]
        ]);
        $connDb->close();
        return $result;
    }
}