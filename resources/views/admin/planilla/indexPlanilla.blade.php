<x-admin-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Planilla
        </h2>
    </x-slot>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

    <body class="text-center">
        <div class="relative flex items-top justify-center min-h-screen sm:items-top py-4 sm:pt-0">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">

                        @component('components.planillaComps.seleccion-chofer', ['truck_drivers' => $truck_drivers])
                        @endcomponent

                    </div>
                    <div class="relative flex items-top justify-center p-6 bg-white border-b border-gray-200">    
                            <a href="truck-drivers" style="text-decoration:none" class="block w-48 p-6 bg-white border border-gray-200 rounded-lg shadow-md hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                                <h5 class="text-center mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Planilla de Empresa</h5>
                            </a>                                 
                    </div>
                </div>
            </div>
        </div>
    </body>
</x-admin-app-layout>