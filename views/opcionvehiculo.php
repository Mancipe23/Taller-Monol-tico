<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RentCar Pro - Vehículos</title>
    <!-- Importante: Esta ruta sube un nivel para encontrar la carpeta public -->
    <link rel="stylesheet" href="../public/style.css">
</head>
<body class="fade-in">

    <div class="container">
        <header>
            <h1>Gestión de Flota</h1>
            <p class="subtitle">Visualiza y administra tus vehículos disponibles</p>
        </header>

        <div class="action-bar">
            <a href="inicio.php" class="btn-back">← Volver</a>
            <button class="btn-add">Registrar Vehículo</button>
        </div>

        <div class="table-responsive">
            <table class="main-table">
                <thead>
                    <tr>
                        <th>Placa</th>
                        <th>Modelo</th>
                        <th>Categoría</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>HFX-982</td>
                        <td>Mazda 3</td>
                        <td>Sedán</td>
                        <td><span class="tag available">Disponible</span></td>
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