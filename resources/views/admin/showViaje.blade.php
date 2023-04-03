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
                                        <td class="px-6 py-2 w-32">{{ $viaje->fecha_salida }}</td>
                                        <td class="px-6 py-2 w-32">{{ $viaje->origen }}</td>
                                        <td class="px-6 py-2 w-32">{{ $viaje->fecha_llegada }}</td>
                                        <td class="px-6 py-2 w-32">{{ $viaje->km_viaje }}</td>
                                        <td class="px-6 py-2 w-32">{{ $viaje->destino }}</td>
                                        <td class="px-6 py-2 w-32">{{ $viaje->km_salida }}</td>
                                        <td class="px-6 py-2 w-32">{{ $viaje->c_porte }}</td>
                                        <td class="px-6 py-2 w-32">{{ $viaje->producto }}</td>
                                        <td class="px-6 py-2 w-32">{{ $viaje->carga_kg }}</td>
                                        <td class="px-6 py-2 w-32">{{ $viaje->descarga_kg }}</td>
                                        <td class="px-6 py-2 w-32">{{ $viaje->km_llegada }}</td>
                                        <td class="px-6 py-2 w-32">{{ $viaje->control_desc }}</td>
                                        <td class="px-6 py-2 w-32">{{ $viaje->km_1_2 }}</td>
                                        {{-- <td class="px-6 py-2 w-32">{{ $viaje->km_vacios == 1 ? 'Si' : 'No'  }}</td> --}}
                                        <td class="px-4 py-2 {{ $viaje->km_vacios == 0 ? 'modal-trigger text-blue-600 underline cursor-pointer' : '' }}">{{ $viaje->peaje == 1 ? 'Si' : 'No' }}</td>

                                        {{-- <td class="px-4 py-2 {{ $viaje->peaje == 0 ? 'modal-trigger text-blue-600 underline cursor-pointer' : '' }}">{{ $viaje->peaje == 1 ? 'Si' : 'No' }}</td> --}}
                                        <td class="px-4 py-2 w-32">{{ $viaje->peaje }}</td>
                                        <td class="px-6 py-2 w-32">{{ $viaje->arreglo_pinchadura == 1 ? 'Si' : 'No' }}</td>
                                        <td class="px-6 py-2 w-32">{{ $viaje->retiro_plata_adelanto == 1 ? 'Si' : 'No' }}</td>

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