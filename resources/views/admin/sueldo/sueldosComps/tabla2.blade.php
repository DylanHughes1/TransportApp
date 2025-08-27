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
                    <th class="px-4 py-2 text-center">Acciones</th>
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

                    <td class="px-4 py-2 text-center">
                        <button type="button"
                            class="btn-delete-line inline-flex items-center px-3 py-1 text-sm font-medium text-red-700 bg-red-50 rounded hover:bg-red-100"
                            data-line-id="{{ $desc->id }}"
                            data-nomina-id="{{ $nomina->id }}">
                            <svg viewBox="0 0 24 24" class="h-5 w-5" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <path d="M18 6L17.1991 18.0129C17.129 19.065 17.0939 19.5911 16.8667 19.99C16.6666 20.3412 16.3648 20.6235 16.0011 20.7998C15.588 21 15.0607 21 14.0062 21H9.99377C8.93927 21 8.41202 21 7.99889 20.7998C7.63517 20.6235 7.33339 20.3412 7.13332 19.99C6.90607 19.5911 6.871 19.065 6.80086 18.0129L6 6M4 6H20M16 6L15.7294 5.18807C15.4671 4.40125 15.3359 4.00784 15.0927 3.71698C14.8779 3.46013 14.6021 3.26132 14.2905 3.13878C13.9376 3 13.523 3 12.6936 3H11.3064C10.477 3 10.0624 3 9.70951 3.13878C9.39792 3.26132 9.12208 3.46013 8.90729 3.71698C8.66405 4.00784 8.53292 4.40125 8.27064 5.18807L8 6M14 10V17M10 10V17" stroke="#e23636" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                </g>
                            </svg>
                        </button>
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
                    <td class="bg-gray-200"></td>
                </tr>

                <!-- SUBTOTAL 2: remunerativo - descuentos -->
                <tr class="font-semibold bg-gray-50">
                    <td class="px-4 py-3">Subtotal 2 (Remunerativo - Descuentos)</td>
                    <td></td>
                    <td class="px-4 py-3 text-right" id="subtotal2">{{ number_format(0, 2, ',', '.') }}</td>
                    <td class="bg-gray-200"></td>
                </tr>
            </tfoot>

        </table>
    </div>
</div>