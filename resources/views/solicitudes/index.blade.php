<x-truck_driver-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Solicitudes
            </h2>
        </x-slot>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        
                        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        {{-- <th scope="col" class="p-4">
                                            <div class="flex items-center">
                                                <input id="checkbox-all-search" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                                <label for="checkbox-all-search" class="sr-only">checkbox</label>
                                            </div>
                                        </th> --}}
                                        <th scope="col" class="px-6 py-3">
                                            Fecha Salida
                                        </th>
                                        <th scope="col" class="px-6 py-3 gap 6">
                                            Origen  
                                        </th>

                                        <th scope="col" class="px-6 py-3">
                                            Fecha Llegada
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Destino
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Acción
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($solicitudes as $solicitud)

                                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                    {{$solicitud->dia1}}
                                                </th>
                                                <td class="px-6 py-4">
                                                    {{$solicitud->salida}}

                                                    <button id="botonOrigen" type="button" class="text-blue-700 border border-blue-700 hover:bg-blue-700 hover:text-white focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm p-2.5 text-center inline-flex items-center mr-2 dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:focus:ring-blue-800">
                                                        <svg aria-hidden="true" class="w-2 h-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                                        <span class="sr-only">Icon description</span>
                                                    </button> 

                                                    <script>
                                                        // Get the button element by its ID
                                                        const myButton = document.getElementById('botonOrigen');
                                                        
                                                        // Add a click event listener to the button
                                                        myButton.addEventListener('click', () => {
                                                            // Show the alert dialog with a message and an OK button
                                                            alert('Observaciones: {{ $solicitud->observacion1 }} ');
                                                        });
                                                    </script>

                                                </td>
                                                <td class="px-6 py-4">
                                                    {{$solicitud->dia2}}
                                                </td>
                                                <td class="px-6 py-4">
                                                    {{$solicitud->llegada}}

                                                    <button id="botonDestino" type="button" class="text-blue-700 border border-blue-700 hover:bg-blue-700 hover:text-white focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm p-2.5 text-center inline-flex items-center mr-2 dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:focus:ring-blue-800">
                                                        <svg aria-hidden="true" class="w-2 h-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                                        <span class="sr-only">Icon description</span>
                                                    </button> 

                                                    <script>
                                                        // Get the button element by its ID
                                                        const myButton2 = document.getElementById('botonDestino');
                                                        
                                                        // Add a click event listener to the button
                                                        myButton2.addEventListener('click', () => {
                                                            // Show the alert dialog with a message and an OK button
                                                            alert('Observaciones: {{ $solicitud->observacion2 }} ');
                                                        });
                                                    </script>

                                                </td>
                                                <td class="px-6 py-4 space-y-6">

                                                    <form method="POST" action="/truck_driver/solicitudes/{{$solicitud->id}}">
                                                        @csrf
                                                        @method('PUT')

                                                        <button type="submit" class="btn btn-primary">Aceptar</button>
                                                    </form>
                                                    
                                                    {{-- <form method="POST" action="{{ route('truck_driver.crearViaje', ['id' => $solicitud->id]) }}">
                                                        @csrf
                                                        @method('PUT')
                                                        <button type="submit">Call Update Function</button>
                                                    </form> --}}

                                                    <form action="/truck_driver/solicitudes/{{$solicitud->id}}" method="POST" >
                                                        @csrf
                                                        @method('DELETE')
                                                        
                                                        <button type="submit" class="btn btn-danger">Cancelar</button>
                                                    </form>

                                                    {{-- <form method="POST" action="solicitudes">
                                                        @csrf
                                                        <button type="submit" class="btn btn-success">Aceptar</button>
                                                    </form> --}}
                                                
                                                </td>
                                            </tr>
                                        
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
   
                    </div>
                </div>
            </div>
        </div>

</x-truck-driver-app-layout>

