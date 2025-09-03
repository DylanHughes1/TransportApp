<!-- resources/views/admin/sueldo/components/modal_confirm_delete.blade.php -->
<div id="modalConfirmDelete" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/40">
  <div class="bg-white rounded-lg shadow p-6 w-full max-w-md">
    <h3 class="text-lg font-semibold mb-2">Confirmar eliminación</h3>
    <p class="text-sm text-gray-600 mb-4">¿Estás seguro que querés eliminar esta fila? Esta acción no se puede deshacer.</p>
    <div class="flex justify-end gap-2">
      <button id="cancelDeleteBtn" class="px-4 py-2 rounded bg-gray-200 hover:bg-gray-300">Cancelar</button>
      <button id="confirmDeleteBtn" class="px-4 py-2 rounded bg-red-600 text-white hover:bg-red-700">Eliminar</button>
    </div>
  </div>
</div>
