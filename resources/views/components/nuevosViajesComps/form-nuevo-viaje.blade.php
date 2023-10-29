<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

<form action="/admin/create" method="POST">
    @csrf
    
    <div class="mb-6">
        <label for="default-input" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Fecha Salida</label>
        <input type="date" id="dia1" name="dia1" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"required>
    </div>  
    
    <div class="mb-6">
        <label for="default-input" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Origen</label>
    <div class="relative inline-block text-left">
       
            <button id="dropdownHoverButton" data-dropdown-toggle="dropdownHover" class="text-gray-700 bg-white border border-gray-300 hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-gray-800 dark:border-gray-600 dark:hover:bg-gray-700 dark:focus:ring-blue-800" type="button">
                <span id="selectedOption">Seleccionar Localidad</span>
            </button>
        
            <!-- Dropdown menu -->
            <div id="dropdownHover" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownHoverButton">
                    @foreach ($inputs_editables as $input_editable)
                        <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">{{ $input_editable->origen }}</a>
                    @endforeach
                </ul>
            </div>

            <script>
                // Obtén una referencia al botón y al span donde se muestra la opción seleccionada
                const dropdownButton = document.getElementById("dropdownHoverButton");
                const selectedOptionSpan = document.getElementById("selectedOption");
            
                // Agrega un evento click al botón
                dropdownButton.addEventListener("click", () => {
                    // Abre o cierra el menú al hacer clic en el botón
                    document.getElementById("dropdownHover").classList.toggle("hidden");
                });
            
                // Agrega un evento click a cada opción dentro del menú
                const options = document.querySelectorAll("#dropdownHover a");
                options.forEach(option => {
                    option.addEventListener("click", () => {
                        // Cuando se hace clic en una opción, actualiza el texto del span
                        selectedOptionSpan.textContent = option.textContent;
                        // Cierra el menú
                        document.getElementById("dropdownHover").classList.add("hidden");
                    });
                });
            </script>
            

    </div>

          o 
        <div class="mt-4">
            <input type="text" id="salida" name="salida" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Agregar localidad nueva" required>
        </div>
    </div>
    
    


    <div class="mb-6">
        <label for="default-input" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Fecha Llegada</label>
        <input type="date" id="dia2" name="dia2" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"required>
    </div>  
    
    <div class="mb-6">
        <label for="default-input" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Destino</label>
        <button id="dropdownDefaultButton" data-dropdown-toggle="dropdown" class="text-gray-700 bg-white border border-gray-300 hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-gray-800 dark:border-gray-600 dark:hover:bg-gray-700 dark:focus:ring-blue-800" type="button">
            <span class="mr-2">Elegir Localidad</span>
            <svg class="w-2.5 h-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
            </svg>
        </button>        
        
        <!-- Dropdown menu -->
        <div id="dropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
            <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefaultButton">
                @if(isset($inputs_editables->destino))
                    {{-- <select name="opcion_seleccionada2"> --}}
                        @foreach ($inputs_editables->destino as $destino)
                            <option value="{{ $destino }}">{{ $destino }}</option>
                        @endforeach
                    {{-- </select> --}}
                @endif
  
        </div>
        o 
        <div class="mt-4">
            <input type="text" id="llegada" name="llegada" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Agregar localidad nueva" required>
        </div>
    </div>

    <div class="mb-6">
        <label for="default-input" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Precio por Tonelada</label>
        <input type="number" id="TN" name="TN" step="any" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
    </div>
    
    
    <div class="col-12 mt-3">
        <button type="submit" class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Guardar Viaje</button>
    </div>
</form>