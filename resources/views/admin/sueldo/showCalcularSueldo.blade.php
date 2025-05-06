<x-admin-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Calcular Sueldo: {{$truck_driver->name}}
        </h2>
    </x-slot>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">

                    <div class="flex flex-col px-4 py-3 space-y-3 lg:flex-row lg:items-center lg:justify-between lg:space-y-0 lg:space-x-4">
                        <div class="flex items-center flex-1 space-x-4">

                            @php
                            // Establecer la configuración regional en español
                            setlocale(LC_TIME, 'spanish');

                            // Obtener el nombre del mes actual en español
                            $mesActual = ucfirst(strftime('%B'));
                            @endphp
                            <h5>
                                <span class="text-gray-500">Fecha:</span>
                                <span class="dark:text-white">{{ $mesActual }} de {{ date('Y') }}</span>
                            </h5>
                            <h5>
                                <span class="text-gray-500">Kilómetros:</span>
                                <span class="dark:text-white">{{ number_format($sumaKilometros, 2, ',', '.') }}</span>
                            </h5>
                        </div>

                        <div class="flex justify-end mb-4">


                        </div>
                    </div>

                    <div class="flex justify-end mb-4 mr-4">
                        <button data-modal-target="modalFilaTabla1" data-modal-show="modalFilaTabla1" class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-full text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">Agregar Fila</button>

                        <!-- Main modal -->
                        <div id="modalFilaTabla1" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full">
                            <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
                                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                    <div class="flex justify-between items-start p-5 rounded-t border-b dark:border-gray-600">
                                        <h3 class="text-xl font-semibold text-gray-900 lg:text-2xl dark:text-white">
                                            Agregar Fila
                                        </h3>
                                    </div>
                                    <div class="p-6 space-y-6 text-center text-lg font-medium text-gray-800">
                                        <form action="/admin/sueldo/filaNuevaTabla1/{{$truck_driver->id}}" method="POST">
                                            @csrf
                                            <input type="text" name="nombre" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 mb-4" placeholder="Nombre" required>
                                            <input type="text" name="valor" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 mb-4" placeholder="Valor" required>

                                            <div class="flex justify-center">
                                                <button type="submit" class="px-4 py-2 mr-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 dark:bg-blue-800 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Aceptar</button>
                                                <button type="button" class="px-4 py-2 text-sm font-medium text-white bg-red-600 rounded-lg hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 dark:bg-blue-800 dark:hover:bg-blue-700 dark:focus:ring-blue-800" data-modal-hide="modalFilaTabla1">Cancelar</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        @component('admin.sueldo.sueldosComps.tabla1', ['datos' => $datos, 'tabla1' => $tabla1, 'tabla2' => $tabla2, 'truck_driver' => $truck_driver])
                        @endcomponent
                    </div>

                    {{-- ---------------------------------------------------------------------------------------- --}}
                    <hr class="h-px my-8 bg-gray-200 border-0 dark:bg-gray-700">

                    <div class="flex justify-end mb-4 mr-4">

                    </div>

                    <hr class="h-px my-8 bg-gray-200 border-0 dark:bg-gray-700">

                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        @component('admin.sueldo.sueldosComps.tabla2', ['datos' => $datos, 'tabla1' => $tabla1, 'tabla2' => $tabla2, 'truck_driver' => $truck_driver])
                        @endcomponent
                    </div>

                    {{-- ---------------------------------------------------------------------------------------- --}}
                    <hr class="h-px my-8 bg-gray-200 border-0 dark:bg-gray-700">

                    <div class="flex justify-end mb-4 mr-4">
                        <button data-modal-target="modalFilaTabla3" data-modal-show="modalFilaTabla3" class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-full text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">Agregar Fila</button>

                        <!-- Main modal -->
                        <div id="modalFilaTabla3" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full">
                            <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
                                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                    <div class="flex justify-between items-start p-5 rounded-t border-b dark:border-gray-600">
                                        <h3 class="text-xl font-semibold text-gray-900 lg:text-2xl dark:text-white">
                                            Agregar Fila
                                        </h3>
                                    </div>
                                    <div class="p-6 space-y-6 text-center text-lg font-medium text-gray-800">
                                        <form action="/admin/sueldo/filaNuevaTabla3/{{$truck_driver->id}}" method="POST">
                                            @csrf
                                            <input type="text" name="nombre" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 mb-4" placeholder="Nombre" required>
                                            <input type="text" name="valor" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 mb-4" placeholder="Valor" required>

                                            <div class="flex justify-center">
                                                <button type="submit" class="px-4 py-2 mr-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 dark:bg-blue-800 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Aceptar</button>
                                                <button type="button" class="px-4 py-2 text-sm font-medium text-white bg-red-600 rounded-lg hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 dark:bg-blue-800 dark:hover:bg-blue-700 dark:focus:ring-blue-800" data-modal-hide="modalFilaTabla3">Cancelar</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        @component('admin.sueldo.sueldosComps.tabla3', ['datos' => $datos, 'tabla1' => $tabla1, 'tabla2' => $tabla2, 'tabla3' => $tabla3, 'truck_driver' => $truck_driver])
                        @endcomponent
                    </div>

                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <label for="blank" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">&nbsp;</label>

                        <div class="relative overflow-x-auto shadow-md">
                            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 border border-gray-300">
                                <tbody>
                                <tfoot>
                                    <tr class="font-semibold border-b bg-green-200 dark:bg-gray-800 text-gray-900 dark:text-white">
                                        <th scope="row" class="px-6 py-4 text-base">TOTAL A DEPOSITAR</th>
                                        <td class="px-6 py-3"></td>
                                        <td class="px-6 py-3"></td>
                                        <td class="px-6 py-3"></td>
                                        <td class="px-6 py-3"></td>
                                        <td class="px-6 py-3">

                                        <td id="total_depositar" class="px-6 py-3 text-center text-base">{{$tabla2->subtotal2 - $tabla3->total_remun2 - $tabla3->adelantos - $tabla3->celular - $tabla3->gastos}}</td>
                                    </tr>
                                </tfoot>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</x-admin-app-layout>