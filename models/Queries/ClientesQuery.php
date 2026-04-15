<?php

namespace app\models\Queries; 

use app\models\config\ConnectionDB;
use app\models\entities\Cliente; 

class ClientesQuery {

    public static function getAllClientes() {
        $list = [];
        $connDb = new ConnectionDB();
        $sql = "SELECT id, nombre, documento, email FROM clientes";
        
        // ¡Usamos tu propio método execute()! Hace el prepare, execute y get_result de una vez.
        $result = $connDb->execute($sql);

        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $cliente = new Cliente(
                    $row['id'],
                    $row['nombre'],
                    $row['documento'], 
                    $row['email'],
                    "" // Licencia vacía
                );
                array_push($list, $cliente);
            }
            $result->free(); 
        }

        $connDb->close();
        return $list;
    }

    public static function insertarCliente($cliente) {
        $connDb = new ConnectionDB();
        $sql = "INSERT INTO clientes (nombre, documento, email) VALUES (?, ?, ?)";
        
        // Adaptamos los parámetros a la estructura que requiere tu método executeUpdateData
        $params = [
            'type' => 'sss',
            'datos' => [
                $cliente->get('nombre'),
                $cliente->get('telefono'), 
                $cliente->get('email')
            ]
        ];

        $res = $connDb->executeUpdateData($sql, $params);
        $connDb->close();
        return $res;
    }

    public static function eliminarCliente($id) {
        $connDb = new ConnectionDB();
        $sql = "DELETE FROM clientes WHERE id = ?";
        
        $params = [
            'type' => 'i',
            'datos' => [$id]
        ];
        
        $result = $connDb->executeUpdateData($sql, $params);
        $connDb->close();
        return $result;
    }
}