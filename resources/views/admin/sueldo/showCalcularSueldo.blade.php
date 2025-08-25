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

                                            <div class="grid grid-cols-2 gap-4">
                                                <div>
                                                    <label class="block mb-2 text-sm font-medium text-gray-900">Cantidad</label>
                                                    <input type="number" step="0.01" name="cantidad" id="cantidad" value="0" class="w-full p-2 border rounded">
                                                </div>

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

                                            <div>
                                                <label class="block mb-2 text-sm font-medium text-gray-900">Importe (previsualización)</label>
                                                <input type="text" id="importe_preview" readonly class="w-full p-2 border rounded bg-gray-100">
                                            </div>
                                        </div>

                                        <div class="flex justify-center mt-4 space-x-2">
                                            <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700">Aceptar</button>
                                            <button type="button" id="btnCerrarModal" class="px-4 py-2 text-sm font-medium text-white bg-gray-600 rounded-lg">Cancelar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
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
    </div>

    {{-- Script JS para modal y previsualizar importe --}}
    <script>
        $(document).ready(function() {
            // abrir modal
            $('#btnAgregarLinea').on('click', function() {
                $('#modalAgregarLinea').removeClass('hidden');
            });

            // cerrar modal
            $('#btnCerrarModal').on('click', function() {
                $('#formAgregarLinea')[0].reset();
                $('#importe_preview').val('');
                $('#modalAgregarLinea').addClass('hidden');
            });

            // calcular importe preview: cantidad * valor_unitario
            function actualizarImporte() {
                let cantidad = parseFloat($('#cantidad').val()) || 0;
                let valor = parseFloat($('#valor_unitario').val()) || 0;
                let importe = (cantidad * valor).toFixed(2);
                $('#importe_preview').val(importe.replace('.', ','));
            }

            $('#cantidad, #valor_unitario').on('input', function() {
                actualizarImporte();
            });

            // si el modal se cierra con submit, dejar que el servidor maneje la redirección.
        });
    </script>

    <script>
        (function($) {
            "use strict";

            // --- Config (ajustá si es necesario) ---
            const CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

            // --- Helpers ---
            function parseNumber(value) {
                if (value === null || value === undefined) return 0;
                let s = String(value).trim();
                if (s === '') return 0;
                s = s.replace(/\s/g, '');
                if (s.indexOf(',') > -1 && s.indexOf('.') > -1 && s.indexOf(',') > s.indexOf('.')) {
                    s = s.replace(/\./g, '').replace(',', '.');
                } else if (s.indexOf(',') > -1 && s.indexOf('.') === -1) {
                    s = s.replace(',', '.');
                } else {
                    s = s.replace(',', '');
                }
                const n = parseFloat(s);
                return isNaN(n) ? 0 : n;
            }

            function formatNumber(n) {
                n = Number(n || 0);
                const neg = n < 0;
                n = Math.abs(n);
                const parts = n.toFixed(2).split('.');
                let intPart = parts[0];
                const dec = parts[1];
                intPart = intPart.replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                return (neg ? '-' : '') + intPart + ',' + dec;
            }

            // --- Cálculo en cadena: Tabla1 -> Tabla2 -> Subtotal2 -> Tabla3 -> Neto ---
            function recalcularTodo() {
                // 1) Subtotal remunerativo (tabla_remunerativos)
                let subtotalRem = 0;
                $('#tabla_remunerativos tbody tr').each(function() {
                    const $row = $(this);
                    const $cant = $row.find('input.line-cantidad');
                    const $valor = $row.find('.line-valor');
                    const $importeCell = $row.find('.line-importe');

                    let cantidad = 0;
                    if ($cant.length) cantidad = parseNumber($cant.val());
                    else cantidad = parseNumber($row.data('cantidad') || 0);

                    let valorUnit = 0;
                    if ($valor.length) valorUnit = parseNumber($valor.data('valor') ?? $valor.text());

                    const importe = parseFloat((cantidad * valorUnit).toFixed(2)) || 0;

                    if ($importeCell.length) {
                        $importeCell.attr('data-raw', importe);
                        $importeCell.text(formatNumber(importe));
                    }

                    subtotalRem += importe;
                });

                $('#subtotal_remunerativo').text(formatNumber(subtotalRem));

                // 2) Total descuentos (tabla_descuentos) usando subtotalRem
                let totalDescuentos = 0;
                $('#tabla_descuentos tbody tr.line-desc').each(function() {
                    const $row = $(this);
                    // Tomamos el input (en tu view el input es el campo editable)
                    const $inp = $row.find('input');
                    const porcentaje = $inp.length ? parseNumber($inp.val()) : 0;

                    // importe fijo fallback
                    const fixed = parseNumber($row.data('fixed-importe') || $row.find('.line-desc-importe').data('raw') || 0);

                    let importeDesc = 0;
                    if (porcentaje > 0) {
                        importeDesc = parseFloat((subtotalRem * (porcentaje / 100.0)).toFixed(2));
                    } else {
                        importeDesc = fixed;
                    }

                    const $importeCell = $row.find('.line-desc-importe');
                    if ($importeCell.length) {
                        $importeCell.attr('data-raw', importeDesc);
                        $importeCell.text(formatNumber(importeDesc));
                    }

                    totalDescuentos += importeDesc;
                });

                $('#total_descuentos').text('- ' + formatNumber(totalDescuentos));

                // 3) Subtotal2 = subtotalRem - totalDescuentos
                const subtotal2 = parseFloat((subtotalRem - totalDescuentos).toFixed(2)) || 0;
                $('#subtotal2').text(formatNumber(subtotal2));

                // 4) Subtotal no remunerativo (tabla_no_remunerativos)
                let subtotalNoRem = 0;
                $('#tabla_no_remunerativos tbody tr').each(function() {
                    const $row = $(this);
                    const $cant = $row.find('input.line-cantidad');
                    const $valor = $row.find('.line-valor');
                    const $importeCell = $row.find('.line-importe');

                    let cantidad = $cant.length ? parseNumber($cant.val()) : parseNumber($row.data('cantidad') || 0);
                    let valorUnit = $valor.length ? parseNumber($valor.data('valor') ?? $valor.text()) : 0;

                    const importe = parseFloat((cantidad * valorUnit).toFixed(2)) || 0;

                    if ($importeCell.length) {
                        $importeCell.attr('data-raw', importe);
                        $importeCell.text(formatNumber(importe));
                    }

                    subtotalNoRem += importe;
                });

                $('#subtotal_no_remunerativo').text(formatNumber(subtotalNoRem));

                // 5) Neto / Total a depositar = subtotal2 + subtotalNoRem
                const neto = parseFloat((subtotal2 + subtotalNoRem).toFixed(2)) || 0;
                $('#total_depositar').text(formatNumber(neto));

                // Guardar totales en window para envío
                window._sueldo_totales = {
                    subtotal_remunerativo: subtotalRem,
                    total_descuentos: totalDescuentos,
                    subtotal2: subtotal2,
                    subtotal_no_remunerativo: subtotalNoRem,
                    neto: neto
                };

                // debug
                // console.log('RECALC', window._sueldo_totales);
                return window._sueldo_totales;
            }

            // enviarNominaCompleta corregida (sin uso de ?? que mezcla con ||)
            async function enviarNominaCompleta() {
                const $btn = $('#guardarNominaBtn');
                let originalText = $btn.text();

                try {
                    // 1) Recalcular totales en cliente antes de enviar
                    if (typeof window.recalcularTodo === 'function') {
                        window.recalcularTodo();
                    }
                    const totales = window._sueldo_totales || {};

                    // 2) Construir lista de líneas (mismo formato que usamos en el frontend)
                    const lineas = [];

                    // Remunerativos
                    $('#tabla_remunerativos tbody tr').each(function() {
                        const $r = $(this);
                        const id = $r.data('line-id') ?? null;
                        const nombre = $r.find('td').first().text().trim();

                        // cantidad
                        const cantidadRaw = $r.find('input.line-cantidad').val();
                        const cantidad = parseFloat(cantidadRaw || 0);

                        // valor_unitario: preferir data('valor') si existe
                        let rawValor = $r.find('.line-valor').data('valor');
                        let valor_unitario = 0;
                        if (typeof rawValor !== 'undefined' && rawValor !== null) {
                            valor_unitario = parseNumber(rawValor);
                        } else {
                            valor_unitario = parseNumber($r.find('.line-valor').text());
                        }
                        valor_unitario = parseFloat(valor_unitario) || 0;

                        // importe: preferir attribute data-raw, fallback al texto
                        let rawImporte = $r.find('.line-importe').attr('data-raw');
                        let importe = 0;
                        if (typeof rawImporte !== 'undefined' && rawImporte !== null && rawImporte !== "") {
                            importe = parseFloat(rawImporte) || 0;
                        } else {
                            importe = parseFloat(parseNumber($r.find('.line-importe').text())) || 0;
                        }

                        lineas.push({
                            id: id,
                            tipo: 'remunerativo',
                            nombre: nombre,
                            cantidad: cantidad,
                            valor_unitario: valor_unitario,
                            importe: importe
                        });
                    });

                    // Descuentos
                    $('#tabla_descuentos tbody tr.line-desc').each(function() {
                        const $r = $(this);
                        const id = $r.data('line-id') ?? null;
                        const nombre = $r.find('td').first().text().trim();

                        const porcentajeRaw = $r.find('input').val();
                        const porcentaje = (porcentajeRaw === '' || typeof porcentajeRaw === 'undefined') ? null : parseFloat(parseNumber(porcentajeRaw)) || null;

                        // importe: preferir data-raw en la celda .line-desc-importe
                        let rawImporte = $r.find('.line-desc-importe').attr('data-raw');
                        let importe = 0;
                        if (typeof rawImporte !== 'undefined' && rawImporte !== null && rawImporte !== "") {
                            importe = parseFloat(rawImporte) || 0;
                        } else {
                            importe = parseFloat(parseNumber($r.find('.line-desc-importe').text())) || 0;
                        }

                        lineas.push({
                            id: id,
                            tipo: 'descuento',
                            nombre: nombre,
                            porcentaje: porcentaje,
                            importe: importe
                        });
                    });

                    // No remunerativos
                    $('#tabla_no_remunerativos tbody tr').each(function() {
                        const $r = $(this);
                        const id = $r.data('line-id') ?? null;
                        const nombre = $r.find('td').first().text().trim();

                        const cantidadRaw = $r.find('input.line-cantidad').val();
                        const cantidad = parseFloat(cantidadRaw || 0);

                        let rawValor = $r.find('.line-valor').data('valor');
                        let valor_unitario = 0;
                        if (typeof rawValor !== 'undefined' && rawValor !== null) {
                            valor_unitario = parseNumber(rawValor);
                        } else {
                            valor_unitario = parseNumber($r.find('.line-valor').text());
                        }
                        valor_unitario = parseFloat(valor_unitario) || 0;

                        let rawImporte = $r.find('.line-importe').attr('data-raw');
                        let importe = 0;
                        if (typeof rawImporte !== 'undefined' && rawImporte !== null && rawImporte !== "") {
                            importe = parseFloat(rawImporte) || 0;
                        } else {
                            importe = parseFloat(parseNumber($r.find('.line-importe').text())) || 0;
                        }

                        lineas.push({
                            id: id,
                            tipo: 'no_remunerativo',
                            nombre: nombre,
                            cantidad: cantidad,
                            valor_unitario: valor_unitario,
                            importe: importe
                        });
                    });

                    const payload = {
                        lineas: lineas,
                        totales: totales
                    };

                    // 3) Determinar URL de guardado (varias fuentes posibles)
                    let GUARDAR_URL = null;
                    if (window.SUELDO_APP && window.SUELDO_APP.guardarUrl) {
                        GUARDAR_URL = window.SUELDO_APP.guardarUrl;
                    } else if ($('#sueldo-app').length && $('#sueldo-app').data('guardar-url')) {
                        GUARDAR_URL = $('#sueldo-app').data('guardar-url');
                    } else {
                        GUARDAR_URL = '/admin/nominas/{{ $nomina->id }}/guardar';
                    }

                    // 4) Deshabilitar botón y mostrar feedback
                    $btn.prop('disabled', true);
                    const originalText = $btn.text();
                    $btn.text('Guardando…');

                    // 5) Enviar con axios
                    const resp = await axios.post(GUARDAR_URL, payload, {
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') || '',
                            'Content-Type': 'application/json'
                        },
                        timeout: 20000
                    });

                    // 6) Manejo respuesta
                    if (resp && resp.data && resp.data.success) {
                        alert(resp.data.message || 'Nómina guardada correctamente.');
                        setTimeout(() => {
                            location.reload();
                        }, 600);
                        return;
                    } else {
                        console.error('Respuesta servidor:', resp.data);
                        alert('No se pudo guardar la nómina: ' + (resp.data && resp.data.message ? resp.data.message : 'Error desconocido.'));
                    }

                } catch (err) {
                    if (err.response && err.response.status === 422) {
                        const e = err.response.data || {};
                        const errores = e.errors || e.message || err.response.data;
                        const firstKey = errores && typeof errores === 'object' ? Object.keys(errores)[0] : null;
                        const firstMsg = firstKey ? (Array.isArray(errores[firstKey]) ? errores[firstKey][0] : errores[firstKey]) : JSON.stringify(errores);
                        alert('Error de validación: ' + firstMsg);
                    } else {
                        console.error('Error guardando nómina:', err);
                        alert('Error al guardar la nómina. Revisa la consola.');
                    }
                } finally {
                    $btn.prop('disabled', false);
                    $btn.text(originalText || 'Guardar Nómina');
                }
            }

            // Enlazamos el click del botón
            $(document).on('click', '#guardarNominaBtn', function(e) {
                e.preventDefault();
                enviarNominaCompleta();
            });


            // --- Debounce helper ---
            function debounce(fn, delay) {
                let t;
                return function() {
                    clearTimeout(t);
                    const args = arguments,
                        ctx = this;
                    t = setTimeout(() => fn.apply(ctx, args), delay);
                };
            }

            // --- Listeners ---
            $(document).ready(function() {
                // recalculamos al cargar la página
                recalcularTodo();

                // inputs cantidad en tabla1 y tabla3
                $(document).on('input', '#tabla_remunerativos input.line-cantidad, #tabla_no_remunerativos input.line-cantidad', debounce(function() {
                    recalcularTodo();
                }, 250));

                // inputs porcentaje en tabla2 (son inputs dentro de .line-desc)
                $(document).on('input', '#tabla_descuentos tbody tr.line-desc input', debounce(function() {
                    recalcularTodo();
                }, 250));

                // si agregás filas vía modal con submit normal y recarga, recalculará en ready()
                // si insertás via AJAX, llamá recalcularTodo() luego de agregar la fila al DOM.
            });

            // --- Exportamos la función globalmente por si querés invocarla desde consola ---
            window.recalcularTodo = recalcularTodo;

        })(jQuery);
    </script>

</x-admin-app-layout>