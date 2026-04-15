<?php
require_once("../models/config/connection_db.php");
require_once("../models/entities/Cliente.php");

use app\models\config\ConnectionDB;
use app\Entities\Cliente;

$db = new ConnectionDB();
$cliente = new Cliente();

$mensaje = "";

// CREAR CLIENTE
if (isset($_POST["crear"])) {
    $ok = $cliente->crear(
        $_POST["nombre"],
        $_POST["contacto"],
        $_POST["licencia"]
    );

    $mensaje = $ok ? "Cliente registrado" : "Error al registrar";
}

// LISTAR
$listado = $cliente->listar();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Clientes</title>
    <meta charset="UTF-8">
</head>
<body>

<h1>Gestión de Clientes 👤</h1>

<h3><?php echo $mensaje; ?></h3>

<!-- FORMULARIO -->
<form method="POST">

    <label>Nombre:</label>
    <input type="text" name="nombre" required>

    <br><br>

    <label>Contacto:</label>
    <input type="text" name="contacto" required>

    <br><br>

    <label>Licencia:</label>
    <input type="text" name="licencia" required>

    <br><br>

    <button type="submit" name="crear">Registrar</button>

</form>

<hr>

<h2>Lista de Clientes 📋</h2>

<table border="1" cellpadding="5">
<tr>
    <th>ID</th>
    <th>Nombre</th>
    <th>Contacto</th>
    <th>Licencia</th>
</tr>

<?php while($c = $listado->fetch_assoc()) { ?>
<tr>
    <td><?php echo $c["id"]; ?></td>
    <td><?php echo $c["nombre"]; ?></td>
    <td><?php echo $c["contacto"]; ?></td>
    <td><?php echo $c["licencia"]; ?></td>
</tr>
<?php } ?>

</table>

</body>
</html>
