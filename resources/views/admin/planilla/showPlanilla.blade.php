<x-admin-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ Auth::user()->name }}
        </h2>
    </x-slot>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

    <body class="text-center">
        <div class="relative flex items-top justify-center min-h-screen sm:items-top py-4 sm:pt-0">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <h3 class="font-semibold text-xl text-gray-800 leading-tight">
                            {{ $truck_driver->name }}
                        </h3>

                        <div class="overflow-x-auto">
                            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">
                                            Fecha Salida
                                        </th>
                                        <th scope="col" class="px-6 py-3 gap 6">
                                            Origen  
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            KM
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Intermedios
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            KM
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Destino
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Fecha Llegada
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            KM
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Producto
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            KG
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Distancia
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            KM Vacíos
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            $/TN
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            FAC.
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            $/KM
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($viajes as $viaje)                                   
                                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                {{$viaje->fecha_salida}}
                                            </th>
                                            <td class="px-6 py-4">
                                                {{$viaje->origen}}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{$viaje->km_viaje}}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{$viaje->km_salida}}
                                            </td>
                                            <td class="px-6 py-4">
                                                $99
                                            </td>
                                            <td class="px-6 py-4">
                                                {{$viaje->destino}}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                {{$viaje->fecha_llegada}}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{$viaje->km_llegada}}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{$viaje->producto}}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{$viaje->carga_kg}}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{$viaje->km_llegada - $viaje->km_salida}}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{$viaje->km_vacios}}
                                            </td>
                                            <td class="px-6 py-4">
                                                $99
                                            </td>
                                            <td class="px-6 py-4">
                                                {{-- FAC.= kg * $/TN --}}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{-- $/KM = FAC/DIST --}}
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
    </body>
</x-admin-app-layout>