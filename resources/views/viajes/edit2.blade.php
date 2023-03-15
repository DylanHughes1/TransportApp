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

                                <label for="Km" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Indique tipo de viaje</label>
                                <select id="tipo" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option value="Si">Viaje con carga</option>
                                <option value="No">Viaje vacío</option>
                                </select> 
                            </div>
                            <div>
                                <label for="gasto" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Ingrese algun gasto extra</label>
                                <input type="text" id="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Ej. Arreglo pinchadura" required>

                            </div>
                            <div>         
                                {{-- <!-- Previous Button -->--}}
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