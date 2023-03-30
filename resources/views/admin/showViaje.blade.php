<x-admin-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Viajes de {{$truck_driver->name}}
        </h2>
    </x-slot>

    <body class="text-center">
        <div class="relative flex items-top justify-center min-h-screen sm:items-top py-4 sm:pt-0">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="p-6 bg-white border-b border-gray-200">   
                            <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

                              <div class="overflow-x-auto">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th class="px-6 py-2 ">Fecha Salida</th>
                                        <th class="px-6 py-2 ">Origen</th>
                                        <th class="px-6 py-2 ">Km Viaje</th>
                                        <th class="px-6 py-2 ">Destino</th>
                                        <th class="px-6 py-2 ">KM Salida</th>
                                        <th class="px-6 py-2 ">C/Porte</th>
                                        <th class="px-6 py-2 ">Producto</th>
                                        <th class="px-6 py-2 ">Carga (Kg)</th>
                                        <th class="px-6 py-2 ">Descarga (Kg)</th>
                                        <th class="px-6 py-2 ">Control Descarga</th>
                                        <th class="px-6 py-2 ">KM 1.2</th>
                                        <th class="px-6 py-2 ">KM Vacíos</th>
                                        <th class="px-6 py-2 ">Gasto en Peaje</th>

                                    </tr>
                                    </thead>
                                    <tbody class="border divide-y divide-gray-200">
                                    @foreach ($viajes as $viaje)
                                        <tr>
                                        <td class="px-6 py-2 ">{{ $viaje->fecha_salida }}</td>
                                        <td class="px-6 py-2 ">{{ $viaje->origen }}</td>
                                        <td class="px-6 py-2 ">{{ $viaje->fecha_llegada }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div> 

                           

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</x-admin-app-layout>