<x-admin-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Calcular Sueldo: {{ $truck_driver->name }}
        </h2>
    </x-slot>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">

                    <div class="flex flex-col px-4 py-3 space-y-3 lg:flex-row lg:items-center lg:justify-between lg:space-y-0 lg:space-x-4">
                        <div class="flex items-center flex-1 space-x-4">
                            @php
                            // Nombre del mes en español (si no funciona en tu entorno, podés usar Carbon::now()->locale('es')->isoFormat('MMMM'))
                            setlocale(LC_TIME, 'spanish');
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
                            {{-- Aquí podés poner botones globales (ej. Generar recibo, Exportar) --}}
                            <button id="btnAgregarLinea" data-modal-target="modalAgregarLinea" data-modal-show="modalAgregarLinea" class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-full text-sm px-5 py-2.5 mr-2 mb-2">
                                Agregar Fila
                            </button>
                        </div>
                    </div>

                    {{-- Tabla 1 (componente adaptado) --}}
                    <div class="">
                        @component('admin.sueldo.sueldosComps.tabla1', [
                        'ajustes' => $ajustes,
                        'nomina' => $nomina,
                        'lineas' => $lineas,
                        'plantillas' => $plantillas,
                        'truck_driver' => $truck_driver
                        ])
                        @endcomponent
                    </div>

                    <hr class="h-px my-8 bg-gray-200 border-0">

                    {{-- Tabla 2 (descuentos / retenciones) --}}
                    <div class="">
                        @component('admin.sueldo.sueldosComps.tabla2', [
                        'ajustes' => $ajustes,
                        'nomina' => $nomina,
                        'lineas' => $lineas,
                        'plantillas' => $plantillas,
                        'truck_driver' => $truck_driver
                        ])
                        @endcomponent
                    </div>

                    <hr class="h-px my-8 bg-gray-200 border-0">

                    {{-- Tabla 3 (no remunerativos / viáticos) --}}
                    <div class="">
                        @component('admin.sueldo.sueldosComps.tabla3', [
                        'ajustes' => $ajustes,
                        'nomina' => $nomina,
                        'lineas' => $lineas,
                        'plantillas' => $plantillas,
                        'truck_driver' => $truck_driver
                        ])
                        @endcomponent
                    </div>

                    <hr class="h-px my-8 bg-gray-200 border-0">

                    {{-- Descuentos adicionales (Adelantos / Celular / Gastos) --}}

                    @component('admin.sueldo.sueldosComps.gastos-extra', ['nomina' => $nomina])
                    @endcomponent


                    {{-- Total a depositar --}}
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-6">
                        <table class="w-full text-sm text-left text-gray-500 border border-gray-300">
                            <tfoot>
                                <tr class="font-semibold border-b bg-green-200 text-gray-900">
                                    <th class="px-6 py-4 text-base">TOTAL A DEPOSITAR</th>
                                    <td class="px-6 py-3"></td>
                                    <td class="px-6 py-3"></td>
                                    <td class="px-6 py-3"></td>
                                    <td class="px-6 py-3"></td>
                                    <td class="px-6 py-3 text-center text-base" id="total_depositar">
                                        {{-- Usamos totales['neto'] calculado en el service --}}
                                        {{ number_format($totales['neto'] ?? $nomina->neto ?? 0, 2, ',', '.') }}
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
            <div class="py-4 flex justify-end">
                <button id="guardarNominaBtn" class="px-4 py-2 text-white bg-blue-600 rounded hover:bg-blue-700 shadow">
                    Guardar Nómina
                </button>
            </div>
        </div>

        <!-- Contenedor de toasts -->
        <div id="toastContainer" class="fixed top-5 right-5 z-50 flex flex-col gap-2"></div>

        @include('admin.sueldo.sueldosComps.modal-new-line')
        @include('admin.sueldo.sueldosComps.modal-confirm-delete')

        <div id="toast-container" class="fixed top-5 right-5 z-50 space-y-2"></div>

        <!-- CSS de animación (solo una vez, en tu layout o CSS global) -->
        <style>
            @keyframes slide-in {
                0% {
                    transform: translateX(100%);
                    opacity: 0;
                }

                100% {
                    transform: translateX(0);
                    opacity: 1;
                }
            }

            .animate-slide-in {
                animation: slide-in 0.3s ease-out;
            }
        </style>
        <script>
            window.SUELDO_APP = {
                guardarUrl: "{{ url('/admin/nominas/' . $nomina->id . '/guardar') }}",
            };
        </script>

        @vite(['resources/scripts/Sueldo/nomina.js', 'resources/scripts/Sueldo/nuevaLinea.js', 'resources/scripts/Sueldo/eliminarLinea.js'])
</x-admin-app-layout>