<x-admin-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Asignar Viajes
        </h2>
    </x-slot>

    <body class="text-center">
        <div class="relative flex items-top justify-center min-h-screen sm:items-top py-4 sm:pt-0">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="p-6 bg-white border-b border-gray-200">   
                            <div class="row mt-3">                        
                            <label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Seleccione un Chofer</label>
                                <select id="countries" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    
                                    <option selected>-</option>
                                    @foreach ($truck_drivers as $truck_driver)
                                        <option value="{{$truck_driver->id}}">{{$truck_driver->name}}</option>
                                    @endforeach
                                </select>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</x-admin-app-layout>