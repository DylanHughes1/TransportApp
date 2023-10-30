<x-truck_driver-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Viaje {{ \Carbon\Carbon::parse($viaje->fecha_salida)->format('d/m/y') }}
        </h2>
    </x-slot>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">               
                    <div class="flex items-center justify-center pb-4">    
                        <form action="/truck_driver/viajes/b/{{$viaje->id}}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="grid gap-6 mb-6 md:grid-cols-1">
                                <div class="text-center">
                                    <h2 class="block mb-2 text-lg font-medium text-gray-900 dark:text-white">Campos Opcionales</h2>
                                </div>                                
                                <div>
                                    <label for="Combustible" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Cargó Combustible?</label>
                                    <select id="combustible" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        <option selected>Selecione una opción</option>
                                        <option value="si">Si</option>
                                        <option value="no">No</option>
                                    </select>
                                </div>
                                <button id="myButton" class="hidden"data-modal-toggle="combustibleModal" type="button"></button>

                                <script>
                                    
                                        $('#combustible').on('change', function() {
                                            
                                            if ($(this).val() === 'si') {
                                                $('[data-modal-toggle="combustibleModal"]').trigger('click');
                                            }
                                        });

                                </script>

                                <div>
                                    <label for="viajeNuevo" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Ingrese un viaje nuevo</label>
                                    <a href="#" data-modal-toggle="modalViajeNuevo" id="verMasLink2" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                                        <button type="button" name="viajeNuevo" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Agregar Viaje</button>  
                                    </a>
                                </div>
                                <div>
                                    <label for="gasto" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Ingrese cualquier gasto extra</label>
                                    <textarea id="observacion" name="observacion" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Arreglo de pinchadura, Gasto en Peaje...">{{ $viaje->observacion }}</textarea>
                                </div>
                                
                                                          
                                <div class="text-left">
                                    <a href="/truck_driver/viajes/{{$viaje->id}}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">   
                                        <svg aria-hidden="true" class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l2.293 2.293a1 1 0 010 1.414z" clip-rule="evenodd"></path></svg>
                                        Anterior
                                    </a>
                                </div>  

                                <div>
                                    <td class="flex items-center px-6 py-4 space-x-3">
                                        <button type="submit" name="guardar"class="focus:outline-none text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:focus:ring-yellow-900">Guardar</button>
                                        <a href="/truck_driver/dashboard" class="col-md-12 text-right">
                                            <button type="button" id="nextButton" class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Cancelar</button>
                                        </a>
                                    <td>
                                </div>

                                <div class="flex p-4 mb-4 text-sm text-yellow-800 rounded-lg bg-yellow-50 dark:bg-gray-800 dark:text-yellow-300" role="alert">
                                    <svg aria-hidden="true" class="flex-shrink-0 inline w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                                    <span class="sr-only">Info</span>
                                    <div>
                                        Recuerde guardar los cambios antes de avanzar a la siguiente página.
                                    </div>
                                </div> 
                            </div>
                            </form>                                       
                        </div>
                    </div>
                </div>                      
            </div>
        </div>
    </div>

    <!-- Main modal -->
    <div id="modalViajeNuevo" tabindex="-1" aria-hidden="true" class="hidden fixed inset-0 z-50 overflow-y-auto">
        <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex justify-between items-start p-5 rounded-t border-b dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 lg:text-2xl dark:text-white">
                        Viaje
                    </h3>
                    <button type="button" class=" text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="modalViajeNuevo">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>  
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-6 space-y-6">
                    <div class="p-6 space-y-6">
                        <form method="POST" action="/truck_driver/viajes/b/{{$viaje->id}}/newViaje">
                            @csrf
                            @method('PUT')
                            <div class="grid gap-6 mb-6 md:grid-cols-3">
                                <div>                                  
                                    <label for="Fecha Salida" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Fecha Salida</label>
                                    <input type="date" name="fecha_salida" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" 
                                    value="" placeholder="Año-Mes-Día" required>
                                </div>
                                <div>
                                    <label for="Origen" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Origen</label>
                                    {{-- <input type="text" name="origen" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" 
                                    value="" required="false"> --}}
                                    <div class="relative inline-block text-left">
       
                                        <button id="dropdownHoverButton" data-dropdown-toggle="dropdownHover" class="text-gray-700 bg-white border border-gray-300 hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-gray-800 dark:border-gray-600 dark:hover:bg-gray-700 dark:focus:ring-blue-800" type="button">
                                            <span id="selectedOption">Seleccionar Localidad</span>
                                        </button>
                                        
                                        <!-- Dropdown menu -->
                                        <div id="dropdownHover" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                                            <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownHoverButton">
                                                <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white" data-value="Seleccionar Localidad">Seleccionar Localidad</a>
                                                @foreach ($inputs_editables as $input_editable)
                                                    <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white" data-value="{{ $input_editable->origen }}">{{ $input_editable->origen }}</a>
                                                @endforeach
                                            </ul>
                                        </div>
                                        o
                                        <!-- Campo de formulario oculto para la opción seleccionada -->
                                        <input type="hidden" id="selectedOptionInput" name="opcion_seleccionada" value="">
                                        
                                        <!-- Input para agregar una localidad nueva -->
                                        <div class="mt-4">
                                            <input type="text" id="salida" name="salida" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Agregar localidad nueva" required>
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
                                    <label for="destino" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Destino</label>
                                    {{-- <input type="text" name="destino" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" 
                                    value=""required="false"> --}}
                                    <div class="relative inline-block text-left">
       
                                        <button id="dropdownHoverButton2" data-dropdown-toggle="dropdownHover2" class="text-gray-700 bg-white border border-gray-300 hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-gray-800 dark:border-gray-600 dark:hover-bg-gray-700 dark:focus:ring-blue-800" type="button">
                                            <span id="selectedOption2">Seleccionar Localidad</span>
                                        </button>
                                        
                                        <!-- Dropdown menu 2 -->
                                        <div id="dropdownHover2" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                                            <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownHoverButton2">
                                                <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover-bg-gray-600 dark:hover:text-white" data-value="Seleccionar Localidad 2">Seleccionar Localidad</a>
                                                @foreach ($inputs_editables as $input_editable)
                                                    <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover-bg-gray-600 dark:hover:text-white" data-value="{{ $input_editable->destino }}">{{ $input_editable->destino }}</a>
                                                @endforeach
                                            </ul>
                                        </div>
                                        
                                        <input type="hidden" id="selectedOptionInput2" name="opcion_seleccionada2" value="">
                            
                                        <!-- Input para agregar una localidad nueva -->
                                        <div class="mt-4">
                                            <input type="text" id="destino" name="destino" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Agregar localidad nueva" required>
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
                                    <label for="km_salida" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Km Salida</label>
                                    <input type="number" name="km_salida" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    value="">
                                </div>
                                <div>
                                    <label for="Fecha llegada" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Fecha Llegada</label>
                                    <input type="date" name="fecha_llegada" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" 
                                    value="" required="false">
                                </div>
                                <div>
                                    <label for="kmLlegada" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Km Llegada</label>
                                    <input type="number" name="km_llegada" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    value="">
                                </div>
                                <div>
                                    <label for="km12" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Km 1,2</label>
                                    <input type="number" name="km_1_2" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    value="">
                                </div>
                            </div>
                            <button type="submit" name="guardar"class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Guardar</button> 
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
<!-- Modal toggle -->
<button class="hidden text-white bg-gradient-to-br from-pink-500 to-voilet-500 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 text-center inline-flex items-center shadow-md shadow-gray-300 hover:scale-[1.02] transition-transform" type="button" data-modal-toggle="combustibleModal">
    Toggle modal
  </button>

