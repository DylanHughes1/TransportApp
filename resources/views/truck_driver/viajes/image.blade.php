@extends('layouts.template')


<x-truck_driver-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Recibo
            </h2>
        </x-slot>
        <body class="antialiased">
            <div class="relative flex items-top justify-center min-h-screen sm:items-top py-4 sm:pt-0">    
                <div class="py-12">
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6 bg-white border-b border-gray-200">               
                                
                                <form action="/truck_driver/viajes/image/{{$viaje->id}}" method="POST"  enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                
                                    <div class="flex flex-col items-center justify-center w-full space-y-6">
                                        <label class="block mb-4 text-lg font-medium text-gray-900 dark:text-white" for="default_size">Ingrese el recibo</label>
                                        <input name="image" class="block w-full mb-5 text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="image" type="file"  accept=".png, .jpg" required>

                                
                                        <div class="flex items-center justify-center">
                                            <button type="submit" name="guardar" class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Guardar</button>
                                            <a href="/truck_driver/dashboard" class="col-md-12 text-right">
                                                <button type="button" id="nextButton" class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Cancelar</button>
                                            </a>
                                        </div>
                                    </div>
                                </form>
                                             
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </body>
</x-truck-driver-app-layout>
