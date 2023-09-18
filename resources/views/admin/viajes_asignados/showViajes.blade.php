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

                            <div class="flex justify-end mb-4">
                                <button data-modal-target="defaultModal" data-modal-show="defaultModal"  class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-full text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">Agregar Viaje</button>
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
    </body>
</x-admin-app-layout>