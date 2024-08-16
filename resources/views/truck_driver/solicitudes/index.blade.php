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
                                        <button data-modal-toggle="myModal{{ $key }}" type="button"
                                            class="text-blue-700 hover:underline focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium text-sm dark:text-blue-500 dark:focus:ring-blue-800">
                                            {{$solicitud->salida}}
                                        </button>
                                    </div>
                                    <div class="mb-2">
                                        <span class="font-semibold text-gray-700 dark:text-gray-400">Fecha Llegada:</span>
                                        <span
                                            class="text-gray-900 dark:text-white">{{ \Carbon\Carbon::parse($solicitud->dia2)->format('d/m/y') }}</span>
                                    </div>
                                    <div class="mb-2">
                                        <span class="font-semibold text-gray-700 dark:text-gray-400">Destino:</span>
                                        <button data-modal-toggle="myModal2{{ $key }}" type="button"
                                            class="text-blue-700 hover:underline focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium text-sm dark:text-blue-500 dark:focus:ring-blue-800">
                                            {{$solicitud->llegada}}
                                        </button>
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

                                <div id="myModal{{ $key }}" tabindex="-1" aria-hidden="true"
                                    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full">
                                    <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
                                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                            <div
                                                class="flex justify-between items-start p-5 rounded-t border-b dark:border-gray-600">
                                                <h3 class="text-xl font-semibold text-gray-900 lg:text-2xl dark:text-white">
                                                    Observación</h3>
                                                <button type="button"
                                                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                                    data-modal-toggle="myModal{{ $key }}">
                                                    <span class="sr-only">Close modal</span>
                                                    <svg class="w-3 h-3" aria-hidden="true"
                                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                        <path stroke="currentColor" stroke-linecap="round"
                                                            stroke-linejoin="round" stroke-width="2"
                                                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                                    </svg>
                                                </button>
                                            </div>
                                            <div class="p-6 space-y-6">
                                                {{ $solicitud->observacion1 }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="myModal2{{ $key }}" tabindex="-1" aria-hidden="true"
                                    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full">
                                    <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
                                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                            <div
                                                class="flex justify-between items-start p-5 rounded-t border-b dark:border-gray-600">
                                                <h3 class="text-xl font-semibold text-gray-900 lg:text-2xl dark:text-white">
                                                    Observación</h3>
                                                <button type="button"
                                                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                                    data-modal-toggle="myModal2{{ $key }}">
                                                    <span class="sr-only">Close modal</span>
                                                    <svg class="w-3 h-3" aria-hidden="true"
                                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                        <path stroke="currentColor" stroke-linecap="round"
                                                            stroke-linejoin="round" stroke-width="2"
                                                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                                    </svg>
                                                </button>
                                            </div>
                                            <div class="p-6 space-y-6">
                                                {{ $solicitud->observacion2 }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </x-truck-driver-app-layout>