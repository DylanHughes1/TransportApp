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
                    
                    <form action="/truck_driver/viajes/b/{{$viaje->id}}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="grid gap-6 mb-6 md:grid-cols-3">
                            <div>
                                <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

                                <label for="Combustible" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Cargó Combustible?</label>
                                <select id="combustible" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option selected>Selecione una opción</option>
                                <option value="si">Si</option>
                                <option value="no">No</option>
                                </select>
                                {{-- <button type="submit" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#deleteModal">Si</button>
                                <button type="submit" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">No</button> --}}
                        
                                <script>
                                    $('#combustible').on('change', function() {                                      
                                            if (this.value == 'si') {
                                                $('#myModal').modal('show');                                               
                                            }                                       
                                    });
                                </script>                               

                                <label for="Peaje" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Gasto en Peaje?</label>
                                <select id="peaje" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option selected>Selecione una opción</option>
                                <option value="si">Si</option>
                                <option value="No">No</option>
                                </select>

                                <div class="hidden" id="input-oculto">
                                    <label for="Peaje" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Ingrese Monto:</label>
                                    <input type="number" name="Peaje" id="Peaje" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                </div>
                                
                                <script>
                                    $('#peaje').on('change', function() {                                      
                                            if (this.value == 'si') {
                                                $('#input-oculto').removeClass('hidden');                                              
                                            } else {
                                                $('#input-oculto').addClass('hidden');
                                            }                                     
                                    });
                                </script>

                                <label for="Km" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Indique tipo de viaje</label>
                                <select id="tipo" name="tipo_viaje" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option value="Si">Viaje con carga</option>
                                <option value="No">Viaje vacío</option>
                                </select> 
                            </div>
                            <div>
                                <label for="gasto" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Ingrese algun gasto extra</label>
                                <input type="text" id="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Ej. Arreglo pinchadura" required>

                                {{-- <!-- Previous Button -->--}}
                                <div class="row mt-3">
                                <a href="/truck_driver/viajes/{{$viaje->id}}" class="col-md-12 text-right">
                                    <button type="button" id="nextButton" class="btn btn-primary">Anterior</button>
                                </a>
                                </div>
                            </div>
                            <div>         
                                 
                            </div>                       
                            
                        </div>
                        <div class="space-x-6">                                                                
                               
                                <input type="hidden" name="finalizar" value="1">
                                <button type="submit" name="finalizar" class="btn btn-success">Finalizar</button>                                                       
                                <button type="submit" class="btn btn-warning">Guardar</button>

                                <a href="/truck_driver/viajes" class="col-md-12 text-right">
                                    <button type="button" id="nextButton" class="btn btn-danger">Cancelar</button>
                                </a>

                                @if ($errors->any())  
                                    <div class="flex p-4 mb-4 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 dark:border-red-800" role="alert">
                                        <svg aria-hidden="true" class="flex-shrink-0 inline w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                                        <span class="sr-only">Info</span>
                                        <div>
                                        <span class="font-medium">Error!</span> Debe completar todos los datos para poder continuar.
                                        </div>
                                    </div>
                                @endif
                        </form>                                      
                                
                        </div>
                        
                      </div>                      
                
            </div>
        </div>
    </div>
</div>
   {{-- Modal --}}
<div class="modal fade text-dark" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Registro Combustible </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="/truck_driver/viajes/b/{{ $viaje->id }}">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                      <label for="campo1">KM:</label>
                      <input type="number" class="form-control" id="campo1" name="Km">
                    </div>
                    <div class="form-group">
                      <label for="campo2">Fecha de carga:</label>
                      <input type="date" class="form-control" id="campo2" name="fecha">
                    </div>
                    <div class="form-group">
                        <label for="campo2">Litros:</label>
                        <input type="number" class="form-control" id="campo2" name="litros">
                      </div>
                    <div class="form-group">
                      <label for="campo2">Lugar de Carga:</label>
                      <input type="text" class="form-control" id="campo2" name="lugar_carga">
                    </div>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                  </form>
            </div>           
        </div>
    </div>
</div>
</x-truck-driver-app-layout>