<x-admin-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Ver Viajes
        </h2>
    </x-slot>

    <body class="text-center">
        <div class="relative flex items-top justify-center min-h-screen sm:items-top py-4 sm:pt-0">
            <div class="max-w-8xl mx-auto sm:px-6 lg:px-4">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="p-6 bg-white border-b border-gray-200">
                            <div class="flex">
                                <div class="w-1/7 mr-4 mt-8"> <!-- Columna izquierda (33% de ancho) -->
                                    <div class="mt-8">
                                        <div class="max-h-96 overflow-y-auto">
                                            <table>
                                                <!-- Contenido de la tabla -->
                                                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                                    <tr>
                                                        <th scope="col" class="px-6 py-3">Choferes Libres</th>
                                                    </tr>
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
                                </div>
                                <div class="w-6/7 overflow-x-auto"> <!-- Columna derecha (66% de ancho) con desplazamiento horizontal -->
                                    
                                    <div class="flex justify-end mb-4">
                                        <button data-modal-target="defaultModal" data-modal-show="defaultModal" class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-full text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover-bg:700 dark:hover:border-gray-600 dark:focus:ring-gray-700">Agregar Viaje</button>
                                    </div>
                                    <div class="overflow-x-auto">
                                        @component('components.viajesAsignadosComps.table-viajes-asignados', ['viajes' => $viajes, 'choferesLibres' => $choferesLibres, 'choferes' => $choferes])
                                        @endcomponent

                                        <hr class="my-4 border-gray-300">

                                       <!-- Main modal -->
                                        <div id="defaultModal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                            <div class="relative w-full max-w-2xl max-h-full">
                                                <!-- Modal content -->
                                                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                                    <!-- Modal header -->
                                                    <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                                                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                                            Agregar Viaje
                                                        </h3>
                                                        <button type="button" class="hidden text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="Modal">
                                                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                            </svg>
                                                            <span class="sr-only">Close modal</span>
                                                        </button>
                                                    </div>
                                                    <!-- Modal body -->
                                                    <div class="p-6 bg-white border-b border-gray-200">                           
                                    
                                                        @component('components.nuevosViajesComps.form-nuevo-viaje', ['inputs_editables' => $inputs_editables])
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