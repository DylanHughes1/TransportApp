@extends('layouts.template')


<x-truck_driver-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Viajes
            </h2>
        </x-slot>
        <body class="antialiased">
            <div class="relative flex items-top justify-center min-h-screen sm:items-top py-4 sm:pt-0">    
                <div class="py-12">
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                            <p class="text-center text-xl text-gray-800 font-semibold mt-4 px-2">Este mes usted realizó: {{ $totalKilometrosMesActual }} Km</p>
                            
                            @if(count($viajes) > 0)
                                
                                    @php
                                        $viajesPorMes = $viajes->groupBy(function ($viaje) {
                                            return \Carbon\Carbon::parse($viaje->fecha_salida)->format('m');
                                        });
                                    @endphp

                                    <div class="grid grid-cols-{{ count($viajesPorMes) > 1 ? '2' : '1' }} gap-6 px-6 py-4">
                    
                                    @foreach ($viajesPorMes as $mes => $viajesMes)
                                        @php
                                            setlocale(LC_TIME, 'spanish');
                                            $nombreMes = \Carbon\Carbon::parse($viajesMes->first()->fecha_salida)->formatLocalized('%B');
                                            $nombreMes = ucfirst($nombreMes);
                                        @endphp

                                      

                                        <div class="bg-gray-100 p-4 rounded-lg">
                                            <h2 class="font-semibold text-xl text-gray-800 text-center mb-2">{{ $nombreMes }}</h2>
                                            <div class="space-y-4">
                                                @foreach ($viajesMes as $viaje)
                                                
                                                    @if ($viaje->progresoSolicitud == 2)

                                                        <a href="viajes/{{$viaje->id}}" style="text-decoration:none" class="block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                                                            <h5 class="mb-2 text-base font-bold tracking-tight text-gray-900 dark:text-white text-center">Viaje {{ \Carbon\Carbon::parse($viaje->fecha_salida)->format('d/m/y') }}</h5>
                                            
                                                            @if (!$viaje->viajeInicialCreado && !$viaje->esVacio)
                                                                <p class="text-red-500 text-center">Subir viaje vacío</p>
                                                            @endif

                                                            @if ($viaje->viajeInicialCreado && $viaje->enCurso)
                                                                <p class="text-red-500 text-center">Viaje en curso</p>
                                                            @endif

                                                            @if (!$viaje->enCurso && $viaje->imagenesViajes->isEmpty() && !$viaje->esVacio)
                                                                <p class="text-red-500 text-center">Subir imagen remito</p>
                                                            @endif
                                            
                                                            @if ($viaje->esVacio)
                                                                <p class="text-green-500 text-center">Viaje vacío</p>
                                                            @endif

                                                            @if (!$viaje->enCurso && !$viaje->imagenesViajes->isEmpty() && !$viaje->esVacio)
                                                                <p class="text-green-500 text-center">Viaje finalizado</p>
                                                            @endif                                                        
                                                        </a>
                                                    @endif
                                                @endforeach
                                            </div>                                            
                                        </div>
                                    @endforeach

                                </div>
                            @else
                                <div class="p-6 font-semibold text-xl text-gray-800 leading-tight bg-white border-b border-gray-200">
                                    No hay viajes Disponibles
                                </div>
                            @endif
                        </div>
                    </div>
                    
                    
                </div>
            </div>
        </body>
</x-truck-driver-app-layout>
