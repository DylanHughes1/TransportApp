{{-- Tabla 3: No remunerativos / Viáticos --}}
@props(['ajustes', 'nomina', 'lineas', 'plantillas', 'truck_driver'])

@php
$lineasNoRem = $lineas->where('tipo', 'no_remunerativo');
@endphp

<div class="p-4">
    <h3 class="text-lg font-semibold mb-3">No remunerativos / Viáticos</h3>

    <div class="overflow-x-auto">
        <table id="tabla_no_remunerativos" class="w-full text-sm text-left text-gray-700 border">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2">Concepto</th>
                    <th class="px-4 py-2 text-right">Cantidad</th>
                    <th class="px-4 py-2 text-right">Valor (u.)</th>
                    <th class="px-4 py-2 text-right">Importe</th>
                </tr>
            </thead>
            <tbody>
                @forelse($lineasNoRem as $l)
                <tr class="border-b" data-line-id="{{ $l->id }}">
                    <td class="px-4 py-2">{{ $l->nombre }}</td>
                    <td class="px-4 py-2 text-right">
                        <input type="number" step="0.01" style="border: none; background-color: transparent; width: 125px; text-align: right;"
                            class="line-cantidad py-1 text-sm"
                            value="{{ number_format($l->cantidad, 2, '.', '') }}"
                            data-line-id="{{ $l->id }}">
                    </td>
                    <td class="px-4 py-2 text-right">
                        <span class="line-valor" data-valor="{{ (float)$l->valor_unitario }}">{{ number_format((float)$l->valor_unitario, 2, ',', '.') }}</span>
                    </td>
                    <td class="px-4 py-2 text-right line-importe" data-raw="{{ (float)$l->importe }}">{{ number_format((float)$l->importe, 2, ',', '.') }}</td>
                </tr>
                @empty
                <tr>
                    <td class="px-4 py-4 text-center text-sm text-gray-500" colspan="4">No hay conceptos no remunerativos.</td>
                </tr>
                @endforelse
            </tbody>

            <tfoot>
                <tr class="font-semibold bg-gray-50">
                    <td class="px-4 py-3">Total no remunerativo</td>
                    <td></td>
                    <td></td>
                    <td class="px-4 py-3 text-right" id="subtotal_no_remunerativo">{{ number_format($lineasNoRem->sum('importe'), 2, ',', '.') }}</td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>