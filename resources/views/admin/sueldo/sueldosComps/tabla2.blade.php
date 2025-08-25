{{-- Tabla 2: Descuentos / Retenciones --}}
@props(['ajustes', 'nomina', 'lineas', 'plantillas', 'truck_driver'])

@php
$lineasRem = $lineas->where('tipo', 'remunerativo');
$subtotalRemInit = ($nomina->subtotal_remunerativo ?? ($lineasRem->sum('importe') + ($nomina->sueldo_basico_snapshot ?? 0)));
$lineasDesc = $lineas->where('tipo', 'descuento');
@endphp

<div class="p-4">
    <h3 class="text-lg font-semibold mb-3">Descuentos y retenciones</h3>

    <div class="overflow-x-auto">
        <table id="tabla_descuentos" class="w-full text-sm text-left text-gray-700 border">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2">Concepto</th>
                    <th class="px-4 py-2 text-right">Detalle / %</th>
                    <th class="px-4 py-2 text-right">Importe</th>
                </tr>
            </thead>
            <tbody>
                @forelse($lineasDesc as $desc)
                @php
                // Si la linea tiene porcentaje lo usamos, si no guardamos importe fijo como fallback
                $porc = $desc->porcentaje ? (float)$desc->porcentaje : null;
                $fixed = !$porc ? (float)$desc->importe : 0;
                @endphp
                <tr class="border-b line-desc" data-line-id="{{ $desc->id }}" data-fixed-importe="{{ $fixed }}">
                    <td class="px-4 py-2">{{ $desc->nombre }}</td>
                    <td class="px-4 py-2 text-right">
                        <input type="number" step="0.01" style="border: none; background-color: transparent; width: 125px; text-align: right;"
                            class="line-cantidad py-1 text-sm"
                            value="{{ $porc !== null ? number_format($porc,2,'.','') : '' }}"
                            data-line-id="{{ $desc->id }}">
                    </td>
                    <td class="px-4 py-2 text-right line-desc-importe" data-raw="{{ $fixed }}">
                        {{-- Si tiene porcentaje se calcula en cliente; si no, mostramos el fijo --}}
                        @if($porc !== null)
                        {{ number_format(round($subtotalRemInit * ($porc / 100.0),2), 2, ',', '.') }}
                        @else
                        {{ number_format($fixed, 2, ',', '.') }}
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td class="px-4 py-4 text-center text-sm text-gray-500" colspan="3">No hay descuentos configurados.</td>
                </tr>
                @endforelse
            </tbody>

            <tfoot>
                <tr class="font-semibold bg-gray-50">
                    <td class="px-4 py-3">Total descuentos</td>
                    <td></td>
                    <td class="px-4 py-3 text-right" id="total_descuentos">- {{ number_format(0, 2, ',', '.') }}</td>
                </tr>

                <!-- SUBTOTAL 2: remunerativo - descuentos -->
                <tr class="font-semibold bg-gray-50">
                    <td class="px-4 py-3">Subtotal 2 (Remunerativo - Descuentos)</td>
                    <td></td>
                    <td class="px-4 py-3 text-right" id="subtotal2">{{ number_format(0, 2, ',', '.') }}</td>
                </tr>
            </tfoot>

        </table>
    </div>
</div>