<?php

namespace app\models\queries;

use app\models\config\ConnectionDB;
use app\models\entities\reservas;

class ReservasQuery
{
     static function getAllReservas()
    {
        $sql = "select * from reserva";
        $connDb = new ConnectionDB();
        $result = $connDb->execute($sql);
        $list = [];
        while ($row = $result->fetch_assoc()) {
            $reservas = new Reservas($row['id'],$row['cliente_id'], $row['vehiculo_id'], $row['fecha_inicio'], $row['fecha_fin'], $row['estado']);
            array_push($list, $reservas);
        }
        $connDb->close();
        return $list;
    }
        static function createReserva($entity)
    {
        $sql = "insert into reservas (cliente_id,vehiculo_id,fecha_inicio,fecha_fin,estado) values (?,?,?,?,?)";
        $connDb = new ConnectionDB();
        $result = $connDb->executeUpdateData($sql, [
            "type" => "iisss",
            "datos" => [$entity->get('cliente_id'),$entity->get('vehiculo_id'),$entity->get('fecha_inicio'), $entity->get('fecha_fin'),$entity->get('estado'),]
        ]);
        $connDb->close();
        return $result;
    }

 }
 ?>