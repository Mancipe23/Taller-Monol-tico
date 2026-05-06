<?php

namespace app\models\Queries; 

use app\models\config\ConnectionDB;
use app\models\entities\cliente; 

class ClientesQuery {

    public static function getAllClientes() {
        $list = [];
        $connDb = new ConnectionDB();
        $sql = "SELECT id, nombre, documento, email FROM clientes";
        
        $result = $connDb->execute($sql);

        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $clientes = new cliente(
                    $row['id'],
                    $row['nombre'],
                    $row['documento'], 
                    $row['email'],
                    "" 
                );
                array_push($list, $clientes);
            }
            $result->free(); 
        }

        $connDb->close();
        return $list;
    }

    public static function insertarClientes($clientes) {
        $connDb = new ConnectionDB();
        $sql = "INSERT INTO clientes (nombre, documento, email) VALUES (?, ?, ?)";
        
        $params = [
            'type' => 'sss',
            'datos' => [
                $clientes->get('nombre'),
                $clientes->get('documento'), 
                $clientes->get('email')
            ]
        ];

        $res = $connDb->executeUpdateData($sql, $params);
        $connDb->close();
        return $res;
    }

    public static function eliminarClientes($id) {
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