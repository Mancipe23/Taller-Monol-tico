<?php

namespace app\Entities;

use app\models\config\ConnectionDB;

class Cliente {

    private $db;

    public function __construct() {
        $this->db = new ConnectionDB();
    }

    public function crear($nombre, $contacto, $licencia) {

        $sql = "INSERT INTO clientes (nombre, contacto, licencia)
                VALUES (?, ?, ?)";

        return $this->db->executeUpdataData($sql, [
            "type" => "sss",
            "datos" => [$nombre, $contacto, $licencia]
        ]);
    }

    public function listar() {
        $sql = "SELECT * FROM clientes";
        return $this->db->execute($sql);
    }
}
