<?php
namespace app\models\Queries;

use app\models\config\ConnectionDB;
use app\models\entities\Vehiculos;

class VehiculosQuery
{
    static function getAllVehiculos()
    {
        $sql = "SELECT * FROM Vehiculos";
        $connDb = new ConnectionDB();
        $result = $connDb->execute($sql);
        $list = [];
        
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
}