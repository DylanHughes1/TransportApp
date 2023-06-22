<x-admin-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Asignar Viajes
        </h2>
    </x-slot>

    <body class="text-center">
        <div class="relative flex items-top justify-center min-h-screen sm:items-top py-4 sm:pt-0">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="p-6 bg-white border-b border-gray-200">   
                            <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
                            <meta name="csrf-token" content="{{ csrf_token() }}">

                            <form method="POST" action="/admin/viajes">
                                @csrf
                            
                                <div class="grid grid-cols-1 gap-4 row mt-3">

                                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

                                    <div>
                                        <label for="choferes" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Seleccione un Chofer</label>                                    
                                        <select id="choferes" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">                                  
                                            <option value="-" selected>-</option>
                                            @foreach ($truck_drivers as $truck_driver)
                                                <option value="{{$truck_driver->id}}" id="{{$truck_driver->id}}" name="truck_driver_id">{{$truck_driver->name}}</option>
                                            @endforeach
                                        </select> 
                                    </div>

                                    <script>
                                        $('#choferes').on('change', function() {                                      
                                            if (this.value != '-') {
                                                $("#" + "myForm").show();                                             
                                            }                                       
                                        });
                                    </script>

                                    @if(count($viajes_inicial) > 0)
                                        <div>
                                            <label for="viajes" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Seleccione un Viaje para Asignar</label>                                    
                                            <select id="viajes" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">                                  
                                                <option selected>-</option>
                                                @foreach ($viajes_inicial as $viaje_inicial)
                                                    <option value="{{$viaje_inicial->id}}">{{$viaje_inicial->dia1}}</option>
                                                @endforeach
                                            </select> 
                                        </div>
                                    
                                    <hr class="my-4 border-gray-300">


                                    @component('components.nuevosViajesComps.form-nuevo-viaje2', ['viaje_inicial' => $viaje_inicial, 'truck_driver' => $truck_driver])
                                    @endcomponent
                                                                                
                                    @else  
                                        <div id="myForm" class="grid grid-cols-1 gap-4" style="display:none;">
                                                    
                                            <div>
                                                <label for="Warning" class=" block mb-2 text-sm font-medium text-gray-900 dark:text-white">No hay viajes para asignar!</label>
                                            </div>
                                    @endif
                                </div>
                            </form>  
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</x-admin-app-layout>