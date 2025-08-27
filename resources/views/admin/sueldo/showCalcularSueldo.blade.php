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
                        </div>
                    </div>

                    {{-- Botón Agregar fila (abre modal) --}}
                    <div class="flex justify-end mb-4 mr-4">
                        <button id="btnAgregarLinea" data-modal-target="modalAgregarLinea" data-modal-show="modalAgregarLinea" class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-full text-sm px-5 py-2.5 mr-2 mb-2">
                            Agregar Fila
                        </button>
                    </div>

                    {{-- Tabla 1 (componente adaptado) --}}
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
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
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
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
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        @component('admin.sueldo.sueldosComps.tabla3', [
                        'ajustes' => $ajustes,
                        'nomina' => $nomina,
                        'lineas' => $lineas,
                        'plantillas' => $plantillas,
                        'truck_driver' => $truck_driver
                        ])
                        @endcomponent
                    </div>

                    {{-- Descuentos adicionales (Adelantos / Celular / Gastos) --}}
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-6">
                        <table id="tabla_descuentos_extra" class="w-full text-sm text-left text-gray-700 border border-gray-300">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="px-6 py-2">Descuentos adicionales</th>
                                    <th class="px-6 py-2 text-right">Importe</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="px-6 py-2">Adelantos</td>
                                    <td class="px-6 py-2 text-right">
                                        <input
                                            type="text"
                                            id="otros_adelantos"
                                            class="input-otros-descuentos w-40 text-right border rounded p-1"
                                            value="{{ number_format($nomina->adelantos ?? 0, 2, ',', '.') }}">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-6 py-2">Celular</td>
                                    <td class="px-6 py-2 text-right">
                                        <input
                                            type="text"
                                            id="otros_celular"
                                            class="input-otros-descuentos w-40 text-right border rounded p-1"
                                            value="{{ number_format($nomina->celular ?? 0, 2, ',', '.') }}">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-6 py-2">Gastos</td>
                                    <td class="px-6 py-2 text-right">
                                        <input
                                            type="text"
                                            id="otros_gastos"
                                            class="input-otros-descuentos w-40 text-right border rounded p-1"
                                            value="{{ number_format($nomina->gastos ?? 0, 2, ',', '.') }}">
                                    </td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr class="font-semibold bg-gray-50">
                                    <td class="px-6 py-3">Total otros descuentos</td>
                                    <td class="px-6 py-3 text-right" id="total_otros_descuentos">- {{ number_format(0, 2, ',', '.') }}</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>


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
            <button id="guardarNominaBtn" class="px-4 py-2 text-white bg-blue-600 rounded">Guardar Nómina</button>
        </div>

        <!-- Contenedor de toasts -->
        <div id="toastContainer" class="fixed top-5 right-5 z-50 flex flex-col gap-2"></div>


        {{-- Modal: Agregar línea a la nómina --}}
        <div id="modalAgregarLinea" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full">
            <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
                <div class="relative bg-white rounded-lg shadow">
                    <div class="flex justify-between items-start p-5 rounded-t border-b">
                        <h3 class="text-xl font-semibold text-gray-900 lg:text-2xl">
                            Agregar Fila a la nómina
                        </h3>
                    </div>

                    <div class="p-6 space-y-6 text-lg font-medium text-gray-800">
                        {{-- Asumimos una ruta REST para crear lineas (adaptá si tenés otra) --}}
                        <form id="formAgregarLinea" action="{{ url('/admin/nominas/'.$nomina->id.'/lineas') }}" method="POST">
                            @csrf

                            <div class="grid grid-cols-1 gap-4">
                                <div>
                                    <label class="block mb-2 text-sm font-medium text-gray-900">Tipo</label>
                                    <select name="tipo" id="tipo" class="w-full p-2 border rounded">
                                        <option value="remunerativo">Remunerativo</option>
                                        <option value="no_remunerativo">No remunerativo</option>
                                        <option value="descuento">Descuento</option>
                                    </select>
                                </div>

                                <div>
                                    <label class="block mb-2 text-sm font-medium text-gray-900">Nombre</label>
                                    <input type="text" name="nombre" id="nombre" required class="w-full p-2 border rounded" placeholder="Ej: Horas extra">
                                </div>

                                <div>
                                    <div>
                                        <label class="block mb-2 text-sm font-medium text-gray-900">Valor unitario</label>
                                        <input type="number" step="0.01" name="valor_unitario" id="valor_unitario" value="0" class="w-full p-2 border rounded">
                                    </div>
                                </div>

                                <div>
                                    <label class="block mb-2 text-sm font-medium text-gray-900">Porcentaje (solo para descuentos)</label>
                                    <input type="number" step="0.01" name="porcentaje" id="porcentaje" class="w-full p-2 border rounded" placeholder="11.00 (para 11%)">
                                    <p class="text-xs text-gray-500">Si el concepto es descuento y aplicás porcentaje, completá este campo (ej 11.00 = 11%). Si el descuento es fijo deja vacío y completa el importe arriba con cantidad/valor.</p>
                                </div>
                            </div>

                            <div class="flex justify-center mt-4 space-x-2">
                                <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700">Aceptar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
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

        {{-- Script JS para modal y previsualizar importe --}}

        <script>
            $(document).ready(function() {
                $('#btnAgregarLinea').on('click', function() {
                    $('#modalAgregarLinea').removeClass('hidden');
                });

                $('#formAgregarLinea').on('submit', function(e) {
                    e.preventDefault();

                    let form = $(this);
                    let url = form.attr('action');
                    let data = form.serialize();

                    $.post(url, data)
                        .done(function(resp) {
                            showToast(resp.message || "Línea agregada correctamente", "success");
                            setTimeout(() => location.reload(), 1500); // recarga después de mostrar el toast
                        })
                        .fail(function(xhr) {
                            console.error(xhr.responseText);
                            showToast("Error al guardar la línea extra", "error");
                        });

                });

                function showToast(message, type = "success") {
                    const container = document.getElementById("toast-container");

                    const colors = {
                        success: "bg-green-500 text-white",
                        error: "bg-red-500 text-white",
                        info: "bg-blue-500 text-white",
                    };

                    const toast = document.createElement("div");
                    toast.className = `px-4 py-2 rounded-lg shadow-lg ${colors[type]} animate-slide-in`;
                    toast.innerText = message;

                    container.appendChild(toast);

                    // se borra solo después de 3 segundos
                    setTimeout(() => {
                        toast.classList.add("opacity-0", "transition", "duration-500");
                        setTimeout(() => toast.remove(), 500);
                    }, 3000);
                }


            });
        </script>
        <script>
            window.SUELDO_APP = {
                guardarUrl: "{{ url('/admin/nominas/' . $nomina->id . '/guardar') }}",
            };
        </script>
        @vite(['resources/scripts/Sueldo/nomina.js', 'resources/scripts/Sueldo/nuevaLinea.js'])
</x-admin-app-layout>