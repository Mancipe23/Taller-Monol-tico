<?php
namespace app\models\Queries;

use app\models\config\ConnectionDB;
use app\models\entities\Vehiculo;

class VehiculosQuery
{
    static function getAllVehiculos()
    {
        $sql = "SELECT * FROM Vehiculos";
        $connDb = new ConnectionDB();
        $result = $connDb->execute($sql);
        $list = [];
        
        while ($row = $result->fetch_assoc()) {
            // Se crea el objeto Vehiculo usando el constructor de la entidad
            $vehiculo = new Vehiculo(
                $row['id'], 
                $row['marca'], 
                $row['modelo'], 
                $row['anio'], 
                $row['categoria'], 
                $row['estado']
            );
            array_push($list, $vehiculo);
        }
        $connDb->close();
        return $list;
    }

    public static function insertarVehiculo($vehiculo) {
    $connDb = new ConnectionDB();
    $sql = "INSERT INTO vehiculos (marca, modelo, anio, categoria, estado) 
            VALUES (?, ?, ?, ?, ?)";
    
    // Usamos sentencias preparadas por seguridad (evita inyección SQL)
    $stmt = $connDb->executePreparedStatement($sql);
    $stmt->bind_param("ssiss", 
        $vehiculo->get('marca'), 
        $vehiculo->get('modelo'), 
        $vehiculo->get('anio'), 
        $vehiculo->get('categoria'), 
        $vehiculo->get('estado')
    );
    
    $result = $stmt->execute();
    $connDb->close();
    return $result;
    }

    public static function eliminarVehiculo($id) {
    $connDb = new ConnectionDB();
    $sql = "DELETE FROM vehiculos WHERE id = ?";
    
    $stmt = $connDb->executePreparedStatement($sql);
    $stmt->bind_param("i", $id); // "i" porque el ID es un entero
    
    $result = $stmt->execute();
    $connDb->close();
    return $result;
    }
}