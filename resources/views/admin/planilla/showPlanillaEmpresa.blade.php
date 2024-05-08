<x-admin-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Planilla de Empresa
        </h2>
    </x-slot>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/datepicker.min.js"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <body class="text-center">
        <div class="relative flex items-top justify-center min-h-screen sm:items-top py-4 sm:pt-0">
            <div class="max-w-9xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                                                                    
                        <div class="relative overflow-x-auto flex">
                            <div class="p-6 bg-white border-b border-gray-200 px-2 flex-grow">
                                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 text-center">
                                    <caption class="text-lg text-center font-bold mb-2">Don Mario</caption>
                                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                        <tr>
                                            <th scope="col" class="px-6 py-3">Mes</th>
                                            <th scope="col" class="px-6 py-3">Kms Totales</th>
                                            <th scope="col" class="px-6 py-3">Facturado</th>
                                            <th scope="col" class="px-6 py-3">$/KM (solo cargado) Promedio</th>
                                            <th scope="col" class="px-6 py-3">$/KM (total) Promedio</th>
                                            <th scope="col" class="px-6 py-3">%Cargado Promedio</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                            <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 font-medium text-green-500">
                                                Mayo
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="p-6 bg-white border-b border-gray-200 px-2 flex-grow">
                                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 text-center">
                                    <caption class="text-lg text-center font-bold mb-2">Cereal Flet Sur</caption>
                                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                        <tr>
                                            <th scope="col" class="px-6 py-3">Mes</th>
                                            <th scope="col" class="px-6 py-3">Kms Totales</th>
                                            <th scope="col" class="px-6 py-3">Facturado</th>
                                            <th scope="col" class="px-6 py-3">$/KM (solo cargado) Promedio</th>
                                            <th scope="col" class="px-6 py-3">$/KM (total) Promedio</th>
                                            <th scope="col" class="px-6 py-3">%Cargado Promedio</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                            <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 font-medium text-green-500">
                                                Mayo
                                            </td>
                                            <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 font-medium text-green-500">
                                                10000
                                            </td>
                                            <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 font-medium text-green-500">
                                                500000
                                            </td>
                                            <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 font-medium text-green-500">
                                                60000
                                            </td>
                                            <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 font-medium text-green-500">
                                                44000
                                            </td>
                                            <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 font-medium text-green-500">
                                                87
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="p-6 bg-white border-b border-gray-200 px-2 mx-auto w-1/2">
                            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 text-center">
                                <caption class="text-lg text-center font-bold mb-2">Total</caption>
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">Mes</th>
                                        <th scope="col" class="px-6 py-3">Kms Totales</th>
                                        <th scope="col" class="px-6 py-3">Facturado</th>
                                        <th scope="col" class="px-6 py-3">$/KM (solo cargado) Promedio</th>
                                        <th scope="col" class="px-6 py-3">$/KM (total) Promedio</th>
                                        <th scope="col" class="px-6 py-3">%Cargado Promedio</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 font-medium text-green-500">
                                            Mayo
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