<!-- Main modal -->
    <div id="combustibleModal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full">
        <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex justify-between items-start p-5 rounded-t border-b dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 lg:text-2xl dark:text-white">
                        Viaje
                    </h3>
                    <button type="button" class=" text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="combustibleModal">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>  
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-6 space-y-6">
                    <form method="POST" action="/truck_driver/viajes/b/{{ $viaje->id }}">
                        @csrf

                        <div class="form-group">
                            <label for="campo1" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">KM</label>
                            <input type="number" name=Km id="campo1" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"required>
                        </div>
                        <div class="form-group">
                            <label for="campo1" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Fecha de carga:</label>
                            <input type="date" name="fecha" id="campo1" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"required>
                        </div>
                        <div class="form-group">
                            <label for="campo1" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Litros:</label>
                            <input type="number" name="litros" id="campo1" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"required>
                        </div>
                        <div class="form-group">
                            <label for="campo1" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Lugar de Carga:</label>
                            <input type="text" name="lugar_carga" id="campo1" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"required>
                        </div>
                        <input type="hidden" name="viaje_id" value="{{ $viaje->id }}">
                    
                </div>
                <!-- Modal footer -->
                <div class="flex items-center p-6 space-x-2 rounded-b border-t border-gray-200 dark:border-gray-600">
                        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Guardar</button>
            
                </div>
            </form>
            </div>
        </div>
    </div>
</div>


</x-truck-driver-app-layout>