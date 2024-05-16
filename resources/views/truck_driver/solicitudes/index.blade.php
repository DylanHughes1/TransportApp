<x-truck_driver-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Solicitudes
            </h2>
        </x-slot>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        
                        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

                        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">
                                            Fecha Salida
                                        </th>
                                        <th scope="col" class="px-6 py-3 gap 6">
                                            Origen  
                                        </th>

                                        <th scope="col" class="px-6 py-3">
                                            Fecha Llegada
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Destino
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Acción
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($solicitudes as $key => $solicitud)
                                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                    {{ \Carbon\Carbon::parse($solicitud->dia1)->format('d/m/y') }}
                                                </th>
                                                <td class="px-6 py-4">
                                                    {{$solicitud->salida}}

                                                    <button data-modal-toggle="myModal{{ $key }}" type="button" class="text-blue-700 border border-blue-700 hover:bg-blue-700 hover:text-white focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm p-2.5 text-center inline-flex items-center mr-2 dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:focus:ring-blue-800">
                                                        <svg aria-hidden="true" class="w-2 h-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                                        <span class="sr-only">Icon description</span>
                                                    </button> 
                                                
                                                </td>

                                                <td class="px-6 py-4">
                                                    {{ \Carbon\Carbon::parse($solicitud->dia2)->format('d/m/y') }}
                                                </td>
                                                <td class="px-6 py-4">
                                                    {{$solicitud->llegada}}

                                                    <button data-modal-toggle="myModal2{{ $key }}" type="button" class="text-blue-700 border border-blue-700 hover:bg-blue-700 hover:text-white focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm p-2.5 text-center inline-flex items-center mr-2 dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:focus:ring-blue-800">
                                                        <svg aria-hidden="true" class="w-2 h-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                                        <span class="sr-only">Icon description</span>
                                                    </button> 

                                                </td>

                                                <td class="flex items-center px-6 py-4 space-x-3">
                                                    <form method="POST" action="/truck_driver/solicitudes/{{$solicitud->id}}" class="inline-block">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" name="truckdriver_id" value="{{ Auth::id() }}">
                                                        <button type="submit" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Aceptar</button>
                                                    </form>
                                                
                                                    <form action="/truck_driver/solicitudes/{{$solicitud->id}}/cancelar" method="POST" class="inline-block">
                                                        @csrf
                                                        @method('PUT')
                                                        <button type="submit" class="font-medium text-red-600 dark:text-red-500 hover:underline">Cancelar</button> 
                                                    </form>
                                                </td>
                                            </tr>
                                            <!-- Main modal -->
                                            <div id="myModal{{ $key }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full">
                                                <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
                                                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                                        <div class="flex justify-between items-start p-5 rounded-t border-b dark:border-gray-600">
                                                            <h3 class="text-xl font-semibold text-gray-900 lg:text-2xl dark:text-white">
                                                                Observación
                                                            </h3>
                                                            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="defaultModal">
                                                            </button>
                                                        </div>
                                                        <div class="p-6 space-y-6">
                                                            {{ $solicitud->observacion1 }} 
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                    
                                            <div id="myModal2{{ $key }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full">
                                                <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
                                                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                                        <div class="flex justify-between items-start p-5 rounded-t border-b dark:border-gray-600">
                                                            <h3 class="text-xl font-semibold text-gray-900 lg:text-2xl dark:text-white">
                                                                Observación
                                                            </h3>
                                                            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="defaultModal">
                                                            </button>
                                                        </div>
                                                        <div class="p-6 space-y-6">
                                                            {{ $solicitud->observacion2 }} 
                                                        </div>      
                                                    </div>
                                                </div>
                                            </div>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
   
                    </div>
                </div>
            </div>
        </div>

</x-truck-driver-app-layout>

