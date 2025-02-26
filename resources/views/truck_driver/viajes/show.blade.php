<x-truck_driver-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Viaje {{ \Carbon\Carbon::parse($viaje->fecha_salida)->format('d/m/y') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
                    <div class="mb-3">
                        <label for="viajeNuevo"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Ingrese un viaje
                            nuevo</label>
                        <a href="#" data-modal-toggle="modalViajeNuevo" id="verMasLink2"
                            class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                            <button type="button" name="viajeNuevo"
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Agregar
                                Viaje</button>
                        </a>
                    </div>
                    <div class="mb-3">
                        @if (!$viaje->enCurso)
                        <label for="viajeNuevo"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Ingrese Imagen del Remito</label>
                        <a href="/truck_driver/viajes/image/{{$viaje->id}}" class="col-md-12 text-right">
                            <button type="button" id="nextButton"
                                class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Subir
                                Imagen</button>
                        </a>
                        @endif
                    </div>

                    @component('truck_driver.viajes.viajeComps.formulario-viaje', ['viaje' => $viaje])
                    @endcomponent

                    <!-- Main modal -->
                    <div id="modalViajeNuevo" data-modal-backdrop="static" tabindex="-1" aria-hidden="true"
                        class="mb-4 hidden fixed inset-0 z-50 overflow-y-auto modal-overflow-hidden">
                        <div class="relative p-4 w-full max-w-2xl h-full md:h-auto ">
                            <!-- Modal content -->
                            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                <!-- Modal header -->
                                <div
                                    class="flex justify-between items-start p-5 rounded-t border-b dark:border-gray-600">
                                    <h3 class="text-xl font-semibold text-gray-900 lg:text-2xl dark:text-white">
                                        Viaje
                                    </h3>
                                    <button type="button"
                                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                        data-modal-toggle="modalViajeNuevo">
                                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                            fill="none" viewBox="0 0 14 14">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                        </svg>
                                        <span class="sr-only">Close modal</span>
                                    </button>
                                </div>
                                <!-- Modal body -->
                                <div class="p-6 space-y-6">
                                    <div class="flex p-4 mb-4 text-sm text-yellow-800 rounded-lg bg-yellow-50 dark:bg-gray-800 dark:text-yellow-300"
                                        role="alert">
                                        <svg aria-hidden="true" class="flex-shrink-0 inline w-5 h-5 mr-3"
                                            fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                        <span class="sr-only">Info</span>
                                        <div>
                                            Completar en caso de realizar un viaje vacío hacia el lugar de carga.
                                        </div>
                                    </div>
                                    <form method="POST" action="/truck_driver/viajes/newViaje/{{$viaje->id}}">
                                        @csrf
                                        @method('PUT')
                                        <div class="grid gap-6 mb-6 md:grid-cols-3">
                                            <div>
                                                <label for="Fecha Salida"
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Fecha
                                                    Salida</label>
                                                <input type="date" name="fecha_salida"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                    value="" placeholder="Año-Mes-Día" required>
                                            </div>
                                            <div>
                                                <label for="Origen"
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Origen</label>
                                                {{-- <input type="text" name="origen"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                    value="" required="false"> --}}
                                                <div class="relative inline-block text-left">

                                                    <button id="dropdownHoverButton"
                                                        data-dropdown-toggle="dropdownHover"
                                                        class="text-gray-700 bg-white border border-gray-300 hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-gray-800 dark:border-gray-600 dark:hover:bg-gray-700 dark:focus:ring-blue-800"
                                                        type="button">
                                                        <span id="selectedOption" class="mr-2">Seleccionar Localidad</span>
                                                        <svg class="w-2.5 h-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                d="m1 1 4 4 4-4" />
                                                        </svg>
                                                    </button>

                                                    <!-- Dropdown menu -->
                                                    <div id="dropdownHover"
                                                        class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                                                        <ul class="py-2 text-sm text-gray-700 dark:text-gray-200"
                                                            aria-labelledby="dropdownHoverButton">
                                                            <a href="#"
                                                                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                                                                data-value="Seleccionar Localidad">Seleccionar
                                                                Localidad</a>
                                                            @foreach ($origenes as $origen)
                                                            @if($origen != null)
                                                            <a href="#"
                                                                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                                                                data-value="{{ $origen->nombre }}">{{ $origen->nombre }}</a>
                                                            @endif
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                    o
                                                    <!-- Campo de formulario oculto para la opción seleccionada -->
                                                    <input type="hidden" id="selectedOptionInput"
                                                        name="opcion_seleccionada" value="">

                                                    <!-- Input para agregar una localidad nueva -->
                                                    <div class="mt-4">
                                                        <input type="text" id="salida" name="salida"
                                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                            placeholder="Agregar localidad nueva" required>
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
                                            <div>
                                                <label for="destino"
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Destino</label>
                                                {{-- <input type="text" name="destino"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                    value="" required="false"> --}}
                                                <div class="relative inline-block text-left">

                                                    <button id="dropdownHoverButton2"
                                                        data-dropdown-toggle="dropdownHover2"
                                                        class="text-gray-700 bg-white border border-gray-300 hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-gray-800 dark:border-gray-600 dark:hover-bg-gray-700 dark:focus:ring-blue-800"
                                                        type="button">
                                                        <span id="selectedOption2">Seleccionar Localidad</span>
                                                    </button>

                                                    <!-- Dropdown menu 2 -->
                                                    <div id="dropdownHover2"
                                                        class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                                                        <ul class="py-2 text-sm text-gray-700 dark:text-gray-200"
                                                            aria-labelledby="dropdownHoverButton2">
                                                            <a href="#"
                                                                class="block px-4 py-2 hover:bg-gray-100 dark:hover-bg-gray-600 dark:hover:text-white"
                                                                data-value="Seleccionar Localidad 2">Seleccionar
                                                                Localidad</a>
                                                            @foreach ($destinos as $destino)
                                                            @if($destino != null)
                                                            <a href="#"
                                                                class="block px-4 py-2 hover:bg-gray-100 dark:hover-bg-gray-600 dark:hover:text-white"
                                                                data-value="{{ $destino->nombre }}">{{ $destino->nombre }}</a>
                                                            @endif
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                    o
                                                    <input type="hidden" id="selectedOptionInput2"
                                                        name="opcion_seleccionada2" value="">

                                                    <!-- Input para agregar una localidad nueva -->
                                                    <div class="mt-4">
                                                        <input type="text" id="destino" name="destino"
                                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                            placeholder="Agregar localidad nueva" required>
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
                                            <div>
                                                <label for="km_salida"
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Km
                                                    Salida</label>
                                                <input type="number" name="km_salida"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                    value="">
                                            </div>
                                            <div>
                                                <label for="Fecha llegada"
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Fecha
                                                    Llegada</label>
                                                <input type="date" name="fecha_llegada"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                    value="" required="false">
                                            </div>
                                            <div>
                                                <label for="kmLlegada"
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Km
                                                    Llegada</label>
                                                <input type="number" name="km_llegada"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                    value="">
                                            </div>
                                            <div>
                                                <label for="km12"
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Km
                                                    1,2</label>
                                                <input type="number" name="km_1_2"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                    value="">
                                            </div>
                                        </div>
                                        <button type="submit" name="guardar"
                                            class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Guardar</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </x-truck-driver-app-layout>