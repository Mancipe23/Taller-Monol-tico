<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
require_once '../models/config/connection_db.php';
require_once '../models/config/model_base.php';
require_once '../models/entities/cliente.php';
require_once '../models/Queries/ClientesQuery.php';

use app\models\Queries\ClientesQuery;

// Obtener la lista de clientes
$clientes = ClientesQuery::getAllClientes();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Clientes - RentCar Pro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm mb-4">
        <div class="container">
            <a class="navbar-brand fw-bold" href="../index.php">
            <i class="bi bi-car-front-fill me-2"></i>RentCar Pro
            </a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="../index.php">Vehículos</a></li>
                    <li class="nav-item"><a class="nav-link active" href="clientes.php">Clientes</a></li>
                    <li class="nav-item"><a class="nav-link" href="reservas.php">Reservas</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <?php if(isset($_GET['mensaje'])): ?>
            <script>
                const mensaje = "<?php echo $_GET['mensaje']; ?>";
                if(mensaje === 'guardado') {
                    Swal.fire({ icon: 'success', title: '¡Registrado!', text: 'Cliente guardado con éxito.', timer: 2500, showConfirmButton: false });
                } else if(mensaje === 'eliminado') {
                    Swal.fire({ icon: 'success', title: '¡Eliminado!', text: 'El cliente ha sido removido.', timer: 2500, showConfirmButton: false });
                }
            </script>
        <?php endif; ?>

        <div class="card shadow-sm border-0">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center py-3">
                <h5 class="mb-0"><i class="bi bi-people-fill me-2"></i>Listado de Clientes</h5>
                <button class="btn btn-success btn-sm fw-bold shadow-sm" data-bs-toggle="modal" data-bs-target="#modalCliente">
                    <i class="bi bi-person-plus-fill"></i> Nuevo Cliente
                </button>
            </div>
            <div class="card-body p-0">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-4">Nombre</th>
                            <th>Teléfono</th>
                            <th>Email</th>
                            <th>Licencia</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(empty($clientes)): ?>
                            <tr>
                                <td colspan="5" class="text-center py-4 text-secondary">No hay clientes registrados.</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach($clientes as $c): ?>
                            <tr>
                                <td class="ps-4 fw-medium"><?php echo $c->get('nombre'); ?></td>
                                <td><?php echo $c->get('telefono'); ?></td>
                                <td><?php echo $c->get('email'); ?></td>
                                <td><span class="badge bg-light text-dark border"><?php echo $c->get('numero_licencia'); ?></span></td>
                                <td class="text-center">
                                    <form action="../controllers/ClienteController.php" method="POST" class="d-inline form-eliminar">
                                        <input type="hidden" name="id" value="<?php echo $c->get('id'); ?>">
                                        <input type="hidden" name="accion" value="eliminar">
                                        <button type="button" class="btn btn-outline-danger btn-sm border-0 btn-borrar">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalCliente" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <form action="../controllers/ClienteController.php" method="POST" class="modal-content border-0 shadow-lg">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold">Registrar Cliente</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-12">
                            <label class="form-label small fw-bold text-secondary">Nombre Completo</label>
                            <input type="text" name="nombre" class="form-control" placeholder="Ej: Juan Pérez" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold text-secondary">Teléfono</label>
                            <input type="text" name="telefono" class="form-control" placeholder="3001234567" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold text-secondary">N° Licencia</label>
                            <input type="text" name="numero_licencia" class="form-control" placeholder="ABC-123" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label small fw-bold text-secondary">Correo Electrónico</label>
                            <input type="email" name="email" class="form-control" placeholder="juan@correo.com" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-light border-0">
                    <button type="button" class="btn btn-link text-decoration-none text-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" name="accion" value="crear" class="btn btn-primary px-4 shadow-sm">Guardar Cliente</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        document.querySelectorAll('.btn-borrar').forEach(boton => {
            boton.addEventListener('click', function() {
                const form = this.closest('.form-eliminar');
                Swal.fire({
                    title: '¿Eliminar cliente?',
                    text: "Esta acción borrará al cliente permanentemente.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Sí, eliminar',
                    cancelButtonText: 'Cancelar'
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

