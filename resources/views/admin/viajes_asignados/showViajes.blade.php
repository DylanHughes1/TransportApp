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
                            <div class="flex">
                                <div class="w-1/3 mr-4 mt-8"> <!-- Columna izquierda (33% de ancho) -->
                                    <div class="mt-8">
                                        <table>
                                            <!-- Contenido de la tabla -->
                                            <thead  class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                                <tr>
                                                    <th scope="col" class="px-6 py-3">Choferes Libres</th>                                            </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($choferesLibres as $chofer)
                                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                                        <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 font-medium text-green-500">
                                                            {{ $chofer->name }}
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                            
                                            
                                        </table>
                                    </div>
                                </div>
                                <div class="w-2/3 overflow-x-auto"> <!-- Columna derecha (66% de ancho) con desplazamiento horizontal -->
                                    <div class="flex justify-end mb-4">
                                        <button data-modal-target="defaultModal" data-modal-show="defaultModal" class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-full text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover-bg:700 dark:hover:border-gray-600 dark:focus:ring-gray-700">Agregar Viaje</button>
                                    </div>
                                    <div class="overflow-x-auto">
                                        @component('components.viajesAsignadosComps.table-viajes-asignados', ['viajes' => $viajes, 'truck_drivers' => $truck_drivers])
                                        @endcomponent

                                        <hr class="my-4 border-gray-300">

                                        <!-- Main modal -->
                                        <div id="defaultModal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full">
                                            <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
                                                <!-- Modal content -->
                                                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                                    <!-- Modal header -->
                                                    <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-toggle="defaultModal">
                                                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                                        <span class="sr-only">Close modal</span>
                                                    </button>
                                                    <div class="flex justify-between items-start p-5 rounded-t border-b dark:border-gray-600">
                                                        <h3 class="text-xl font-semibold text-gray-900 lg:text-2xl dark:text-white">
                                                            Agregar Viaje
                                                        </h3>
                                                    </div>
                                                    <!-- Modal body -->
                                                    <div class="p-6 bg-white border-b border-gray-200">                           
                                    
                                                        @component('components.nuevosViajesComps.form-nuevo-viaje')
                                                        @endcomponent
                                
                                                    </div>                   
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
    
</x-admin-app-layout>