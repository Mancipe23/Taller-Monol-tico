<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Vehículo - RentCar Pro</title>
    <link rel="stylesheet" href="../public/style.css">
</head>
<body class="fade-in">
<div class="container">
    <header>
        <h1>Registrar Nuevo Vehículo</h1>
        <p class="subtitle">Ingresa los datos técnicos de la nueva unidad</p>
    </header>

    <div class="action-bar">
        <a href="opcionvehiculo.php" class="btn-back">← Cancelar</a>
    </div>

    <div class="table-responsive">
        <form action="../controllers/registrar_vehiculo_proceso.php" method="POST" class="filter-form">

            <div class="filter-group full-width">
                <label>Marca del Vehículo</label>
                <input type="text" name="marca" class="filter-input" placeholder="Ej: Toyota" required>
            </div>

            <div class="filter-group full-width">
                <label>Placa</label>
                <input type="text" name="placa" class="filter-input" placeholder="Ej: ABC-123" required>
            </div>

            <div class="filter-group full-width">
                <label>Modelo / Línea</label>
                <input type="text" name="modelo" class="filter-input" placeholder="Ej: Corolla" required>
            </div>

            <div class="filter-group full-width">
                <label>Categoría</label>
                <select name="categoria" class="filter-input">
                    <option value="Sedán">Sedán</option>
                    <option value="SUV">SUV</option>
                    <option value="Camioneta">Camioneta</option>
                    <option value="Deportivo">Deportivo</option>
                </select>
            </div>

            <div class="filter-group full-width">
                <label>Precio por Día ($)</label>
                <input type="number" name="precio_dia" class="filter-input" placeholder="Ej: 150000" step="0.01" min="0" required>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-add">➕ Guardar Vehículo</button>
            </div>

        </form>
    </div>
</div>
</body>
</html>