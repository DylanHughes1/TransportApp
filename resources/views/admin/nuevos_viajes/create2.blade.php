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

                                        
                                    </div>
                                    
                                        <div id="myForm" class="grid grid-cols-1 gap-4" style="display:none;">
                                                
                                                <div>
                                                    <label for="dia1" class=" block mb-2 text-sm font-medium text-gray-900 dark:text-white">Fecha Salida</label>
                                                    <input type="date" id="dia1" name="dia1" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                    value="">
                                                </div>
                                                
                                                <div>
                                                    <label for="salida" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Origen</label>
                                                    <input type="text" id="salida" name="salida" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                    value="">
                                                </div>

                                                <div>
                                                    <label for="observacion" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Observación</label>
                                                    <input type="text" id="observacion" name="observacion1" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                    value="">
                                                </div>

                                                <div>
                                                    <label for="dia2" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Fecha Llegada</label>
                                                    <input type="date" id="dia2" name="dia2" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                    value="">
                                                </div>
                                                
                                                <div>
                                                    <label for="llegada" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Destino</label>
                                                    <input type="text" id="llegada" name="llegada" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                    value="">
                                                </div>

                                                <div>
                                                    <label for="observacion" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Observación</label>
                                                    <input type="text" id="observacion2" name="observacion2" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                    value="">
                                                </div>

                                                <div style="display:none;">
                                                    <label for="observacion" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Observación</label>
                                                    <input type="text" name="truck_driver_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                    value="">
                                                </div>

                                                <input type="hidden" id="TN" name="TN" value="">

                                                <input type="hidden" name="id_viaje" value="{{ $viaje_inicial->id}}">
                                                <input type="hidden" name="truck_driver_id" value="{{ $truck_driver->id}}">

                                                <div class="space-x-6">
                                                <button type="submit" class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Guardar</button>
                                        </div>  

                                        <script>
                                            $('#viajes').on('change', function() {
                                               
                                                var opcionSeleccionada = this.value;
                                                var url = 'viajes';
                                                if(opcionSeleccionada != '-'){    
                                                    $.ajax({
                                                        url: '/admin/viajes/' + opcionSeleccionada,
                                                        type: 'GET',
                                                        dataType: 'json',
                                                        success: function(data) {

                                                            document.getElementById('dia1').value = data.data.dia1;
                                                            document.getElementById('salida').value = data.data.salida;
                                                            document.getElementById('observacion').value = '';
                                                            document.getElementById('dia2').value = data.data.dia2;
                                                            document.getElementById('llegada').value = data.data.llegada;
                                                            document.getElementById('observacion2').value = '';
                                                            document.getElementById('TN').value = data.data.TN;
                                                        },
                                                        error: function(xhr, textStatus, error) {
                                                            
                                                            console.error('Error en la petición AJAX: ' + error);
                                                            console.error(xhr.responseText);             
                                                            alert('Ocurrió un error al obtener los datos del viaje seleccionado. Por favor, intenta nuevamente más tarde.');
                                                        }
                                                    });
                                                };
                                            });
                                        </script>
                                                                                  
                                    @else  
                                        <div id="myForm" class="grid grid-cols-1 gap-4" style="display:none;">
                                                    
                                            <div>
                                                <label for="Warning" class=" block mb-2 text-sm font-medium text-gray-900 dark:text-white">No hay viajes para asignar!</label>
                                            </div>
                                    @endif
                                </form>  
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</x-admin-app-layout>