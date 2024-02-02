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
            <th scope="col" class="px-6 py-3">Patente</th>
            <th scope="col" class="px-6 py-3">Batea</th>
            <th scope="col" class="px-6 py-3">Combustible</th>
            <th scope="col" class="px-6 py-3">Gastos Extra</th>
            <th scope="col" class="px-6 py-3 text-center">Acciones</th>
        </tr>
    </thead>
    <tbody>
        

        @foreach ($viajes as $key => $viaje)
       
                <tr class="{{ $viaje->progreso === 1 ? 'bg-red-300' : ($viaje->progreso === 2 ? 'bg-yellow-100' : 'bg-gray-200') }}">
                    <th cope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">

                        @if($viaje->progresoSolicitud === 0)

                            <button id="dropdownDefaultButton" data-dropdown-toggle="dropdown" class="text-gray-700 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-blue-800" type="button">
                                <span class="mr-2">Elegir Chofer</span>
                                <svg class="w-2.5 h-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                                </svg>
                            </button>
                            
                            <!-- Dropdown menu -->
                            <div id="dropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                                <ul class="h-48 py-2 overflow-y-auto text-gray-700 dark:text-gray-200" aria-labelledby="dropdownUsersButton">
                                    @foreach ($choferes as $chofer)
                                    <form method="POST" action="/admin/viajes/{{$chofer->id}}">
                                        @csrf
                                            <input type="hidden" name="id_viaje" value="{{$viaje->id}}">
                                        <li class="hover:bg-gray-100">
                                            <button type="submit" class="text-left block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white" style="white-space: normal;">{{$chofer->name}}</button>
                                        </li>              
                                  
                                        </form>
                                        
                                    @endforeach
                                </ul>
                            </div>
                            
                        @else                     
                            {{ \App\Models\TruckDriver::find($viaje->truckdriver_id)->name ?? 'En espera' }}                                
                        @endif

                    </th>
                    <form id="form-viajes" method="POST" action="/admin/update">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="id_viaje" value="{{$viaje->id}}">
                        <input type="hidden" name="key" value="{{ $key }}">
                        <td>
                            <input type="text" name="fecha_salida{{ $key }}" style="border: none; background-color: transparent; width: 125px; text-align: center;" class="px-2 py-1 text-gray-900" value="{{ \Carbon\Carbon::parse($viaje->fecha_salida)->format('d/m/y') }}">
                        </td>
                        <td>
                            <input type="text" name="origen{{ $key }}" style="border: none; background-color: transparent; width: 125px; text-align: center;" class="px-2 py-1 text-gray-900" value="{{ $viaje->origen }}">
                        </td>
                        <td>
                            <input type="text" name="fecha_llegada{{ $key }}" style="border: none; background-color: transparent; width: 125px; text-align: center;" class="px-2 py-1 text-gray-900" value="{{ \Carbon\Carbon::parse($viaje->fecha_llegada)->format('d/m/y') }}">
                        </td>
                        <td class="px-6 py-4  text-gray-900" name="km_viaje">{{ $viaje->km_viaje }}
                        <td>
                            <input type="text" name="destino{{ $key }}" style="border: none; background-color: transparent; width: 125px; text-align: center;" class="px-2 py-1 text-gray-900" value="{{ $viaje->destino }}">
                        </td>
                        <td class="px-6 py-4  text-gray-900">{{ $viaje->km_salida }}</td>
                        <td class="px-6 py-4  text-gray-900">{{ $viaje->c_porte }}</td>
                        <td class="px-6 py-4  text-gray-900">{{ $viaje->producto }}</td>
                        <td class="px-6 py-4  text-gray-900">{{ $viaje->carga_kg }}</td>
                        <td class="px-6 py-4  text-gray-900">{{ $viaje->descarga_kg }}</td>
                        <td class="px-6 py-4  text-gray-900">{{ $viaje->km_llegada }}</td>
                        <td class="px-6 py-4  text-gray-900">{{ $viaje->control_desc }}</td>
                        <td class="px-6 py-4  text-gray-900">{{ $viaje->km_1_2 }}</td>
                        <td>
                            <input type="text" name="patente{{ $key }}" style="border: none; background-color: transparent; width: 125px; text-align: center;" class="px-2 py-1 text-gray-900" value="{{ $viaje->patente }}">
                        </td>
                        <td>
                            <input type="text" name="batea{{ $key }}" style="border: none; background-color: transparent; width: 125px; text-align: center;" class="px-2 py-1 text-gray-900" value="{{ $viaje->batea }}">
                        </td>
                        <td class="px-6 py-4  text-gray-900"><a href="#" data-modal-toggle="modalCombustible{{ $key }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline" id="verMasLink">Ver más</a></td>   
                        <td class="px-6 py-4  text-gray-900"><a href="#" data-modal-toggle="modalGastos{{ $key }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline" id="verMasLink2" style="white-space: nowrap;">Ver más</a></td>       
                        <td class="px-6 py-4  text-gray-900 flex items-center space-x-3">
                                <button type="submit" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Actualizar</button>
                            </form>
            
                            <a href="#" data-modal-toggle="modalEliminar{{ $key }}" class="font-medium text-red-600 dark:text-red-500 hover:underline">Eliminar</a>
                        </td>
                    
                </tr>

                <div id="modalEliminar{{ $key }}" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full">
                    <div class="relative p-4 w-full max-w-md max-h-full">
                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                            <div class="p-4 md:p-5 text-center">
                                <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                </svg>
                                <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">¿Está seguro que quiere eliminar este viaje?</h3>
                                
                                <form action="/admin/cancelar/{{$viaje->id}}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center me-2">
                                        Si, estoy seguro
                                    </button>
                                </form>
                                
                                <button data-modal-toggle="modalEliminar{{ $key }}" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">No, cancelar</button>
                            </div>
                        </div>
                    </div>
                </div>

            <!-- Main modal -->
            <div id="modalCombustible{{ $key }}" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full">
                <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
                    <!-- Modal content -->
                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                        <!-- Modal header -->
                        <div class="flex justify-between items-start p-5 rounded-t border-b dark:border-gray-600">
                            <h3 class="text-xl font-semibold text-gray-900 lg:text-2xl dark:text-white">
                                Combustible
                            </h3>
                            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="modalCombustible{{$key}}">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>  
                            </button>
                        </div>
                        <!-- Modal body -->
                        <div class="p-6 space-y-6 text-justify text-lg font-medium text-gray-800">
                            @if(count($viaje->combustibles) > 0)
                                <ul class="list-disc list-inside">
                                    @foreach($viaje->combustibles as $combustible)
                                        <li><span class="font-bold">Km:</span> {{$combustible->Km}}</li>
                                        <li><span class="font-bold">Fecha:</span> {{$combustible->fecha}}</li>
                                        <li><span class="font-bold">Litros:</span> {{$combustible->litros}}</li>
                                        <li><span class="font-bold">Lugar de carga:</span> {{$combustible->lugar_carga}}</li>
                                        <hr class="my-2 border-t border-gray-300">
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
            <div id="modalGastos{{ $key }}" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full">
                <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
                    <!-- Modal content -->
                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                        <!-- Modal header -->
                        <div class="flex justify-between items-start p-5 rounded-t border-b dark:border-gray-600">
                            <h3 class="text-xl font-semibold text-gray-900 lg:text-2xl dark:text-white">
                                Gastos Extra
                            </h3>
                            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="modalGastos{{ $key }}">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>  
                            </button>
                        </div>
                        <!-- Modal body -->
                        <div class="p-6 space-y-6 text-justify text-lg font-medium text-gray-800">
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