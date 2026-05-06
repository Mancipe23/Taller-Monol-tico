<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RentCar Pro - Clientes</title>
    <link rel="stylesheet" href="../public/style.css">
</head>
<body class="fade-in">

    <div class="container">
        <header>
            <h1>Gestión de Clientes</h1>
            <p class="subtitle">Administra la base de datos de conductores registrados</p>
        </header>

        <div class="action-bar">
            <a href="inicio.php" class="btn-back">← Volver</a>
            <button class="btn-add">Registrar Cliente</button>
        </div>

        <div class="table-responsive">
            <table class="main-table">
                <thead>
                    <tr>
                        <th>Cédula / ID</th>
                        <th>Nombre Completo</th>
                        <th>Teléfono</th>
                        <th>Correo Electrónico</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Datos de ejemplo -->
                    <tr>
                        <td>1002345678</td>
                        <td>Juan Pérez</td>
                        <td>310 123 4567</td>
                        <td>juan.perez@email.com</td>
                        <td>
                            <button class="btn-icon">✏️</button>
                            <button class="btn-icon delete">🗑️</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>