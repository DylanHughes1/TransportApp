<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

<form action="/admin/create" method="POST" class="space-y-4">
    @csrf
    <div>
        <label for="dia1" class="block text-sm font-medium text-gray-900 dark:text-white">
            Fecha Salida <span class="text-red-500">*</span>
        </label>
        <input type="date" id="dia1" name="dia1" required
            class="mt-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white" />
    </div>

    <!-- Origen -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <!-- Dropdown de Origen -->
        <div>
            <label class="block text-sm font-medium text-gray-900 dark:text-white">Origen</label>
            <div class="relative">
                <button id="dropdownOrigenButton"
                    data-dropdown-toggle="dropdownOrigen"
                    data-dropdown-placement="bottom"
                    type="button"
                    class="mt-1 w-full text-left bg-white border border-gray-300 rounded-lg px-4 py-2.5 text-sm text-gray-700 dark:bg-gray-800 dark:border-gray-600 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                    <span id="selectedOption">Seleccionar Localidad</span>
                    <svg class="w-3 h-3 ml-2 inline-block float-right" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>

                <div id="dropdownOrigen"
                    class="z-10 hidden w-full bg-white dark:bg-gray-700 divide-y divide-gray-100 rounded-lg shadow max-h-60 overflow-y-auto">
                    <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownOrigenButton">
                        <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600" data-value="Seleccionar Localidad">Seleccionar Localidad</a>
                        @foreach ($origenes as $origen)
                        <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600" data-value="{{ $origen->nombre }}">{{ $origen->nombre }}</a>
                        @endforeach
                    </ul>
                </div>
                <input type="hidden" id="selectedOptionInput" name="opcion_seleccionada">
            </div>
        </div>

        <!-- Input alternativo -->
        <div>
            <label for="salida" class="block text-sm font-medium text-gray-900 dark:text-white">Nueva localidad</label>
            <input type="text" id="salida" name="salida" required
                placeholder="Agregar localidad nueva"
                class="mt-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white" />
        </div>
    </div>

    <div>
        <label for="observacion1" class="block text-sm font-medium text-gray-900 dark:text-white">Observación</label>
        <input type="text" id="observacion1" name="observacion1"
            class="mt-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white" />
    </div>

    <div>
        <label for="dia2" class="block text-sm font-medium text-gray-900 dark:text-white">
            Fecha Llegada <span class="text-red-500">*</span>
        </label>
        <input type="date" id="dia2" name="dia2" required
            class="mt-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white" />
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <!-- Dropdown de Destino -->
        <div>
            <label class="block text-sm font-medium text-gray-900 dark:text-white">Destino</label>
            <div class="relative">
                <button id="dropdownDestinoButton"
                    data-dropdown-toggle="dropdownDestino"
                    data-dropdown-placement="bottom"
                    type="button"
                    class="mt-1 w-full text-left bg-white border border-gray-300 rounded-lg px-4 py-2.5 text-sm text-gray-700 dark:bg-gray-800 dark:border-gray-600 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                    <span id="selectedOption2">Seleccionar Localidad</span>
                    <svg class="w-3 h-3 ml-2 inline-block float-right" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>

                <div id="dropdownDestino"
                    class="z-10 hidden w-full bg-white dark:bg-gray-700 divide-y divide-gray-100 rounded-lg shadow max-h-60 overflow-y-auto">
                    <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDestinoButton">
                        <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600" data-value="Seleccionar Localidad">Seleccionar Localidad</a>
                        @foreach ($destinos as $destino)
                        <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600" data-value="{{ $destino->nombre }}">{{ $destino->nombre }}</a>
                        @endforeach
                    </ul>
                </div>
                <input type="hidden" id="selectedOptionInput2" name="opcion_seleccionada2">
            </div>
        </div>

        <!-- Input alternativo -->
        <div>
            <label for="destino" class="block text-sm font-medium text-gray-900 dark:text-white">Nueva localidad</label>
            <input type="text" id="destino" name="destino" required
                placeholder="Agregar localidad nueva"
                class="mt-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white" />
        </div>
    </div>


    <div>
        <label for="observacion2" class="block text-sm font-medium text-gray-900 dark:text-white">Observación</label>
        <input type="text" id="observacion2" name="observacion2"
            class="mt-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white" />
    </div>

    <div class="bg-gray-50 dark:bg-gray-800 p-4 rounded-lg shadow-sm space-y-2">
        <label class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Facturación</label>
        <div class="flex gap-4">
            <label class="flex items-center text-sm text-gray-700 dark:text-gray-300">
                <input type="radio" name="fac-option" value="carga" class="mr-2">
                Carga (Kg)
            </label>
            <label class="flex items-center text-sm text-gray-700 dark:text-gray-300">
                <input type="radio" name="fac-option" value="descarga" class="mr-2">
                Descarga (Kg)
            </label>
        </div>
    </div>

    <div class="bg-gray-50 dark:bg-gray-800 p-4 rounded-lg shadow-sm space-y-2">
        <label class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Precio</label>
        <div class="flex gap-4">
            <label class="flex items-center text-sm text-gray-700 dark:text-gray-300">
                <input type="radio" name="pricing-option" value="tonelada" class="mr-2">
                Precio por Tonelada
            </label>
            <label class="flex items-center text-sm text-gray-700 dark:text-gray-300">
                <input type="radio" name="pricing-option" value="total" class="mr-2">
                Precio Total del Viaje
            </label>
        </div>
    </div>

    <div id="input-tonelada" class="mb-6 hidden">
        <label for="TN" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Precio por Tonelada</label>
        <input type="number" id="TN" name="TN" step="any"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
    </div>

    <div id="input-total" class="mb-6 hidden">
        <label for="total" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Precio Total del Viaje</label>
        <input type="number" id="total" name="total" step="any"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
    </div>
    <div>
        <button type="submit" data-modal-hide="viajeNuevoModal"
            class="w-full md:w-auto bg-green-600 hover:bg-green-700 text-white font-semibold text-sm px-6 py-3 rounded-lg flex items-center justify-center">
            Guardar Viaje
        </button>
    </div>
</form>
@vite(['resources/scripts/Viajes/NuevoViaje.js'])