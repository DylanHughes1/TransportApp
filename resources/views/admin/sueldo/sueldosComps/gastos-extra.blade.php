@props(['nomina'])

@php
// Valores iniciales (se muestran formateados, tu parseNumber/formatNumber en JS los aceptan)
$adelantos = $nomina->adelantos ?? 0;
$celular = $nomina->celular ?? 0;
$gastos = $nomina->gastos ?? 0;
$totalOtros = round(($adelantos + $celular + $gastos), 2);
@endphp
<div class="px-4">
    <div class="p-4 bg-white rounded-lg shadow-sm border">
        <div class="flex items-center justify-between mb-4">
            <div class="flex items-center gap-3">
                <div class="p-2 bg-blue-50 rounded-md">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M12 8c-3 0-5 2-5 5v3h10v-3c0-3-2-5-5-5zM6 7h.01M18 7h.01M12 3v2" />
                    </svg>
                </div>
                <h4 class="text-lg font-semibold text-gray-800">Descuentos adicionales</h4>
            </div>

            <p class="text-sm text-gray-500">Adelantos, celular y gastos</p>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-700">
                <tbody class="divide-y">
                    <tr>
                        <td class="py-3 pl-4 font-semibold">Adelantos</td>
                        <td class="py-3 pr-4 text-right">
                            <div class="inline-flex items-center justify-end gap-2">
                                <span class="text-gray-600">$</span>
                                <input
                                    type="text"
                                    id="otros_adelantos"
                                    name="otros_adelantos"
                                    data-field="adelantos"
                                    style="border: none;"
                                    class="input-otros-descuentos currency-input w-24 text-right border rounded px-2 py-1"
                                    value="{{ number_format($adelantos, 2, ',', '.') }}" />
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td class="py-3 pl-4 font-semibold">Celular</td>
                        <td class="py-3 pr-4 text-right">
                            <div class="inline-flex items-center justify-end gap-2">
                                <span class="text-gray-600">$</span>
                                <input
                                    type="text"
                                    id="otros_celular"
                                    name="otros_celular"
                                    data-field="celular"
                                    style="border: none;"
                                    class="input-otros-descuentos currency-input w-24 text-right border rounded px-2 py-1"
                                    value="{{ number_format($celular, 2, ',', '.') }}" />
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="py-3 pl-4 font-semibold">Gastos</td>
                        <td class="py-3 pr-4 text-right">
                            <div class="inline-flex items-center justify-end gap-2">
                                <span class="text-gray-600">$</span>
                                <input
                                    type="text"
                                    id="otros_gastos"
                                    name="otros_gastos"
                                    data-field="gastos"
                                    style="border: none;"
                                    class="input-otros-descuentos currency-input w-24 text-right border rounded px-2 py-1"
                                    value="{{ number_format($gastos, 2, '9,', '.') }}" />
                            </div>
                        </td>
                    </tr>
                </tbody>

                <tfoot>
                    <tr class="font-semibold border border-gray-100 bg-gray-50">
                        <td class="py-3 pl-4 text-red-600">Total otros descuentos</td>
                        <td class="py-3 pr-4 text-right">
                            <span id="total_otros_descuentos" class="text-red-600">- {{ number_format($totalOtros, 2, ',', '.') }}</span>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>