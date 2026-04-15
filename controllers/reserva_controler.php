<?php

namespace app\controllers;

use app\models\queries\ReservasQuery;
use app\models\entities\Reservas;

class ReservasController{
    public function gestionarPeticion()
    {
        if (isset($_POST["crear"])) {
            $nuevaReserva = new Reservas(
                0, 
                $_POST["cliente"], 
                $_POST["vehiculo"], 
                $_POST["inicio"], 
                $_POST["fin"], 
                'activa'
            );
            $resultado = ReservasQuery::createReserva($nuevaReserva);

            if ($resultado) {
                return "Reserva creada exitosamente.";
            } else {
                return "Error al crear la reserva.";
            }
        }
    }
}
