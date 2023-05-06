<x-admin-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Ver Viajes
        </h2>
    </x-slot>

    <body class="text-center">
        <div class="relative flex items-top justify-center min-h-screen sm:items-top py-4 sm:pt-0">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="p-6 bg-white border-b border-gray-200">   
                            <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
                            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
                            

                            <div class="overflow-x-auto">
                                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                    <thead  class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                        <tr>
                                            <th scope="col" class="px-6 py-3">Chofer</th>
                                            <th scope="col" class="px-6 py-3" style="white-space: nowrap;">Fecha Salida</th>
                                            <th scope="col" class="px-6 py-3">Origen</th>
                                            <th scope="col" class="px-6 py-3" style="white-space: nowrap;">Fecha Llegada</th>
                                            <th scope="col" class="px-6 py-3">Km Viaje</th>
                                            <th scope="col" class="px-6 py-3">Destino</th>
                                            <th scope="col" class="px-6 py-3">KM Salida</th>
                                            <th scope="col" class="px-6 py-3">C/Porte</th>
                                            <th scope="col" class="px-6 py-3">Producto</th>
                                            <th scope="col" class="px-6 py-3">Carga (Kg)</th>
                                            <th scope="col" class="px-6 py-3">Descarga (Kg)</th>
                                            <th scope="col" class="px-6 py-3">Km Llegada</th>
                                            <th scope="col" class="px-6 py-3">Control Descarga</th>
                                            <th scope="col" class="px-6 py-3">KM 1.2</th>
                                            <th scope="col" class="px-6 py-3">KM Vacíos</th>
                                            <th scope="col" class="px-6 py-3">Combustible</th>
                                            <th scope="col" class="px-6 py-3">Gastos Extra</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($viajes as $viaje)
                                            @if($viaje->enCurso)
                                                <tr>
                                                    <th cope="row" class="validate px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ \App\Models\TruckDriver::find($viaje->truckdriver_id)->name }}</th>
                                                    <td class="validate px-6 py-4">{{ $viaje->fecha_salida }}</td>
                                                    <td class="validate px-6 py-4">{{ $viaje->origen }}</td>
                                                    <td class="validate px-6 py-4">{{ $viaje->fecha_llegada }}</td>
                                                    <td class="validate px-6 py-4">{{ $viaje->km_viaje }}</td>
                                                    <td class="validate px-6 py-4">{{ $viaje->destino }}</td>
                                                    <td class="validate px-6 py-4">{{ $viaje->km_salida }}</td>
                                                    <td class="validate px-6 py-4">{{ $viaje->c_porte }}</td>
                                                    <td class="validate px-6 py-4">{{ $viaje->producto }}</td>
                                                    <td class="validate px-6 py-4">{{ $viaje->carga_kg }}</td>
                                                    <td class="validate px-6 py-4">{{ $viaje->descarga_kg }}</td>
                                                    <td class="validate px-6 py-4">{{ $viaje->km_llegada }}</td>
                                                    <td class="validate px-6 py-4">{{ $viaje->control_desc }}</td>
                                                    <td class="validate px-6 py-4">{{ $viaje->km_1_2 }}</td>
                                                    <td class="validate px-6 py-4"> {{ $viaje->km_vacios }}</td>
                                                    <td class="validate px-6 py-4"><a href="#" data-modal-toggle="modalCombustible" class="font-medium text-blue-600 dark:text-blue-500 hover:underline" id="verMasLink">Ver más</a></td>   
                                                    <td class="validate px-6 py-4"><a href="#" data-modal-toggle="modalGastos" class="font-medium text-blue-600 dark:text-blue-500 hover:underline" id="verMasLink2" style="white-space: nowrap;">Ver más</a></td>                                               

                                                    <script>
                                                        // Script para chequear los campos vacíos y aplicar el estilo rojo
                                                    
                                                        window.onload = function() {
                                                                var elementos = document.getElementsByClassName("validate");
                                                                var todosVacios = true;
                                                                var cont = 0;
                                                               
                                                                for (var i = 0; i < elementos.length && todosVacios; i++) {
                                                                    

                                                                    if(i != 0 && i != 1 && i != 2 && i != 3 && i != 5 && i != 13 && i != 15 && i != 16){
                                                                        
                                                                        if (elementos[i].textContent !== null && elementos[i].textContent !== "" && elementos[i].textContent !== " ") {
                                                                            todosVacios = false;
                                                                        }
                                                                    }
                                                                }

                                                                for (var i = 0; i < 15; i++) {                             
                                                                        if (elementos[i].textContent !== null && elementos[i].textContent !== "" && elementos[i].textContent !== " ") {
                                                                            console.log(elementos[i].textContent);
                                                                            cont++;
                                                                        }
                                                                }
                                                                console.log(cont);
                                                                
                                                                if (todosVacios && cont === 5) {
                                                                    for (var i = 0; i < elementos.length; i++) {
                                                                        elementos[i].style.backgroundColor = "rgb(255, 150, 150)";
                                                                        elementos[i].style.color = "black";
                                                                    }
                                                                }
                                                                else if(cont < 15 && !todosVacios) {
                                                                    for (var i = 0; i < elementos.length; i++) {
                                                                        elementos[i].style.backgroundColor = "yellow";
                                                                        elementos[i].style.color = "black";
                                                                    }
                                                                }
                                                                else if(cont === 14 && !todosVacios){
                                                                    for (var i = 0; i < elementos.length; i++) {
                                                                        elementos[i].style.backgroundColor = "green";
                                                                        elementos[i].style.color = "white";
                                                                    }
                                                                }
                                                            }
                                                    
                                                    </script>  
                                                </tr>
							                @endIf
                                        @endforeach

                                        <!-- Main modal -->
                                        <div id="modalCombustible" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full">
                                            <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
                                                <!-- Modal content -->
                                                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                                    <!-- Modal header -->
                                                    <div class="flex justify-between items-start p-5 rounded-t border-b dark:border-gray-600">
                                                        <h3 class="text-xl font-semibold text-gray-900 lg:text-2xl dark:text-white">
                                                            Combustible
                                                        </h3>
                                                        <button type="button" class="hidden text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="defaultModal">
                                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>  
                                                        </button>
                                                    </div>
                                                    <!-- Modal body -->
                                                    <div class="p-6 space-y-6">
                                                        {{$viaje->registro_combustible_id}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Main modal -->
                                        <div id="modalGastos" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full">
                                            <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
                                                <!-- Modal content -->
                                                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                                    <!-- Modal header -->
                                                    <div class="flex justify-between items-start p-5 rounded-t border-b dark:border-gray-600">
                                                        <h3 class="text-xl font-semibold text-gray-900 lg:text-2xl dark:text-white">
                                                            Gastos Extra
                                                        </h3>
                                                        <button type="button" class="hidden text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="defaultModal">
                                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>  
                                                        </button>
                                                    </div>
                                                    <!-- Modal body -->
                                                    <div class="p-6 space-y-6">
                                                        {{$viaje->observacion}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </tbody>
                                </table>

                            <hr class="my-4 border-gray-300">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</x-admin-app-layout>