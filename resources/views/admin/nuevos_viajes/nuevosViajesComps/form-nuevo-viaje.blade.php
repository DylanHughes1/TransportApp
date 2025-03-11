<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

<form action="/admin/create" method="POST">
    @csrf
    <div class="mb-6">
        <label for="default-input" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Fecha
            Salida</label>
        <input type="date" id="dia1" name="dia1"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
            required>
    </div>

    <div class="mb-6">
        <label for="default-input" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Origen</label>
        <div class="relative inline-block text-left">

            <div class="flex items-center space-x-4">
                <div class="relative">
                    <button id="dropdownOrigenButton" data-dropdown-toggle="dropdownOrigen"
                        class="text-gray-700 bg-white border border-gray-300 hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-gray-800 dark:border-gray-600 dark:hover:bg-gray-700 dark:focus:ring-blue-800"
                        type="button">
                        <span id="selectedOption" class="mr-2">Seleccionar Localidad</span>
                        <svg class="w-2.5 h-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 4 4 4-4" />
                        </svg>
                    </button>
                    <div id="dropdownOrigen"
                        class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 overflow-y-auto max-h-60">
                        <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownOrigenButton">
                            <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                                data-value="Seleccionar Localidad">Seleccionar Localidad</a>
                            @foreach ($origenes as $origen)
                            <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                                data-value="{{ $origen->nombre }}">{{ $origen->nombre }}</a>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div>
                    o
                </div>
                <span class="flex-grow">
                    <input type="hidden" id="selectedOptionInput" name="opcion_seleccionada" value="">

                    <input type="text" id="salida" name="salida"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Agregar localidad nueva" required>
                </span>
            </div>
        </div>
    </div>

    <div class="mb-6">
        <label for="default-input"
            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Observación</label>
        <input type="text" id="observacion1" name="observacion1" step="any"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
    </div>

    <div class="mb-6">
        <label for="default-input" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Fecha
            Llegada</label>
        <input type="date" id="dia2" name="dia2"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
            required>
    </div>

    <div class="mb-6">
        <label for="default-input" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Destino</label>
        <div class="relative inline-block text-left">

            <div class="flex items-center space-x-4">
                <div class="relative">
                    <button id="dropdownDestinoButton" data-dropdown-toggle="dropdownDestino"
                        class="text-gray-700 bg-white border border-gray-300 hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-gray-800 dark:border-gray-600 dark:hover-bg-gray-700 dark:focus:ring-blue-800"
                        type="button">
                        <span id="selectedOption2" class="mr-2">Seleccionar Localidad</span>
                        <svg class="w-2.5 h-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 4 4 4-4" />
                        </svg>
                    </button>
                    <div id="dropdownDestino"
                        class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 overflow-y-auto max-h-60">
                        <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDestinoButton">
                            <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                                data-value="Seleccionar Localidad">Seleccionar Localidad</a>
                            @foreach ($destinos as $destino)
                            <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                                data-value="{{ $destino->nombre }}">{{ $destino->nombre }}</a>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div>
                    o
                </div>
                <span class="flex-grow">
                    <input type="hidden" id="selectedOptionInput2" name="opcion_seleccionada2" value="">
                    <input type="text" id="destino" name="destino"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Agregar localidad nueva" required>
                </span>
            </div>
        </div>
    </div>

    <div class="mb-6">
        <label for="default-input"
            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Observación</label>
        <input type="text" id="observacion2" name="observacion2" step="any"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
    </div>

    <div class="mb-6">
        <label for="pricing-option" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Seleccione opción para la facturación</label>
        <div class="flex items-center me-4">
            <input id="option-carga" type="radio" value="carga" name="fac-option"
                class="w-4 h-4 mr-2 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                onclick="">
            <label for="option-carga" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Carga (Kg)</label>
        </div>
        <div class="flex items-center me-4 mt-2">
            <input id="option-descarga" type="radio" value="descarga" name="fac-option"
                class="w-4 h-4 mr-2 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                onclick="">
            <label for="option-descarga" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Descarga (Kg)</label>
        </div>
    </div>

    <div class="mb-6">
        <label for="pricing-option" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Seleccione una opción de precio</label>
        <div class="flex items-center me-4">
            <input id="option-tonelada" type="radio" value="tonelada" name="pricing-option"
                class="w-4 h-4 mr-2 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                onclick="showInputField()">
            <label for="option-tonelada" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Precio por Tonelada</label>
        </div>
        <div class="flex items-center me-4 mt-2">
            <input id="option-total" type="radio" value="total" name="pricing-option"
                class="w-4 h-4 mr-2 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                onclick="showInputField()">
            <label for="option-total" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Precio Total del Viaje</label>
        </div>
    </div>

    <div id="input-tonelada" class="mb-6 hidden">
        <label for="TN" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Precio por Tonelada</label>
        <input type="number" id="TN" name="TN" step="any"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
    </div>

    <div id="input-total" class="mb-6 hidden">
        <label for="total" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Precio Total del
            Viaje</label>
        <input type="number" id="total" name="total" step="any"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
    </div>

    <div class="col-12 mt-3">
        <button type="submit" data-modal-target="defaultModal" data-modal-hide="defaultModal"
            class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Guardar
            Viaje</button>
    </div>
</form>
@vite(['resources/scripts/Viajes/NuevoViaje.js'])