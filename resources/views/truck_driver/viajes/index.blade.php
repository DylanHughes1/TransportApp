@extends('layouts.template')


<x-truck_driver-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Viajes
        </h2>
    </x-slot>

    <body class="antialiased">
        <div class="relative flex items-top justify-center min-h-screen py-4 sm:items-start sm:pt-0">
            <div class="w-full px-4 py-8 sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                    <p class="text-center text-lg sm:text-xl text-gray-800 font-semibold mt-4 px-2">
                        Este mes usted realizó: {{ $totalKilometrosMesActual }} Km
                    </p>

                    @if(count($viajes) > 0)
                    @php
                    $viajesPorMes = $viajes->groupBy(function ($viaje) {
                    return \Carbon\Carbon::parse($viaje->fecha_salida)->format('m');
                    });
                    @endphp

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 px-4 py-6">
                        @foreach ($viajesPorMes as $mes => $viajesMes)
                        @php
                        setlocale(LC_TIME, 'spanish');
                        $nombreMes = ucfirst(\Carbon\Carbon::parse($viajesMes->first()->fecha_salida)->monthName);
                        @endphp

                        <div class="bg-gray-100 p-4 rounded-lg shadow">
                            <h2 class="font-semibold text-lg sm:text-xl text-gray-800 text-center mb-4">{{ $nombreMes }}</h2>
                            <div class="space-y-4">
                                @foreach ($viajesMes as $viaje)
                                @if ($viaje->progresoSolicitud == 2)
                                <a href="viajes/{{$viaje->id}}"
                                    class="block p-4 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700 transition-all">
                                    <h5 class="text-base font-bold text-center text-gray-900 dark:text-white mb-1">
                                        Viaje {{ \Carbon\Carbon::parse($viaje->fecha_salida)->format('d/m/y') }}
                                    </h5>
                                    <h5 class="text-sm font-semibold text-center text-gray-700 dark:text-gray-300 mb-2">
                                        De {{ $viaje->origen->nombre }} a {{ $viaje->destino->nombre }}
                                    </h5>

                                    @if (!$viaje->viajeInicialCreado && !$viaje->esVacio)
                                    <p class="text-red-500 text-sm text-center">Subir viaje vacío</p>
                                    @endif

                                    @if ($viaje->viajeInicialCreado && $viaje->enCurso)
                                    <p class="text-red-500 text-sm text-center">Viaje en curso</p>
                                    @endif

                                    @if (!$viaje->enCurso && $viaje->imagenesViajes->isEmpty() && !$viaje->esVacio)
                                    <p class="text-red-500 text-sm text-center">Subir imagen remito</p>
                                    @endif

                                    @if ($viaje->esVacio)
                                    <p class="text-green-500 text-sm text-center">Viaje vacío</p>
                                    @endif

                                    @if (!$viaje->enCurso && !$viaje->imagenesViajes->isEmpty() && !$viaje->esVacio)
                                    <p class="text-green-500 text-sm text-center">Viaje finalizado</p>
                                    @endif
                                </a>
                                @endif
                                @endforeach
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @else
                    <div class="p-6 text-center font-semibold text-lg text-gray-800 bg-white border-t border-gray-200">
                        No hay viajes disponibles
                    </div>
                    @endif
                </div>
            </div>
        </div>

        @include('components.spinner')
        @vite(['resources/scripts/Spinner/Spinner.js'])
    </body>
    </x-truck-driver-app-layout>