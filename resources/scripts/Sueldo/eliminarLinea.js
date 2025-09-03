// eliminación de líneas: abre modal, confirma, borra y recarga la página
document.addEventListener('DOMContentLoaded', () => {
    let lineToDelete = null;
    let nominaIdToDelete = null;
    const $modal = $('#modalConfirmDelete');
    const $confirmBtn = $('#confirmDeleteBtn');
    const $cancelBtn = $('#cancelDeleteBtn');

    // Abrir modal al click en eliminar
    $(document).on('click', '.btn-delete-line', function (e) {
        e.preventDefault();
        const $btn = $(this);
        lineToDelete = $btn.data('line-id');
        nominaIdToDelete = $btn.data('nomina-id');

        // mostrar modal
        $modal.removeClass('hidden');
    });

    // Cancelar
    $cancelBtn.on('click', function () {
        lineToDelete = null;
        nominaIdToDelete = null;
        $modal.addClass('hidden');
    });

    // Confirmar eliminación
    $confirmBtn.on('click', async function () {
        if (!lineToDelete || !nominaIdToDelete) {
            // si algo falla, cerramos modal y salimos
            $modal.addClass('hidden');
            return;
        }

        const tokenMeta = document.querySelector('meta[name="csrf-token"]');
        const token = tokenMeta ? tokenMeta.getAttribute('content') : '';

        const url = `/admin/nominas/${nominaIdToDelete}/lineas/${lineToDelete}`;

        try {
            $confirmBtn.prop('disabled', true).text('Eliminando...');

            const resp = await axios.delete(url, {
                headers: {
                    'X-CSRF-TOKEN': token,
                    'Content-Type': 'application/json'
                }
            });

            // Si respuesta exitosa: recargar la página para mostrar cambios
            if (resp && resp.data && resp.data.success) {
                location.reload();
                return;
            }

            // Si no fue ok, fallback: recargar igualmente (o podés mostrar error)
            console.error('Respuesta server:', resp.data);
            location.reload();
        } catch (err) {
            console.error('Error eliminando línea:', err);
            // fallback simple: recargar para mantenerse consistente
            location.reload();
        } finally {
            $confirmBtn.prop('disabled', false).text('Eliminar');
            $modal.addClass('hidden');
            lineToDelete = null;
            nominaIdToDelete = null;
        }
    });
});
