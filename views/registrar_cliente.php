<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registrar Cliente</title>
    <link rel="stylesheet" href="../public/style.css">
</head>
<body>

<div class="container fade-in">

    <h1>Registrar Cliente</h1>

    <div class="action-bar">
        <a href="opcionclientes.php" class="btn-back">← Volver</a>
    </div>

    <form action="guardar_cliente.php" method="POST" class="filter-form">

        <div class="filter-group">
            <label>Nombre</label>
            <input type="text" name="nombre" class="filter-input" required>
        </div>

        <div class="filter-group">
            <label>Teléfono</label>
            <input type="text" name="telefono" class="filter-input" required>
        </div>

        <div class="filter-group">
            <label>Correo</label>
            <input type="email" name="correo" class="filter-input" required>
        </div>

        <div class="filter-group">
            <label>Número Licencia</label>
            <input type="text" name="numero_licencia" class="filter-input" required>
        </div>

        <button type="submit" class="btn-add">
            Guardar Cliente
        </button>

    </form>

</div>

</body>
</html>