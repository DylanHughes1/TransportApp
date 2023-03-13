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
                    
                    <form action="viajes/{{ $viaje->id }}" method="POST">
                        @csrf
                        <div class="grid gap-6 mb-6 md:grid-cols-3">
                            <div>
                                <label for="Fecha Salida" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Cargó Combustible?</label>
                                <select id="countries" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option selected>Selecione una opción</option>
                                <option value="Si">Si</option>
                                <option value="No">No</option>
                                </select>

                            </div>
                            <div>

                            </div>
                            <div>         
                                {{-- <!-- Previous Button -->--}}
                            {{-- <button onclick="window.history.back()" class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                                Anterior
                            </button> --}}
                            <a href="/truck_driver/viajes/{{$viaje->id}}" class="inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                                Anterior
                            </a>  
                            </div>                       
                            
                        </div>
                        <div class="space-x-6">                                         
                                <button type="submit" class="btn btn-success">Guardar</button>
                               
                                <button type="submit" class="btn btn-warning">Guardar</button>
                                                                
                                <button type="submit" class="btn btn-danger">Cancelar</button>
                        </div>
                        
                      </div>
                      
                </form>
            </div>
        </div>
    </div>
</div>

</x-truck-driver-app-layout>