<x-truck_driver-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Viaje {{$viaje->fecha_salida}}
            </h2>
        </x-slot>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">               
                        
                        <form method="POST" action="/truck_driver/viajes/{{$viaje->id}}">
                            @csrf
                            @method('PUT')
                            <div class="grid gap-6 mb-6 md:grid-cols-3">
                                <div>                                  
                                    <label for="Fecha Salida" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Fecha Salida</label>
                                    <input type="date" name="fecha_salida" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" 
                                    value="{{ $viaje->fecha_salida }}" placeholder="Año-Mes-Día" required>
                                
                                    <label for="Origen" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Origen</label>
                                    <input type="text" name="origen" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" 
                                    value="{{ $viaje->origen }}" required="false">

                                    <label for="Fecha llegada" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Fecha Llegada</label>
                                    <input type="date" name="fecha_llegada" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" 
                                    value="{{ $viaje->fecha_llegada }}" required="false">

                                    <label for="Km" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Km</label>
                                    <input type="number" name="km_viaje" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    value="{{ $viaje->km_viaje }}">
                                </div>
                                <div>
                                    <label for="destino" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Destino</label>
                                    <input type="text" name="destino" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" 
                                    value="{{ $viaje->destino }}"required="false">

                                    <label for="km_salida" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Km Salida</label>
                                    <input type="number" name="km_salida" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    value="{{ $viaje->km_salida }}">

                                    <label for="porte" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Porte</label>
                                    <input type="number" name="c_porte" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    value="{{ $viaje->porte }}">

                                    <label for="producto" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Producto</label>
                                    <input type="text" name="producto" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    value="{{ $viaje->producto }}">

                                </div>
                                <div>
                                    <label for="cargaKg" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Carga Kg</label>
                                    <input type="number" name="carga_kg" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    value="{{ $viaje->carga_kg }}">

                                    <label for="descargaKg" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Descarga Kg</label>
                                    <input type="number" name="descarga_kg" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

                                    <label for="kmLlegada" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Km Llegada</label>
                                    <input type="number" name="km_llegada" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    value="{{ $viaje->km_llegada }}">

                                    <label for="km12" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Km 1,2</label>
                                    <input type="number" name="km_1_2" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    value="{{ $viaje->km_1_2 }}">
                                    
                                    <div class="row mt-3">
                                    <!-- Next button below the grid -->
                                    <a href="b/{{$viaje->id}}" class="col-md-12 text-right">
                                        <button type="button" id="nextButton" class="btn btn-primary">Next</button>
                                    </a> 
                                                            
                                </div>
                                
                                
                                </div>
                                <div class="space-x-6">                                         
                                {{-- <button type="submit" class="btn btn-success">Finalizar</button> --}}
                                                        
                            
                                <button type="submit" class="btn btn-warning">Guardar</button>
                            </form>
                                                                    
                                    <button type="submit" class="btn btn-danger">Cancelar</button>
                            </div>
                            
                          </div>
                </div>
            </div>
        </div>
    </div>
</x-truck-driver-app-layout>
