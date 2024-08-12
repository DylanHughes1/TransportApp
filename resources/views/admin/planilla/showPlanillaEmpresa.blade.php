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
                                <table
                                    class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 text-center">
                                    <caption class="text-lg text-center font-bold mb-2">Don Mario</caption>
                                    <thead
                                        class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
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
                                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                            <td
                                                class="px-6 py-4 whitespace-no-wrap text-sm leading-5 font-medium text-green-500">
                                                {{ ucfirst(\Carbon\Carbon::now()->locale('es')->monthName) }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 font-medium text-green-500"
                                                style="white-space: nowrap;">
                                                {{ $kms_MesDonMario }} Kms
                                            </td>
                                            <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 font-medium text-green-500"
                                                style="white-space: nowrap;">
                                                $ {{ $facturado_MesDonMario }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 font-medium text-green-500"
                                                style="white-space: nowrap;">
                                                {{ $kms_promedio_cargadoDonMario }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 font-medium text-green-500"
                                                style="white-space: nowrap;">
                                                {{ $kms_total_cargadoDonMario }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 font-medium text-green-500"
                                                style="white-space: nowrap;">
                                                {{ $porcentaje_cargadoDonMario ?? 0 }}%
                                            </td>
                                        </tr>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="p-6 bg-white border-b border-gray-200 px-2 flex-grow">
                                <table
                                    class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 text-center">
                                    <caption class="text-lg text-center font-bold mb-2">Cereal Flet Sur</caption>
                                    <thead
                                        class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
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
                                            <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 font-medium text-green-500"
                                                style="white-space: nowrap;">
                                                {{ ucfirst(\Carbon\Carbon::now()->locale('es')->monthName) }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 font-medium text-green-500"
                                                style="white-space: nowrap;">
                                                {{ $kms_MesCerealFletSur }} Kms
                                            </td>
                                            <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 font-medium text-green-500"
                                                style="white-space: nowrap;">
                                                $ {{ $facturado_MesCerealFletSur }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 font-medium text-green-500"
                                                style="white-space: nowrap;">
                                                {{ $kms_promedio_cargadoCerealFletSur }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 font-medium text-green-500"
                                                style="white-space: nowrap;">
                                                {{ $kms_total_cargadoCerealFletSur }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 font-medium text-green-500"
                                                style="white-space: nowrap;">
                                                {{ $porcentaje_cargadoCerealFletSur ?? 0 }}%

                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="p-6 bg-white border-b border-gray-200 px-2 mx-auto w-1/2">
                            <table
                                class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 text-center">
                                <caption class="text-lg text-center font-bold mb-2">Total</caption>
                                <thead
                                    class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
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
                                        <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 font-medium text-green-500"
                                            style="white-space: nowrap;">
                                            {{ ucfirst(\Carbon\Carbon::now()->locale('es')->monthName) }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 font-medium text-green-500"
                                            style="white-space: nowrap;">
                                            {{ $kms_MesCerealFletSur + $kms_MesDonMario}} Kms
                                        </td>
                                        <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 font-medium text-green-500"
                                            style="white-space: nowrap;">
                                            $ {{ $facturado_MesCerealFletSur + $facturado_MesDonMario}}
                                        </td>
                                        <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 font-medium text-green-500"
                                            style="white-space: nowrap;">
                                            @php
                                                $kms_promedio_cargadoCerealFletSur = is_numeric($kms_promedio_cargadoCerealFletSur) ? $kms_promedio_cargadoCerealFletSur : 0;
                                                $kms_promedio_cargadoDonMario = is_numeric($kms_promedio_cargadoDonMario) ? $kms_promedio_cargadoDonMario : 0;
                                            @endphp
                                            {{ $kms_promedio_cargadoCerealFletSur + $kms_promedio_cargadoDonMario }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 font-medium text-green-500"
                                            style="white-space: nowrap;">
                                            @php
                                                $kms_total_cargadoCerealFletSur = is_numeric($kms_total_cargadoCerealFletSur) ? $kms_total_cargadoCerealFletSur : 0;
                                                $kms_total_cargadoDonMario = is_numeric($kms_total_cargadoDonMario) ? $kms_total_cargadoDonMario : 0;
                                            @endphp
                                            {{ $kms_total_cargadoCerealFletSur + $kms_total_cargadoDonMario }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 font-medium text-green-500"
                                            style="white-space: nowrap;">
                                            @php
                                                $porcentaje_cargadoCerealFletSur = is_numeric($porcentaje_cargadoCerealFletSur) ? $porcentaje_cargadoCerealFletSur : 0;
                                                $porcentaje_cargadoDonMario = is_numeric($porcentaje_cargadoDonMario) ? $porcentaje_cargadoDonMario : 0;
                                            @endphp
                                            {{ $porcentaje_cargadoCerealFletSur + $porcentaje_cargadoDonMario }}%
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