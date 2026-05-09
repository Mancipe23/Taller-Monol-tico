function openEditModal(data) {
    document.getElementById('edit_id').value         = data.id;
    document.getElementById('edit_placa').value      = data.placa;
    document.getElementById('edit_marca').value      = data.marca;
    document.getElementById('edit_modelo').value     = data.modelo;
    document.getElementById('edit_categoria').value  = data.categoria;
    document.getElementById('edit_precio_dia').value = data.precio_dia;
    document.getElementById('edit_estado').value     = data.estado;
    document.getElementById('modalOverlay').classList.add('active');
}

function closeModal() {
    document.getElementById('modalOverlay').classList.remove('active');
}

document.getElementById('modalOverlay').addEventListener('click', function(e) {
    if (e.target === this) closeModal();
});