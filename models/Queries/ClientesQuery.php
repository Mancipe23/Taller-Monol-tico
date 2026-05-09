<?php
namespace app\models\Queries;

use app\models\config\ConnectionDB;
use app\models\entities\cliente;

require_once __DIR__ . '/../entities/cliente.php';

class ClientesQuery {

    public static function getAllClientes() {
        $list   = [];
        $connDb = new ConnectionDB();
        $sql    = "SELECT id, documento, nombre, telefono, email FROM clientes";
        $result = $connDb->execute($sql);

        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $cliente = new cliente(
                    $row['id'],
                    $row['documento'],
                    $row['nombre'],
                    $row['telefono'],
                    $row['email']
                );
                array_push($list, $cliente);
            }
        }

        $connDb->close();
        return $list;
    }

    public static function insertarClientes($cliente) {
        $connDb = new ConnectionDB();
        $sql    = "INSERT INTO clientes (documento, nombre, telefono, email) 
                   VALUES (?, ?, ?, ?)";
        $params = [
            'type'  => 'ssss',
            'datos' => [
                $cliente->get('documento'),
                $cliente->get('nombre'),
                $cliente->get('telefono'),
                $cliente->get('email')
            ]
        ];

        $result = $connDb->executeUpdateData($sql, $params);
        $connDb->close();
        return $result;
    }

    public static function eliminarClientes($id) {
        $connDb = new ConnectionDB();
        $sql    = "DELETE FROM clientes WHERE id = ?";
        $params = [
            'type'  => 'i',
            'datos' => [$id]
        ];

        $result = $connDb->executeUpdateData($sql, $params);
        $connDb->close();
        return $result;
    }
}