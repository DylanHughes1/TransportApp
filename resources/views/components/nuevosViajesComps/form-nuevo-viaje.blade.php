<form action="/admin/create" method="POST">
    @csrf
    
    <div class="mb-6">
        <label for="default-input" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Fecha Salida</label>
        <input type="date" id="dia1" name="dia1" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"required>
    </div>  
    
    <div class="mb-6">
        <label for="default-input" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Origen</label>
        <input type="text" id="salida" name="salida" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"required>
    </div> 

    <div class="mb-6">
        <label for="default-input" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Fecha Llegada</label>
        <input type="date" id="dia2" name="dia2" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"required>
    </div>  
    
    <div class="mb-6">
        <label for="default-input" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Destino</label>
        <input type="text" id="llegada" name="llegada" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"required>
    </div>

    <div class="mb-6">
        <label for="default-input" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Precio por Tonelada</label>
        <input type="number" id="TN" name="TN" step="any" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
    </div>
    
    
    <div class="col-12 mt-3">
        <button type="submit" class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Guardar Viaje</button>
        <button type="button" class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">
            <a href="/admin/dashboard" style="text-decoration:none">Cancelar</a>
        </button>
    </div>
</form>