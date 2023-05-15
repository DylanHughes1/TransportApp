<x-admin-app-layout>
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
                        <div class="p-6 bg-white border-b border-gray-200">                           
                            <a href="create" style="text-decoration:none" class="block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow-md hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Cargar Viajes</h5>
                            </a>

                        </div>
                        <div class="p-6 bg-white border-b border-gray-200">    
                            <a href="viajes" style="text-decoration:none" class="block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow-md hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Asignar Viajes</h5>
                            </a>                                 
                        </div>
                        <div class="p-6 bg-white border-b border-gray-200">    
                            <a href="show" style="text-decoration:none" class="block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow-md hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Ver Viajes Asignados</h5>
                            </a>                                 
                        </div>
                        <div class="p-6 bg-white border-b border-gray-200">    
                            <a href="planilla" style="text-decoration:none" class="block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow-md hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Ver Planilla</h5>
                            </a>                                 
                        </div>
                        <div class="p-6 bg-white border-b border-gray-200">    
                            <a href="sueldo" style="text-decoration:none" class="block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow-md hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Calcular Sueldo</h5>
                            </a>                                 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</x-admin-app-layout>