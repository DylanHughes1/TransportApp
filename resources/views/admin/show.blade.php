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
                            <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
                            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
                            

                            <div class="overflow-x-auto">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="px-6 py-2 w-32">Chofer</th>
                                            <th class="px-6 py-2 w-32">Fecha Salida</th>
                                            <th class="px-6 py-2 w-32">Origen</th>
                                            <th class="px-6 py-2 w-32">Fecha Llegada</th>
                                            <th class="px-6 py-2 w-32">Km Viaje</th>
                                            <th class="px-6 py-2 w-32">Destino</th>
                                            <th class="px-6 py-2 w-32">KM Salida</th>
                                            <th class="px-6 py-2 w-32">C/Porte</th>
                                            <th class="px-6 py-2 w-32">Producto</th>
                                            <th class="px-6 py-2 w-32">Carga (Kg)</th>
                                            <th class="px-6 py-2 w-32">Descarga (Kg)</th>
                                            <th class="px-6 py-2 w-32">Km Llegada</th>
                                            <th class="px-6 py-2 w-32">Control Descarga</th>
                                            <th class="px-6 py-2 w-32">KM 1.2</th>
                                            <th class="px-6 py-2 w-32">KM Vacíos</th>
                                            <th class="px-6 py-2 w-32">Combustible</th>
                                            <th class="px-6 py-2 w-32">Gastos Extra</th>

                                        </tr>
                                    </thead>
                                    <tbody class="border divide-y divide-gray-200">
                                        @foreach ($viajes as $viaje)
                                            @if($viaje->enCurso)

                                                <tr>
                                                    <td class="validate px-6 py-2 w-32">{{ \App\Models\TruckDriver::find($viaje->truckdriver_id)->name }}</td>
                                                    <td class="validate px-6 py-2 w-32">{{ $viaje->fecha_salida }}</td>
                                                    <td class="validate px-6 py-2 w-32">{{ $viaje->origen }}</td>
                                                    <td class="validate px-6 py-2 w-32">{{ $viaje->fecha_llegada }}</td>
                                                    <td class="validate px-6 py-2 w-32">{{ $viaje->km_viaje }}</td>
                                                    <td class="validate px-6 py-2 w-32">{{ $viaje->destino }}</td>
                                                    <td class="validate px-6 py-2 w-32">{{ $viaje->km_salida }}</td>
                                                    <td class="validate px-6 py-2 w-32">{{ $viaje->c_porte }}</td>
                                                    <td class="validate px-6 py-2 w-32">{{ $viaje->producto }}</td>
                                                    <td class="validate px-6 py-2 w-32">{{ $viaje->carga_kg }}</td>
                                                    <td class="validate px-6 py-2 w-32">{{ $viaje->descarga_kg }}</td>
                                                    <td class="validate px-6 py-2 w-32">{{ $viaje->km_llegada }}</td>
                                                    <td class="validate px-6 py-2 w-32">{{ $viaje->control_desc }}</td>
                                                    <td class="validate px-6 py-2 w-32">{{ $viaje->km_1_2 }}</td>
                                                    <td class="validate px-4 py-2"> {{ $viaje->km_vacios }}</td>
                                                    <td class="validate px-6 py-2 w-32"><a href="#" id="verMasLink">Ver más</a></td>   
                                                    <td class="validate px-6 py-2 w-32"><a href="#" id="verMasLink2">Ver más</a></td>                                               

                                                    <script>
                                                            $("#verMasLink").on("click", function() {                                                
                                                                $("#myModal").modal("show");
                                                            });   
                                                            
                                                            $("#verMasLink2").on("click", function() {                                                          
                                                                $("#myModal2").modal("show");
                                                            });   
                                                    </script>

                                                    <script>
                                                        // Script para chequear los campos vacíos y aplicar el estilo rojo
                                                    
                                                        window.onload = function() {
                                                                var elementos = document.getElementsByClassName("validate");
                                                                var todosVacios = true;
                                                                var cont = 0;
                                                                
                                                                for (var i = 0; i < elementos.length && todosVacios; i++) {
                                                                    console.log(elementos[i].textContent);

                                                                    if(i != 0 && i != 1 && i != 2 & i != 4 && i != 13 && i != 15 && i != 16){
                                                                        
                                                                        if (elementos[i].textContent !== null && elementos[i].textContent !== "") {
                                                                            todosVacios = false;
                                                                        }
                                                                    }
                                                                }

                                                                for (var i = 0; i < 13; i++) {                             
                                                                        if (elementos[i].textContent !== null && elementos[i].textContent !== "") {
                                                                            cont++;
                                                                        }
                                                                }
                                                                
                                                                
                                                                if (todosVacios) {
                                                                    for (var i = 0; i < elementos.length; i++) {
                                                                        elementos[i].style.backgroundColor = "red";
                                                                        elementos[i].style.color = "black";
                                                                    }
                                                                }
                                                                else if(cont < 13 && !todosVacios) {
                                                                    for (var i = 0; i < elementos.length; i++) {
                                                                        elementos[i].style.backgroundColor = "yellow";
                                                                        elementos[i].style.color = "black";
                                                                    }
                                                                }
                                                                else if(cont === 13 && !todosVacios){
                                                                    for (var i = 0; i < elementos.length; i++) {
                                                                        elementos[i].style.backgroundColor = "green";
                                                                        elementos[i].style.color = "white";
                                                                    }
                                                                }
                                                            }
                                                    
                                                    </script>

                                                    <div class="modal" tabindex="-1" role="dialog" id="myModal2">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <!-- Agrega el contenido del modal aquí -->
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Gastos Extra</h5>
                                                                </div>
                                                                <div class="modal-body">
                                                                    {{$viaje->observacion}}
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" id="button2" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>      
                                                    
                                                </tr>
							                @endIf
                                        @endforeach
                                    </tbody>
                                </table>

                                <div class="modal" tabindex="-1" role="dialog" id="myModal">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <!-- Agrega el contenido del modal aquí -->
                                            <div class="modal-header">
                                                <h5 class="modal-title">Combustible</h5>
                                            </div>
                                            <div class="modal-body">
                                                <<table class="table">
                                                    <thead>
                                                      <tr>
                                                        <th scope="col">#</th>
                                                        <th scope="col">Fecha Carga</th>
                                                        <th scope="col">Litros</th>
                                                        <th scope="col">Lleno?</th>
                                                        <th scope="col">Lugar Carga</th>
                                                      </tr>
                                                    </thead>
                                                    <tbody>
                                                      <tr>
                                                        <th scope="row">1</th>
                                                        <td>Mark</td>
                                                        <td>Otto</td>
                                                        <td>@mdo</td>
                                                      </tr>
                                                      <tr>
                                                        <th scope="row">2</th>
                                                        <td>Jacob</td>
                                                        <td>Thornton</td>
                                                        <td>@fat</td>
                                                      </tr>
                                                      <tr>
                                                        <th scope="row">3</th>
                                                        <td>Larry</td>
                                                        <td>the Bird</td>
                                                        <td>@twitter</td>
                                                      </tr>
                                                    </tbody>
                                                  </table>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" id="button1" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>    
                            
                            <script>
                                $("#button1").on("click", function() {                                                
                                    $("#myModal").modal("hide");
                                });   
                                $("#button2").on("click", function() {                                                
                                    $("#myModal2").modal("hide");
                                }); 
                                
                            </script>

                            <hr class="my-4 border-gray-300">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</x-admin-app-layout>