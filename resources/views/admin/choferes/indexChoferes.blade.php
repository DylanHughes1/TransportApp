<x-admin-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Choferes
        </h2>
    </x-slot>

    <body class="text-center">
        <div class="relative flex items-top justify-center min-h-screen sm:items-top py-4 sm:pt-0">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        
                          <div class="relative overflow-x-auto flex">
                            <div class=" p-6 bg-white border-b border-gray-200 px-2">
                                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 text-center">
                                <h2 class="text-lg text-center font-bold mb-2">Don Mario</h2>
                                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                        <tr>
                                            <th scope="col" class="px-6 py-3">
                                                Chofer
                                            </th>
                                            <th scope="col" class="px-6 py-3">
                                                Patente Chasis
                                            </th>
                                            <th scope="col" class="px-6 py-3">
                                                Patente Batea
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($truck_drivers_A as $key => $truck_driver)                
                                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                                    <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 font-medium text-green-500 hover:underline" 
                                                        data-popover-target="popover-A{{ $key }}" data-popover-trigger="click" data-popover-placement="top">
                                                        {{ $truck_driver->name }}
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 font-medium text-green-500">
                                                        {{ $truck_driver->p_chasis }}
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 font-medium text-green-500">
                                                        {{ $truck_driver->p_batea }}
                                                    </td>
                                                </tr>

                                                <div data-popover id="popover-A{{ $key }}" role="tooltip" class="absolute z-10 invisible inline-block text-sm text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 dark:text-gray-400 dark:border-gray-600 dark:bg-gray-800">
                                                        <div class="px-3 py-2">
                                                            <a href="#" data-modal-toggle="modalEliminar{{ $key }}" class="font-medium text-red-600 dark:text-red-500 hover:underline">Eliminar</a>
                                                        </div>
                                                    <div data-popper-arrow></div>
                                                </div>

                                                <div id="modalEliminar{{ $key }}" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full">
                                                    <div class="relative p-4 w-full max-w-md max-h-full">
                                                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                                            <div class="p-4 md:p-5 text-center">
                                                                <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                                                </svg>
                                                                <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">¿Está seguro que quiere eliminar este chofer?</h3>
                                                                
                                                                <form action="/admin/truck-drivers/{{$truck_driver->id}}" method="POST">
                                                                    @csrf
                                                                    @method('delete')
                                                                    <button type="submit" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center me-2">
                                                                        Si, estoy seguro
                                                                    </button>
                                                                </form>
                                                                
                                                                <button data-modal-toggle="modalEliminar{{ $key }}" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">No, cancelar</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

            
                            <div class="p-6 bg-white border-b border-gray-200 px-2">
                                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 text-center">
                                    <h2 class="text-lg text-center font-bold mb-2">Cereal Flet Sur</h2>
                                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                        <tr>
                                            <th scope="col" class="px-6 py-3">
                                                Patente
                                            </th>
                                            <th scope="col" class="px-6 py-3">
                                                Patente Chasis
                                            </th>
                                            <th scope="col" class="px-6 py-3">
                                                Patente Batea
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($truck_drivers_B as $key => $truck_driver)
                                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                                    <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 font-medium text-green-500 hover:underline" 
                                                        data-popover-target="popover-B{{ $key }}" data-popover-trigger="click" data-popover-placement="top">
                                                        {{ $truck_driver->name }}
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 font-medium text-green-500">
                                                        {{ $truck_driver->p_chasis }}
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 font-medium text-green-500">
                                                        {{ $truck_driver->p_batea }}
                                                    </td>
                                                </tr>

                                                 <div data-popover id="popover-B{{ $key }}" role="tooltip" class="absolute z-10 invisible inline-block text-sm text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 dark:text-gray-400 dark:border-gray-600 dark:bg-gray-800">
                                                    <div class="px-3 py-2">
                                                        <a href="#" class="font-medium text-red-600 dark:text-red-500 hover:underline">Eliminar Chofer</a>
                                                    </div>
                                                    <div data-popper-arrow></div>
                                                </div>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                           
                            <div class="p-6 bg-white border-b border-gray-200  px-2">
                                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 text-center">
                                    <h2 class="text-lg text-center font-bold mb-2" style="width: 354px;">Choferes sin Empresa</h2>
                                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                        <tr>
                                            <th scope="col" class="px-6 py-3" style="height: 56px;">
                                                Choferes
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($truck_drivers_sin_empresa as $key => $truck_driver)
                                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                                    <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 font-medium text-green-500">
                                                        <a href="#" data-modal-toggle="modalAsignar{{ $key }}" class="font-medium dark:text-red-500 hover:underline">{{ $truck_driver->name }}</a>                                                    
                                                    </td>
                                                </tr>

                                                <!-- Main modal -->
                                                <div id="modalAsignar{{ $key }}" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                                        <div class="relative p-4 w-full max-w-md max-h-full">
                                                        <!-- Modal content -->
                                                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                                            <!-- Modal header -->
                                                            <div class="flex justify-between items-start p-5 rounded-t border-b dark:border-gray-600">
                                                                <h3 class="text-xl font-semibold text-gray-900 lg:text-2xl dark:text-white">
                                                                    Asignar Empresa
                                                                </h3>
                                                                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="modalAsignar{{$key}}">
                                                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>  
                                                                </button>
                                                            </div>
                                                            <!-- Modal body -->
                                                            <div class="p-6 space-y-4 text-justify text-lg font-medium text-gray-800">
                                                                    <form method="POST" action="/admin/truck-drivers/{{$truck_driver->id}}">
                                                                        @csrf
                                                                        
                                                                        <form class="max-w-sm mx-auto">

                                                                            <div class="mb-5">
                                                                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Patente Chasis</label>
                                                                                <input type="text" name="p_chasis" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="" required />
                                                                            </div>
                                                                            <div class="mb-5">
                                                                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Patente Batea</label>
                                                                                <input type="text" name="p_batea" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required />
                                                                            </div>

                                                                            <div class="mb-5">
                                                                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Empresa</label>

                                                                                <div class="flex items-center mb-4">
                                                                                    <input type="radio" id="don-mario" name="company_name" value="Don Mario" class="mr-2 w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                                                                    <label for="don-mario" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Don Mario</label>
                                                                                </div>
                                                                                <div class="flex items-center">
                                                                                    <input type="radio" id="cereal-flet-sur" name="company_name" value="Cereal Flet Sur" class="mr-2 w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                                                                    <label for="cereal-flet-sur" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Cereal Flet Sur</label>
                                                                                </div>
                                                                            </div>
                                                                            <button class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"type="submit">Asignar</button> </form> 

                                                                        </form>
                                                            </div>        
                                                        </div>
                                                    </div>
                                                </div>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            
                        </div>

                    </div>
                    
                </div>
            </div>
        </div>
    </body>
</x-admin-app-layout>