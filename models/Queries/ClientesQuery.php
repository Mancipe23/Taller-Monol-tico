<?php

namespace app\models\Queries;

use app\models\config\ConnectionDB;
use app\models\entities\cliente;

class ClientesQuery {

    public static function getAllClientes() {

        $list = [];

        $connDb = new ConnectionDB();

        $sql = "SELECT id, nombre, telefono, correo, numero_licencia FROM clientes";

        $result = $connDb->execute($sql);

        if ($result) {

            while ($row = $result->fetch_assoc()) {

                $cliente = new cliente(
                    $row['id'],
                    $row['nombre'],
                    $row['telefono'],
                    $row['correo'],
                    $row['numero_licencia']
                );

                array_push($list, $cliente);
            }
        }

        $connDb->close();

        return $list;
    }

    public static function insertarClientes($cliente) {

        $connDb = new ConnectionDB();

        $sql = "INSERT INTO clientes 
        (nombre, telefono, correo, numero_licencia) 
        VALUES (?, ?, ?, ?)";

        $params = [
            'type' => 'ssss',
            'datos' => [
                $cliente->get('nombre'),
                $cliente->get('telefono'),
                $cliente->get('correo'),
                $cliente->get('numero_licencia')
            ]
        ];

        $result = $connDb->executeUpdateData($sql, $params);

        $connDb->close();

        return $result;
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