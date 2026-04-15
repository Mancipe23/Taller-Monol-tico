<?php
/**
 * GESTOR DE ALQUILER DE VEHÍCULOS
 * Archivo: index.php
 */

// --- CONFIGURACIÓN DE ERRORES ---
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// --- IMPORTACIONES ---
require_once 'models/config/connection_db.php';
require_once 'models/config/model_base.php';
require_once 'models/entities/vehiculo.php';
require_once 'models/Queries/VehiculosQuery.php';

use app\models\config\ConnectionDB;
use app\models\Queries\VehiculosQuery;

// --- LÓGICA DE DATOS ---
$connDb = new ConnectionDB();
$vehiculos = VehiculosQuery::getAllVehiculos();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestor de Alquiler de Vehículos</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm mb-4">
    <div class="container">
        <a class="navbar-brand fw-bold" href="index.php">
            <i class="bi bi-car-front-fill me-2"></i>RentCar Pro
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link active" href="index.php">
                        <i class="bi bi-car-front me-1"></i> Vehículos
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="views/clientes.php">
                        <i class="bi bi-people me-1"></i> Clientes
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="views/reservas.php">
                        <i class="bi bi-calendar-check me-1"></i> Reservas
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

    <div class="container mt-5">
        <h1 class="text-center mb-4 fw-bold">Gestor de Alquiler de Vehículos</h1>

        <?php if(isset($_GET['mensaje'])): ?>
            <script>
                // Mostramos un SweetAlert de éxito según el mensaje
                const mensaje = "<?php echo $_GET['mensaje']; ?>";
                Swal.fire({
                    icon: 'success',
                    title: mensaje === 'guardado' ? '¡Registrado!' : '¡Eliminado!',
                    text: mensaje === 'guardado' ? 'El vehículo se guardó correctamente.' : 'El vehículo ha sido borrado.',
                    timer: 3000,
                    showConfirmButton: false
                });
            </script>
        <?php endif; ?>
        
        <div class="card shadow-sm border-0">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center py-3">
                <h5 class="mb-0"><i class="bi bi-car-front-fill me-2"></i>Vehículos Disponibles</h5>
                <button type="button" class="btn btn-success btn-sm shadow-sm" data-bs-toggle="modal" data-bs-target="#modalVehiculo">
                    <i class="bi bi-plus-circle me-1"></i> Agregar Vehículo
                </button>
            </div>
            
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="ps-4">Marca</th>
                                <th>Modelo</th>
                                <th>Año</th>
                                <th>Estado</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($vehiculos as $v): ?>
                                <tr>
                                    <td class="ps-4 fw-medium"><?php echo $v->get('marca'); ?></td>
                                    <td><?php echo $v->get('modelo'); ?></td>
                                    <td><span class="text-muted"><?php echo $v->get('anio'); ?></span></td>
                                    <td>
                                        <?php $colorBadge = ($v->get('estado') == 'Disponible') ? 'bg-success' : 'bg-danger'; ?>
                                        <span class="badge rounded-pill <?php echo $colorBadge; ?>">
                                            <?php echo $v->get('estado'); ?>
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <form action="controllers/VehiculoController.php" method="POST" class="form-eliminar">
                                            <input type="hidden" name="id" value="<?php echo $v->get('id'); ?>">
                                            <input type="hidden" name="accion" value="eliminar">
                                            <button type="button" class="btn btn-outline-danger btn-sm btn-confirmar">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            
                            <?php if(empty($vehiculos)): ?>
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-5">
                                        <i class="bi bi-info-circle fs-4 d-block mb-2"></i>
                                        No hay vehículos registrados actualmente.
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalVehiculo" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <form action="controllers/VehiculoController.php" method="POST" class="modal-content border-0 shadow">
                <div class="modal-header bg-light">
                    <h5 class="modal-title fw-bold">Registrar Nuevo Vehículo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                             <label class="form-label text-secondary small fw-bold">Marca</label>
                            <input type="text" name="marca" class="form-control" placeholder="Ej: Toyota" required>
                        </div>
                        <div class="col-md-6">
                        <label class="form-label text-secondary small fw-bold">Modelo</label>
                        <input type="text" name="modelo" class="form-control" placeholder="Ej: Corolla" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label text-secondary small fw-bold">Año</label>
                            <input type="number" name="anio" class="form-control" value="<?php echo date('Y'); ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label text-secondary small fw-bold">Categoría</label>
                            <select name="categoria" class="form-select">
                                <option value="Sedan">Sedán</option>
                                <option value="Suv">SUV</option>
                                <option value="Camioneta">Camioneta</option>
                                <option value="Lujo">Lujo</option>
                            </select>
                        </div>
                    </div>
                    <input type="hidden" name="estado" value="Disponible">
                </div>
                <div class="modal-footer bg-light border-0">
                    <button type="button" class="btn btn-link text-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" name="accion" value="crear" class="btn btn-primary px-4">Guardar Vehículo</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        /**
         * Manejo pro de la confirmación de borrado con SweetAlert2
         */
        document.querySelectorAll('.btn-confirmar').forEach(btn => {
            btn.addEventListener('click', function() {
                const form = this.closest('.form-eliminar');
                
                Swal.fire({
                    title: '¿Estás seguro?',
                    text: "Esta acción no se puede deshacer.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#adb5bd',
                    confirmButtonText: 'Sí, eliminarlo',
                    cancelButtonText: 'Cancelar',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>

</body>
</html>
