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
                                    <label for="Fecha Salida" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Fecha Salida</label>
                                    <input type="text" id="fecha_salida" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Año-Mes-Día" required>
                                
                                    <label for="Origen" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Origen</label>
                                    <input type="text" id="origen" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
  
                                    <label for="Fecha llegada" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Fecha Llegada</label>
                                    <input type="text" id="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
 
                                    <label for="Km" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Km</label>
                                    <input type="text" id="km" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                </div>
                                <div>
                                    <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Destino</label>
                                    <input type="text" id="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
 
                                    <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Km Salida</label>
                                    <input type="text" id="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
 
                                    <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Porte</label>
                                    <input type="text" id="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
 
                                    <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Producto</label>
                                    <input type="text" id="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
 
                                </div>
                                <div>
                                    <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Carga Kg</label>
                                    <input type="text" id="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
 
                                    <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Descarga Kg</label>
                                    <input type="text" id="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
 
                                    <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Km Llegada</label>
                                    <input type="text" id="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
 
                                    <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Km 1,2</label>
                                    <input type="text" id="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                    
                                    {{-- <div class="row mt-3">
                                    <!-- Next button below the grid -->
                                    <div class="col-md-12 text-right">
                                        <button type="button" id="nextButton" class="btn btn-primary">Next</button>
                                    </div> --}}
                                    {{-- <!-- Next Button -->--}}
                                <a href="b/{{$viaje->id}}" class="inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                                    Siguiente
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

                    {{-- <!-- Previous Button -->
                    <a href="#" class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                        Previous
                    </a>
                        
                    <!-- Next Button -->
                    <a href="#" class="inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                        Next --}}
                    {{-- </a>                      --}}
                </div>
            </div>
        </div>
    </div>
    {{-- <script>
        // Get the button element by its ID
        const nextButton = document.getElementById('nextButton');
    
        // Add a click event listener to the button
        nextButton.addEventListener('click', () => {
            // Redirect to the next grid with more input data
            // window.location.href = '{{$viaje->id}}b';
            window.location.href = 'ParteDos';
        });
    </script> --}}

</x-truck-driver-app-layout>
