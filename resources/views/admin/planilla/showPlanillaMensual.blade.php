<x-admin-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Planilla de {{ $truck_driver->name }}
        </h2>
    </x-slot>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/datepicker.min.js"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <body class="text-center">
        <div class="relative flex items-top justify-center min-h-screen sm:items-top py-4 sm:pt-0">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                                                                    
                        <div class="flex mb-4 items-center justify-end">

                            <div class="flex space-x-4">
                                <a href="/admin/planilla/{{ $truck_driver->id }}" class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-full text-sm px-5 py-2.5 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">
                                    Ir a Planilla de Viajes
                                </a>
                                <a href="export/{{ $truck_driver->id }}" class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-full text-sm px-5 py-2.5 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">
                                    Descargar Planilla
                                </a>
                            </div>
                            
                        </div>
                     
                        <div class="overflow-x-auto">
                            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">
                                            Mes
                                        </th>
                                        <th scope="col" class="px-6 py-3 gap 6">
                                            Km Recorridos
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Facturado
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Promedio $/KM solo cargado
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Promedio $/KM total
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            %Cargado
                                        </th>                                       
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ ucfirst(\Carbon\Carbon::now()->subMonth()->locale('es')->monthName) }} 
                                        </th>
                                        <td class="px-6 py-4">
                                            {{$kms_MesMesAnterior}}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{$costo_totalMesAnterior}}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{$kms_promedio_cargadoMesAnterior}}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{$kms_total_cargadoMesAnterior}}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $porcentaje_cargadoEsteMes !== null ? $porcentaje_cargadoEsteMes . '%' : '0 %' }}
                                        </td>
                                    </tr>

                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ ucfirst(\Carbon\Carbon::now()->locale('es')->monthName) }}
                                        </th>
                                        <td class="px-6 py-4">
                                            {{$kms_MesEsteMes}}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{$costo_totalEsteMes}}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{$kms_promedio_cargadoEsteMes}}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{$kms_total_cargadoEsteMes}}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $porcentaje_cargadoMesAnterior !== null ? $porcentaje_cargadoMesAnterior . '%' : '0 %' }}
                                        </td>
                                    </tr>                                    
                                </tbody>
                            </table>
                        </div> 
                    </div>
                </div>
            </div>
        </div>

</x-admin-app-layout>