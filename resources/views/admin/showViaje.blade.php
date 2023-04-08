<x-admin-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Viajes de {{$truck_driver->name}}
        </h2>
    </x-slot>

    <body class="text-center">
        <div class="relative flex items-top justify-center min-h-screen sm:items-top py-4 sm:pt-0">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="p-6 bg-white border-b border-gray-200">   
                            <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

                              <div class="overflow-x-auto">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th class="px-6 py-2 w-32">Fecha Salida</th>
                                        <th class="px-6 py-2 w-32">Origen</th>
                                        <th class="px-6 py-2 w-32">Fecha Llegada</th>
                                        <th class="px-6 py-2 w-32">Km Viaje</th>
                                        <th class="px-6 py-2 w-32">Destino</th>
                                        <th class="px-6 py-2 w-32">KM Salida</th>
                                        <th class="px-6 py-2 w-32">C/Porte</th>
                                        <th class="px-6 py-2 w-32">Producto</th>
                                        <th class="px-6 py-2 w-32">Carga (Kg)</th>
                                        <th class="px-6 py-2 w-32">Descarga (Kg)</th>
                                        <th class="px-6 py-2 w-32">Km Llegada</th>
                                        <th class="px-6 py-2 w-32">Control Descarga</th>
                                        <th class="px-6 py-2 w-32">KM 1.2</th>
                                        <th class="px-6 py-2 w-32">KM Vacíos</th>
                                        <th class="px-6 py-2 w-32">Gasto en Peaje</th>
                                        <th class="px-6 py-2 w-32">Arreglo Pinchadura</th>
                                        <th class="px-6 py-2 w-32">Retiro Plata Adelantado</th>

                                    </tr>
                                    </thead>
                                    <tbody class="border divide-y divide-gray-200">
                                        @foreach ($viajes as $viaje)
                                            <tr>
                                                <td class="validate px-6 py-2 w-32">{{ $viaje->fecha_salida }}</td>
                                                <td class="validate px-6 py-2 w-32">{{ $viaje->origen }}</td>
                                                <td class="validate px-6 py-2 w-32">{{ $viaje->fecha_llegada }}</td>
                                                <td class="validate px-6 py-2 w-32">{{ $viaje->km_viaje }}</td>
                                                <td class="validate px-6 py-2 w-32">{{ $viaje->destino }}</td>
                                                <td class="validate px-6 py-2 w-32">{{ $viaje->km_salida }}</td>
                                                <td class="validate px-6 py-2 w-32">{{ $viaje->c_porte }}</td>
                                                <td class="validate px-6 py-2 w-32">{{ $viaje->producto }}</td>
                                                <td class="validate px-6 py-2 w-32">{{ $viaje->carga_kg }}</td>
                                                <td class="validate px-6 py-2 w-32">{{ $viaje->descarga_kg }}</td>
                                                <td class="validate px-6 py-2 w-32">{{ $viaje->km_llegada }}</td>
                                                <td class="validate px-6 py-2 w-32">{{ $viaje->control_desc }}</td>
                                                <td class="validate px-6 py-2 w-32">{{ $viaje->km_1_2 }}</td>
                                                <td class="validate px-4 py-2 {{ $viaje->km_vacios == 0 ? 'modal-trigger text-blue-600 underline cursor-pointer' : '' }}">{{ $viaje->peaje == 1 ? 'Si' : 'No' }}</td>

                                                <td class="validate px-4 py-2 w-32">{{ $viaje->peaje }}</td>
                                                <td class="validate px-6 py-2 w-32">{{ $viaje->arreglo_pinchadura == 1 ? 'Si' : 'No' }}</td>
                                                <td class="validate px-6 py-2 w-32">{{ $viaje->retiro_plata_adelanto == 1 ? 'Si' : 'No' }}</td>

                                                <button id="boton-validar">Validar campos</button>

                                                <script>
                                                    // Script para chequear los campos vacíos y aplicar el estilo rojo
                                                   
                                                        function validarCampos() {
                                                            var elementos = document.getElementsByClassName("validate");
                                                            var todosVacios = true;
                                                            var cont = 0;
                                                            
                                                            for (var i = 0; i < elementos.length && todosVacios; i++) {
                                                                console.log(elementos[i].textContent);

                                                                if(i != 0 && i != 1 && i != 2 & i != 4 && i != 13 && i != 15 && i != 16){
                                                                    
                                                                    if (elementos[i].textContent !== null && elementos[i].textContent !== "") {
                                                                        todosVacios = false;
                                                                    }
                                                                }
                                                            }

                                                            for (var i = 0; i < 13; i++) {                             
                                                                    if (elementos[i].textContent !== null && elementos[i].textContent !== "") {
                                                                        cont++;
                                                                    }
                                                            }
                                                            
                                                            
                                                            if (todosVacios) {
                                                                for (var i = 0; i < elementos.length; i++) {
                                                                    elementos[i].style.backgroundColor = "red";
                                                                    elementos[i].style.color = "white";
                                                                }
                                                            }
                                                            else if(cont < 13 && !todosVacios) {
                                                                for (var i = 0; i < elementos.length; i++) {
                                                                    elementos[i].style.backgroundColor = "yellow";
                                                                    elementos[i].style.color = "white";
                                                                }
                                                            }
                                                            else if(cont === 13 && !todosVacios){
                                                                for (var i = 0; i < elementos.length; i++) {
                                                                    elementos[i].style.backgroundColor = "green";
                                                                    elementos[i].style.color = "white";
                                                                }
                                                            }
                                                        }
                                                       document.getElementById("boton-validar").addEventListener("click", validarCampos);

                                                 
                                                </script>

                                                <script>
                                                    // Busca todos los elementos con la clase "modal-trigger"
                                                    const modalTriggerElements = document.querySelectorAll('.modal-trigger');
                                                
                                                    // Agrega un evento clic a cada elemento
                                                    modalTriggerElements.forEach((element) => {
                                                        element.addEventListener('click', (event) => {
                                                            event.preventDefault(); // previene la acción predeterminada del enlace
                                                            // Muestra el modal correspondiente
                                                            $('#myModal').modal('show');
                                                        });
                                                    });
                                                </script>

                                                <div class="modal fade text-dark" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Observación </h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    
                                                                    Hola
                                                                    
                                                                </div>           
                                                            </div>
                                                        </div>
                                                </div>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</x-admin-app-layout>