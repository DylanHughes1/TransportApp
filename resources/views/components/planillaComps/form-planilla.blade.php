@foreach ($viajes as $key => $viaje)                                   
        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                {{ \Carbon\Carbon::parse($viaje->fecha_salida)->format('d/m/y') }}
            </th>
            <td class="px-6 py-4">
                {{$viaje->origen}}
            </td>
            <td class="px-6 py-4">
                {{$viaje->km_viaje}}
            </td>
            <td class="px-6 py-4">
                {{$viaje->km_salida}}
            </td>
            <td class="px-6 py-4">
                {{$viaje->destino}}
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
                {{ \Carbon\Carbon::parse($viaje->fecha_llegada)->format('d/m/y') }}
            </td>
            <td class="px-6 py-4">
                {{$viaje->km_llegada}}
            </td>
            <td class="px-6 py-4">
                {{$viaje->producto}}
            </td>
            <td class="px-6 py-4">
                {{$viaje->carga_kg}}
            </td>
            <td class="px-6 py-4">
                {{$viaje->km_llegada - $viaje->km_salida}}
            </td>
            <td class="px-6 py-4">
                {{$viaje->TN}}
            </td>
            <td class="px-6 py-4">
                {{($viaje->carga_kg/1000) * $viaje->TN}}
            </td>
            <td class="px-6 py-4">
                @if ($viaje->km_llegada - $viaje->km_salida !== 0)
                    {{ number_format((($viaje->carga_kg/1000) * $viaje->TN) / ($viaje->km_llegada - $viaje->km_salida), 2) }}
                @endif
            </td>            
            <td class="px-6 py-4">
                <a href="#" data-modal-toggle="modalCombustible{{ $key }}" id="verMasLink" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                    Ver Más
                </a>
            </td>  
            <td class="px-6 py-4">
                <a href="#" data-modal-toggle="modalRemito{{ $key }}" id="verMasLink2" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                    Ver Más
                </a>
            </td>                                             
        </tr>

        <!-- Main modal -->
        <div id="modalCombustible{{ $key }}" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative w-full max-w-2xl max-h-full">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <!-- Modal header -->
                    <div class="flex justify-between items-start p-5 rounded-t border-b dark:border-gray-600">
                        <h3 class="text-xl font-semibold text-gray-900 lg:text-2xl dark:text-white">
                            Combustible
                        </h3>
                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="modal">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>  
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="p-6 space-y-6 text-center text-lg font-medium text-gray-800">
                        @if(count($viajes) > 0)
                            <ul>
                                @foreach($viaje->combustibles as $combustible)
                                    <li>Km: {{$combustible->Km}}</li>
                                    <li>Fecha: {{$combustible->fecha}}</li>
                                    <li>Litros: {{$combustible->litros}}</li>
                                    <li>Lugar de carga: {{$combustible->lugar_carga}}</li>
                                    <hr> 
                                @endforeach
                            </ul>
                        @else
                            <p>No se ha cargado combustible</p>
                        @endif
                    </div>                      
                </div>
            </div>
        </div>

        <!-- Main modal -->
        <div id="modalRemito{{ $key }}" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative w-full max-w-2xl max-h-full">
                <div class="relative w-full max-w-2xl">
                    <!-- Modal content -->
                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                        <!-- Modal header -->
                        <div class="flex justify-between items-start p-5 rounded-t border-b dark:border-gray-600">
                            <h3 class="text-xl font-semibold text-gray-900 lg:text-2xl dark:text-white">
                                Remito
                            </h3>
                            <button type="button" class="hidden text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="defaultModal">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                </svg>  
                            </button>
                        </div>
                        <!-- Modal body -->
                        <div class="p-6 space-y-6">
                            @if ($viaje->imagenesViajes->count() > 0)
                                <div class="grid grid-cols-3 gap-4">
                                    @foreach ($viaje->imagenesViajes as $imagenViaje)
                                        <div class="relative bg-white rounded-lg shadow-md dark:bg-gray-700">
                                            <img class="rounded-t-lg" src="{{ $imagenViaje->image_link }}" alt="Imagen del remito">
                                            <div class="absolute bottom-2 right-2">
                                                <a href="{{ $imagenViaje->image_link }}" download>
                                                    <button class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700">
                                                        Ver Imagen
                                                    </button>
                                                </a>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <p>No hay imágenes asociadas</p>
                            @endif
                        </div>          
                    </div>
                </div>
            </div>
        </div>
@endforeach