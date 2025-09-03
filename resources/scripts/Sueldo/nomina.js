// resources/js/nomina.js
import $ from 'jquery';
window.$ = window.jQuery = $; // asegura jQuery global si lo tenés por npm

(function ($) {
    "use strict";

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

    // Toast (si ya lo exportaste desde otro módulo, podés importarlo en vez de repetirlo)
    function mostrarToast(message, type = 'success', duration = 3000) {
        const container = document.getElementById('toastContainer');
        if (!container) return;

        const toast = document.createElement('div');
        toast.className = `
            flex items-center p-4 w-full max-w-xs text-gray-500 bg-white rounded-lg shadow dark:bg-gray-800 dark:text-gray-300
            border-l-4 ${type === 'success' ? 'border-green-500' : 'border-red-500'}
            animate-slide-in
        `;
        toast.innerHTML = `
            <div class="ml-3 text-sm font-normal">${message}</div>
            <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg text-sm p-1.5 inline-flex items-center dark:bg-gray-800 dark:hover:text-white">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/></svg>
            </button>
        `;

        toast.querySelector('button').addEventListener('click', () => toast.remove());
        container.appendChild(toast);

        setTimeout(() => toast.remove(), duration);
    }

    // --- Cálculo en cadena: Tabla1 -> Tabla2 -> Subtotal2 -> Tabla3 -> Neto ---
    function recalcularTodo() {
        // 1) Subtotal remunerativo (tabla_remunerativos)
        let subtotalRem = 0;
        $('#tabla_remunerativos tbody tr').each(function () {
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
        $('#tabla_descuentos tbody tr.line-desc').each(function () {
            const $row = $(this);
            const $inp = $row.find('input');
            const porcentaje = $inp.length ? parseNumber($inp.val()) : 0;

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
        $('#tabla_no_remunerativos tbody tr').each(function () {
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

        $('#subtotal_no_remunerativo').text(formatNumber(subtotalNoRem + subtotal2));

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

        // 6) Descuentos adicionales: Adelantos + Celular + Gastos
        const adelantos = parseNumber($('#otros_adelantos').val());
        const celular = parseNumber($('#otros_celular').val());
        const gastos = parseNumber($('#otros_gastos').val());

        const totalOtros = parseFloat((adelantos + celular + gastos).toFixed(2)) || 0;
        $('#total_otros_descuentos').text('- ' + formatNumber(totalOtros));

        // 7) Neto final (restando otros descuentos del neto actual)
        const netoFinal = parseFloat((neto - totalOtros).toFixed(2)) || 0;

        // Actualizar “TOTAL A DEPOSITAR”
        $('#total_depositar').text(formatNumber(netoFinal));

        // 8) Guardar también estos valores para el payload
        window._sueldo_totales = {
            subtotal_remunerativo: subtotalRem,
            total_descuentos: totalDescuentos,
            subtotal2: subtotal2,
            subtotal_no_remunerativo: subtotalNoRem,
            neto: neto,
            otros_descuentos: totalOtros,
            neto_final: netoFinal
        };

        return window._sueldo_totales;
    }

    // enviarNominaCompleta
    async function enviarNominaCompleta() {
        const $btn = $('#guardarNominaBtn');
        let originalText = $btn.text();

        try {
            // 1) Recalcular totales en cliente antes de enviar
            if (typeof window.recalcularTodo === 'function') {
                window.recalcularTodo();
            }
            const totales = window._sueldo_totales || {};

            const adelantos = parseNumber($('#otros_adelantos').val());
            const celular = parseNumber($('#otros_celular').val());
            const gastos = parseNumber($('#otros_gastos').val());

            totales.otros_descuentos = parseFloat((adelantos + celular + gastos).toFixed(2)) || 0;
            totales.neto_final = parseFloat((((totales.neto || 0) - totales.otros_descuentos)).toFixed(2)) || 0;

            // Construir lista de líneas
            const lineas = [];

            // Remunerativos
            $('#tabla_remunerativos tbody tr').each(function () {
                const $r = $(this);
                const id = $r.data('line-id') ?? null;
                const nombre = $r.find('td').first().text().trim();

                if (nombre.toLowerCase() === 'sueldo básico') return;

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
                    tipo: 'remunerativo',
                    nombre: nombre,
                    cantidad: cantidad,
                    valor_unitario: valor_unitario,
                    importe: importe
                });
            });

            // Descuentos
            $('#tabla_descuentos tbody tr.line-desc').each(function () {
                const $r = $(this);
                const id = $r.data('line-id') ?? null;
                const nombre = $r.find('td').first().text().trim();

                const porcentajeRaw = $r.find('input').val();
                const porcentaje = (porcentajeRaw === '' || typeof porcentajeRaw === 'undefined') ? null : parseFloat(parseNumber(porcentajeRaw)) || null;

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
            $('#tabla_no_remunerativos tbody tr').each(function () {
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
                totales: totales,
                extras: {
                    adelantos: adelantos,
                    celular: celular,
                    gastos: gastos
                }
            };

            // Determinar URL de guardado (se lee de window.SUELDO_APP o data attribute)
            let GUARDAR_URL = null;
            if (window.SUELDO_APP && window.SUELDO_APP.guardarUrl) {
                GUARDAR_URL = window.SUELDO_APP.guardarUrl;
            } else if ($('#sueldo-app').length && $('#sueldo-app').data('guardar-url')) {
                GUARDAR_URL = $('#sueldo-app').data('guardar-url');
            } else {
                // fallback: intenta leer del atributo data en el elemento body o similar
                GUARDAR_URL = '/admin/nominas/guardar'; // ADAPTAR si necesitas ruta por defecto
            }

            // UI: deshabilitar botón y mostrar feedback
            $btn.prop('disabled', true);
            $btn.text('Guardando…');

            // Enviar con axios
            const resp = await axios.post(GUARDAR_URL, payload, {
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') || '',
                    'Content-Type': 'application/json'
                },
                timeout: 20000
            });

            // Manejo respuesta
            if (resp && resp.data && resp.data.success) {
                mostrarToast(resp.data.message || 'Nómina guardada correctamente.', 'success');
            } else {
                console.error('Respuesta servidor:', resp.data);
                mostrarToast(
                    'No se pudo guardar la nómina: ' + (resp.data && resp.data.message ? resp.data.message : 'Error desconocido.'),
                    'error'
                );
            }

        } catch (err) {
            if (err.response && err.response.status === 422) {
                const e = err.response.data || {};
                const errores = e.errors || e.message || err.response.data;
                const firstKey = errores && typeof errores === 'object' ? Object.keys(errores)[0] : null;
                const firstMsg = firstKey ? (Array.isArray(errores[firstKey]) ? errores[firstKey][0] : errores[firstKey]) : JSON.stringify(errores);
                mostrarToast('Error de validación: ' + firstMsg, 'error');
            } else {
                console.error('Error guardando nómina:', err);
                mostrarToast('Error al guardar la nómina. Revisa la consola.', 'error');
            }
        } finally {
            $btn.prop('disabled', false);
            $btn.text(originalText || 'Guardar Nómina');
        }
    }

    // Enlazamos el click del botón
    $(document).on('click', '#guardarNominaBtn', function (e) {
        e.preventDefault();
        enviarNominaCompleta();
    });

    // --- Debounce helper ---
    function debounce(fn, delay) {
        let t;
        return function () {
            clearTimeout(t);
            const args = arguments,
                ctx = this;
            t = setTimeout(() => fn.apply(ctx, args), delay);
        };
    }

    // --- Listeners ---
    $(document).ready(function () {
        // recalculamos al cargar la página
        recalcularTodo();

        // inputs cantidad en tabla1 y tabla3
        $(document).on('input', '#tabla_remunerativos input.line-cantidad, #tabla_no_remunerativos input.line-cantidad', debounce(function () {
            recalcularTodo();
        }, 250));

        // inputs porcentaje en tabla2 (son inputs dentro de .line-desc)
        $(document).on('input', '#tabla_descuentos tbody tr.line-desc input', debounce(function () {
            recalcularTodo();
        }, 250));

        // Cambios en Adelantos / Celular / Gastos => recalcular
        $(document).on('input', '.input-otros-descuentos', function () {
            recalcularTodo();
        });
    });

    // Exportamos la función globalmente por si querés invocarla desde consola
    window.recalcularTodo = recalcularTodo;

})(jQuery);
