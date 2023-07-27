@extends('layouts.template')


<x-truck_driver-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Remito
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
                                        <label class="block mb-4 text-lg font-medium text-gray-900 dark:text-white" for="default_size">Ingrese imagen del remito</label>
                                        
                                        <input name="image1" class="block w-full mb-5 text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="image1" type="file"  accept=".png, .jpg" required>
                                        <input name="image2" class="block w-full mb-5 text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="image2" type="file"  accept=".png, .jpg">
                                        <input name="image3" class="block w-full mb-5 text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="image3" type="file"  accept=".png, .jpg">

                                        <div class="flex items-center justify-center">
                                            <button type="submit" name="guardar" class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Guardar</button>
                                            <a href="/truck_driver/dashboard" class="col-md-12 text-right">
                                                <button type="button" id="nextButton" class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Cancelar</button>
                                            </a>
                                        </div>
                                    </div>
                                </form>
                                <div class="flex p-4 mb-4 text-sm text-yellow-800 rounded-lg bg-yellow-50 dark:bg-gray-800 dark:text-yellow-300" role="alert">
                                    <svg aria-hidden="true" class="flex-shrink-0 inline w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                                    <span class="sr-only">Info</span>
                                    <div>
                                        En caso de necesitar subir mas imágenes, guarda las primeras
                                        <br>
                                        tres y luego repita con las restantes.
                                    </div>
                                </div>       
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </body>
</x-truck-driver-app-layout>
