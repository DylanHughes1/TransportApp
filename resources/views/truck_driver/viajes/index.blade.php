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
                            <div class="p-6 bg-white border-b border-gray-200">               
                                

                                @if(count($viajes) > 0)
                                    @foreach ($viajes as $viaje)
                                        <div>
                                            <a href="viajes/{{$viaje->id}}" style="text-decoration:none" class="block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                                                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Viaje {{$viaje->fecha_salida}}</h5>
                                            </a>
                                        </div>
                                    @endforeach
                                @else
                                        No hay viajes Disponibles
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </body>
</x-truck-driver-app-layout>
