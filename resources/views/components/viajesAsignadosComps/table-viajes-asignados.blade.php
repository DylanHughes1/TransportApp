<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

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
            <th scope="col" class="px-6 py-3">Combustible</th>
            <th scope="col" class="px-6 py-3">Gastos Extra</th>

        </tr>
    </thead>
    <tbody>
        @foreach ($viajes as $key => $viaje)
            @if($viaje->enCurso)
                <tr class="{{ $viaje->progreso === 1 ? 'bg-red-300' : ($viaje->progreso === 2 ? 'bg-yellow-100' : 'bg-gray-200') }}">
                    <th cope="row" class="border-b bg-opacity-50 px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">

                        @if($viaje->progresoSolicitud === 0)

                            <button id="dropdownDefaultButton" data-dropdown-toggle="dropdown" class="text-gray-700 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-blue-800" type="button">
                                <span class="mr-2">Elegir Chofer</span>
                                <svg class="w-2.5 h-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                                </svg>
                            </button>
                            
                            <!-- Dropdown menu -->
                            <div id="dropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                                <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefaultButton">
                                    @foreach ($truck_drivers as $truck_driver)
                                    <li>
                                        <a href="#" data-modal-toggle="popup-modal{{ $key }}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">{{$truck_driver->name}}</a>
                                    </li>
                                @endforeach
                                    
                            </div>
                        @else                     
                            {{ \App\Models\TruckDriver::find($viaje->truckdriver_id)->name ?? 'En espera' }}                                
                        @endif

                    </th>
                    <td class="border-b bg-opacity-50 px-6 py-4  text-gray-900">{{ \Carbon\Carbon::parse($viaje->fecha_salida)->format('d/m/y') }}</td>
                    <td class="border-b bg-opacity-50 px-6 py-4  text-gray-900">{{ $viaje->origen }}</td>
                    <td class="border-b bg-opacity-50 px-6 py-4  text-gray-900">{{ \Carbon\Carbon::parse($viaje->fecha_llegada)->format('d/m/y') }}</td>
                    <td class="border-b bg-opacity-50 px-6 py-4  text-gray-900">{{ $viaje->km_viaje }}</td>
                    <td class="border-b bg-opacity-50 px-6 py-4  text-gray-900">{{ $viaje->destino }}</td>
                    <td class="border-b bg-opacity-50 px-6 py-4  text-gray-900">{{ $viaje->km_salida }}</td>
                    <td class="border-b bg-opacity-50 px-6 py-4  text-gray-900">{{ $viaje->c_porte }}</td>
                    <td class="border-b bg-opacity-50 px-6 py-4  text-gray-900">{{ $viaje->producto }}</td>
                    <td class="border-b bg-opacity-50 px-6 py-4  text-gray-900">{{ $viaje->carga_kg }}</td>
                    <td class="border-b bg-opacity-50 px-6 py-4  text-gray-900">{{ $viaje->descarga_kg }}</td>
                    <td class="border-b bg-opacity-50 px-6 py-4  text-gray-900">{{ $viaje->km_llegada }}</td>
                    <td class="border-b bg-opacity-50 px-6 py-4  text-gray-900">{{ $viaje->control_desc }}</td>
                    <td class="border-b bg-opacity-50 px-6 py-4  text-gray-900">{{ $viaje->km_1_2 }}</td>
                    <td class="border-b bg-opacity-50 px-6 py-4  text-gray-900"><a href="#" data-modal-toggle="modalCombustible{{ $key }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline" id="verMasLink">Ver más</a></td>   
                    <td class="border-b bg-opacity-50 px-6 py-4  text-gray-900"><a href="#" data-modal-toggle="modalGastos{{ $key }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline" id="verMasLink2" style="white-space: nowrap;">Ver más</a></td>                                               
                </tr>
            @endIf

        <!-- Modal -->
        <div id="popup-modal{{ $key }}" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative w-full max-w-md max-h-full">
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <button type="button" class="hidden absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-toggle="modal">
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                    <div class="p-6 text-center">
                        
                        @php
                            $truck_driver_id = null; // Inicializa la variable
                        @endphp
                        <form method="POST" action="/admin/viajes">
                            @csrf
                            @if($viaje->progresoSolicitud === 0)
                                   
                                    <input type="hidden" name="id_viaje" value="{{$viaje->id}}">
                                    <input type="hidden" name="truckdriver_id" value="{{$truck_driver->id}}">
                                
                            @else
                                @php
                                    $truck_driver_id = $viaje->truckdriver_id; // Asigna el valor en caso de que el progreso sea diferente de 0
                                @endphp
                            @endif      

                            <div class="mb-6">
                                    <label for="observacion" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Observación Salida</label>
                                    <input type="text" id="observacion" name="observacion1" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    value="">
                                </div>
                                <div class="mb-6">
                                    <label for="observacion" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Observación Llegada</label>
                                    <input type="text" id="observacion2" name="observacion2" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    value="">
                                </div>
                            
                                <button data-modal-toggle="popup-modal{{ $key }}" type="submit" name="finalizar" class="text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                                    Aceptar
                                </button>
                            </form>
                            <button data-modal-toggle="popup-modal{{ $key }}" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Cancelar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
              

            <!-- Main modal -->
            <div id="modalCombustible{{ $key }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full">
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
                        <div class="p-6 space-y-6 text-center text-lg font-medium text-gray-800">
                            @if(count($viaje->combustibles) > 0)
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
            <div id="modalGastos{{ $key }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full">
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
                            @if($viaje->observacion != null)
                                {{$viaje->observacion}}
                            @else
                                <p>No hay gastos extra</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </tbody>
</table>