{{-- @extends('layouts.template') --}}

<x-truck_driver-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ Auth::user()->name }}
        </h2>
    </x-slot>

    <body class="text-center">
        <div class="relative flex items-top justify-center min-h-screen sm:items-top py-4 sm:pt-0">

            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">

                        <a href="solicitudes" style="text-decoration:none"
                            class="text-center block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow-md hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Ver
                                Solicitudes</h5>
                            @if ($cantidadSolicitudes > 0)
                                <p class="font-normal text-red-500">
                                    @if ($cantidadSolicitudes == 1)
                                        {{ $cantidadSolicitudes }} solicitud pendiente
                                    @else
                                        {{ $cantidadSolicitudes }} solicitudes pendientes
                                    @endif
                                </p>
                            @else
                                <p class="font-normal text-green-500 dark:text-gray-400">No hay solicitudes pendientes.</p>
                            @endif
                        </a>

                    </div>
                    <div class="p-6 bg-white border-b border-gray-200">
                        <a href="viajes" style="text-decoration:none"
                            class="text-center block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow-md hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Ver Viajes
                            </h5>
                            <p class="font-normal text-gray-700 dark:text-gray-400">Viajes realizados</p>
                        </a>
                    </div>

                    <div class="p-6 bg-white border-b border-gray-200">
                        <a href="perfil" style="text-decoration:none"
                            class="text-center block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow-md hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Ver Información Personal
                            </h5>
                            <p class="font-normal text-gray-700 dark:text-gray-400">Empresa, Patente</p>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </body>
    </x-truck-driver-app-layout>

    </body>

    </html>