<?php
require_once("../src/models_config/connection_db.php");
require_once("../src/Entities/Reserva.php");

use app\models\config\ConnectionDB;
use app\Entities\Reserva;

// Instancias
$db = new ConnectionDB();
$reserva = new Reserva();

$mensaje = "";

// CREAR RESERVA
if (isset($_POST["crear"])) {
    $mensaje = $reserva->crear(
        $_POST["cliente"],
        $_POST["vehiculo"],
        $_POST["inicio"],
        $_POST["fin"]
    );
}

// DEVOLVER VEHÍCULO
if (isset($_POST["devolver"])) {
    $mensaje = $reserva->devolver($_POST["id_reserva"]);
}

// OBTENER DATOS
$clientes = $db->execute("SELECT * FROM clientes");
$vehiculos = $db->execute("SELECT * FROM vehiculos WHERE estado='disponible'");
$listado = $reserva->listar();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Reservas</title>
    <meta charset="UTF-8">
</head>
<body>

<h1>Gestión de Reservas 🚗</h1>

<h3><?php echo $mensaje; ?></h3>

<!-- FORMULARIO -->
<form method="POST">

    <label>Cliente:</label>
    <select name="cliente" required>
        <option value="">Seleccione</option>
        <?php while($c = $clientes->fetch_assoc()) { ?>
            <option value="<?php echo $c["id"]; ?>">
                <?php echo $c["nombre"]; ?>
            </option>
        <?php } ?>
    </select>

    <br><br>

    <label>Vehículo:</label>
    <select name="vehiculo" required>
        <option value="">Seleccione</option>
        <?php while($v = $vehiculos->fetch_assoc()) { ?>
            <option value="<?php echo $v["id"]; ?>">
                <?php echo $v["marca"] . " " . $v["modelo"]; ?>
            </option>
        <?php } ?>
    </select>

    <br><br>

    <label>Fecha inicio:</label>
    <input type="date" name="inicio" required>

    <br><br>

    <label>Fecha fin:</label>
    <input type="date" name="fin" required>

    <br><br>

    <button type="submit" name="crear">Reservar</button>

</form>

<hr>

<h2>Historial de Reservas 📋</h2>

<table border="1" cellpadding="5">
<tr>
    <th>ID</th>
    <th>Cliente</th>
    <th>Vehículo</th>
    <th>Inicio</th>
    <th>Fin</th>
    <th>Estado</th>
    <th>Acción</th>
</tr>

<?php while($r = $listado->fetch_assoc()) { ?>
<tr>
    <td><?php echo $r["id"]; ?></td>
    <td><?php echo $r["nombre"]; ?></td>
    <td><?php echo $r["marca"] . " " . $r["modelo"]; ?></td>
    <td><?php echo $r["fecha_inicio"]; ?></td>
    <td><?php echo $r["fecha_fin"]; ?></td>
    <td><?php echo $r["estado"]; ?></td>
    <td>
        <?php if ($r["estado"] == "activa") { ?>
            <form method="POST" style="display:inline;">
                <input type="hidden" name="id_reserva" value="<?php echo $r["id"]; ?>">
                <button type="submit" name="devolver">Devolver</button>
            </form>
        <?php } else { ?>
            ✔
        <?php } ?>
    </td>
</tr>
<?php } ?>

</table>

</body>
</html>
