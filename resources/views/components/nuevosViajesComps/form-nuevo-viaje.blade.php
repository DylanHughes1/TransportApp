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
                    <!-- Dropdown button -->
                    <button id="dropdownHoverButton" data-dropdown-toggle="dropdownHover"
                        class="text-gray-700 bg-white border border-gray-300 hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-gray-800 dark:border-gray-600 dark:hover:bg-gray-700 dark:focus:ring-blue-800"
                        type="button">
                        <span id="selectedOption">Seleccionar Localidad</span>
                    </button>

                    <!-- Dropdown menu -->
                    <div id="dropdownHover"
                        class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 overflow-y-auto max-h-60">
                        <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownHoverButton">
                            <a href="#"
                                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                                data-value="Seleccionar Localidad">Seleccionar Localidad</a>
                            @foreach ($inputs_editables as $input_editable)
                                @if($input_editable->origen != null)
                                    <a href="#"
                                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                                        data-value="{{ $input_editable->origen }}">{{ $input_editable->origen }}</a>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div>
                    o
                </div>
                <span class="flex-grow">
                    <!-- Campo de formulario oculto para la opción seleccionada -->
                    <input type="hidden" id="selectedOptionInput" name="opcion_seleccionada" value="">

                    <!-- Input para agregar una localidad nueva -->
                    <input type="text" id="salida" name="salida"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Agregar localidad nueva" required>
                </span>
            </div>

            <script>
                // Obtén una referencia a los elementos del DOM
                const dropdownButton = document.getElementById("dropdownHoverButton");
                const selectedOptionSpan = document.getElementById("selectedOption");
                const selectedOptionInput = document.getElementById("selectedOptionInput");
                const nuevaLocalidadInput = document.getElementById("salida");

                // Agrega un evento click al botón del dropdown
                dropdownButton.addEventListener("click", () => {
                    document.getElementById("dropdownHover").classList.toggle("hidden");
                });

                // Agrega un evento click a cada opción dentro del menú
                const options = document.querySelectorAll("#dropdownHover a");
                options.forEach(option => {
                    option.addEventListener("click", () => {
                        const selectedValue = option.getAttribute("data-value");
                        if (selectedValue === "Seleccionar Localidad") {
                            // Si se selecciona la opción en blanco, habilita el campo de "Agregar localidad nueva"
                            nuevaLocalidadInput.disabled = false;
                            selectedOptionInput.value = ""; // Limpia el campo de opción seleccionada
                            selectedOptionSpan.textContent = option.textContent;
                        } else {
                            selectedOptionSpan.textContent = option.textContent;
                            selectedOptionInput.value = selectedValue;
                            nuevaLocalidadInput.value = ""; // Limpia el campo de nueva localidad
                            nuevaLocalidadInput.disabled = true; // Deshabilita el campo de nueva localidad
                        }
                        document.getElementById("dropdownHover").classList.add("hidden");
                    });
                });
            </script>

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
                    <!-- Dropdown button 2 -->
                    <button id="dropdownHoverButton2" data-dropdown-toggle="dropdownHover2"
                        class="text-gray-700 bg-white border border-gray-300 hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-gray-800 dark:border-gray-600 dark:hover-bg-gray-700 dark:focus:ring-blue-800"
                        type="button">
                        <span id="selectedOption2">Seleccionar Localidad</span>
                    </button>

                    <!-- Dropdown menu 2 -->
                    <div id="dropdownHover2"
                        class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 overflow-y-auto max-h-60">
                        <ul class="py-2 text-sm text-gray-700 dark:text-gray-200"
                            aria-labelledby="dropdownHoverButton2">
                            <a href="#"
                                class="block px-4 py-2 hover:bg-gray-100 dark:hover-bg-gray-600 dark:hover:text-white"
                                data-value="Seleccionar Localidad 2">Seleccionar Localidad</a>
                            @foreach ($inputs_editables as $input_editable)
                                @if($input_editable->destino != null)
                                    <a href="#"
                                        class="block px-4 py-2 hover:bg-gray-100 dark:hover-bg-gray-600 dark:hover:text-white"
                                        data-value="{{ $input_editable->destino }}">{{ $input_editable->destino }}</a>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div>
                    o
                </div>
                <span class="flex-grow">
                    <!-- Campo de formulario oculto para la opción seleccionada 2 -->
                    <input type="hidden" id="selectedOptionInput2" name="opcion_seleccionada2" value="">

                    <!-- Input para agregar una localidad nueva 2 -->
                    <input type="text" id="destino" name="destino"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Agregar localidad nueva" required>
                </span>
            </div>

            <script>
                const dropdownButton2 = document.getElementById("dropdownHoverButton2");
                const selectedOptionSpan2 = document.getElementById("selectedOption2");
                const selectedOptionInput2 = document.getElementById("selectedOptionInput2");
                const nuevaLocalidadInput2 = document.getElementById("destino");

                dropdownButton2.addEventListener("click", () => {
                    document.getElementById("dropdownHover2").classList.toggle("hidden");
                });

                const options2 = document.querySelectorAll("#dropdownHover2 a");
                options2.forEach(option => {
                    option.addEventListener("click", () => {
                        const selectedValue2 = option.getAttribute("data-value");
                        if (selectedValue2 === "Seleccionar Localidad 2") {
                            nuevaLocalidadInput2.disabled = false;
                            selectedOptionInput2.value = "";
                            selectedOptionSpan2.textContent = option.textContent;
                        } else {
                            selectedOptionSpan2.textContent = option.textContent;
                            selectedOptionInput2.value = selectedValue2;
                            nuevaLocalidadInput2.value = "";
                            nuevaLocalidadInput2.disabled = true;
                        }
                        document.getElementById("dropdownHover2").classList.add("hidden");
                    });
                });
            </script>


        </div>
    </div>

    <div class="mb-6">
        <label for="default-input"
            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Observación</label>
        <input type="text" id="observacion2" name="observacion2" step="any"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
    </div>

    <!-- <div class="mb-6">
        <label for="default-input" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Precio por Tonelada</label>
        <input type="number" id="TN" name="TN" step="any" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
    </div> -->

    <div class="mb-6">
        <label for="pricing-option" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Seleccione una
            opción de precio</label>
        <div class="flex items-center me-4">
            <input id="option-tonelada" type="radio" value="tonelada" name="pricing-option"
                class="w-4 h-4 mr-2 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                onclick="showInputField()">
            <label for="option-tonelada" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Precio por
                Tonelada</label>
        </div>
        <div class="flex items-center me-4 mt-2">
            <input id="option-total" type="radio" value="total" name="pricing-option"
                class="w-4 h-4 mr-2 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                onclick="showInputField()">
            <label for="option-total" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Precio Total del
                Viaje</label>
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

    <script>
        function showInputField() {
            document.getElementById('input-tonelada').classList.add('hidden');
            document.getElementById('input-total').classList.add('hidden');

            if (document.getElementById('option-tonelada').checked) {
                document.getElementById('input-tonelada').classList.remove('hidden');
            } else if (document.getElementById('option-total').checked) {
                document.getElementById('input-total').classList.remove('hidden');
            }
        }
    </script>


    <div class="col-12 mt-3">
        <button type="submit" data-modal-target="defaultModal" data-modal-hide="defaultModal"
            class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Guardar
            Viaje</button>
    </div>
</form>