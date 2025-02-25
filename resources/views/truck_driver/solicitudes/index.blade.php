<x-truck_driver-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Solicitudes
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">

                        @if ($solicitudes->isEmpty())
                        <div class="col-span-1 sm:col-span-2 lg:col-span-3 p-4 bg-white shadow-md rounded-lg dark:bg-gray-800 text-center">
                            <p class="text-gray-900 dark:text-white">No hay solicitudes disponibles.</p>
                        </div>
                        @else
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mt-6">
                            @foreach ($solicitudes as $key => $solicitud)
                            <div class="p-4 bg-white shadow-md rounded-lg dark:bg-gray-800 text-center">
                                <div class="mb-2">
                                    <span class="font-semibold text-gray-700 dark:text-gray-400">Fecha Salida:</span>
                                    <span
                                        class="text-gray-900 dark:text-white">{{ \Carbon\Carbon::parse($solicitud->dia1)->format('d/m/y') }}</span>
                                </div>
                                <div class="mb-2">
                                    <span class="font-semibold text-gray-700 dark:text-gray-400">Origen:</span>
                                    <span class="text-gray-900 dark:text-white"> {{$solicitud->salida}}</span>
                                </div>
                                <div class="mb-2">
                                    <span class="font-semibold text-gray-700 dark:text-gray-400">Observación
                                        Salida:</span>
                                    <span class="text-gray-900 dark:text-white"> {{$solicitud->observacion1}}</span>
                                </div>
                                <div class="mb-2">
                                    <span class="font-semibold text-gray-700 dark:text-gray-400">Fecha Llegada:</span>
                                    <span
                                        class="text-gray-900 dark:text-white">{{ \Carbon\Carbon::parse($solicitud->dia2)->format('d/m/y') }}</span>
                                </div>
                                <div class="mb-2">
                                    <span class="font-semibold text-gray-700 dark:text-gray-400">Destino:</span>
                                    <span class="text-gray-900 dark:text-white"> {{$solicitud->llegada}}</span>
                                </div>
                                <div class="mb-2">
                                    <span class="font-semibold text-gray-700 dark:text-gray-400">Observación
                                        Llegada:</span>
                                    <span class="text-gray-900 dark:text-white"> {{$solicitud->observacion2}}</span>
                                </div>
                                <div class="flex justify-center gap-4 mt-2">
                                    <form method="POST" action="/truck_driver/solicitudes/{{$solicitud->id}}"
                                        class="inline-block">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="truckdriver_id" value="{{ Auth::id() }}">
                                        <button type="submit"
                                            class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Aceptar</button>
                                    </form>
                                    <form action="/truck_driver/solicitudes/{{$solicitud->id}}/cancelar" method="POST"
                                        class="inline-block">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit"
                                            class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Cancelar</button>
                                    </form>
                                </div>
                            </div>
                            @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </x-truck-driver-app-layout>