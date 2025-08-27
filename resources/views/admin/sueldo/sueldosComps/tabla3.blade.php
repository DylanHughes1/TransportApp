{{-- Tabla 3: No remunerativos / Viáticos --}}
@props(['ajustes', 'nomina', 'lineas', 'plantillas', 'truck_driver'])

@php
$lineasNoRem = $lineas->where('tipo', 'no_remunerativo');
@endphp

<div class="px-4">
    <h3 class="text-xl font-semibold mb-3">No remunerativos / Viáticos</h3>

    <div class="overflow-x-auto">
        <table id="tabla_no_remunerativos" class="w-full text-sm text-left text-gray-700 border">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2">Concepto</th>
                    <th class="px-4 py-2 text-right">Cantidad</th>
                    <th class="px-4 py-2 text-right">Valor (u.)</th>
                    <th class="px-4 py-2 text-right">Total</th>
                    <th class="px-4 py-2 text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($lineasNoRem as $l)
                <tr class="border-b" data-line-id="{{ $l->id }}">
                    <td class="px-4 py-2 font-semibold">{{ $l->nombre }}</td>
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

                    <td class="px-4 py-2 text-center">
                        <button type="button"
                            class="btn-delete-line inline-flex items-center px-3 py-1 text-sm font-medium text-red-700 bg-red-50 rounded hover:bg-red-100"
                            data-line-id="{{ $l->id }}"
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
                    <td class="px-4 py-4 text-center text-sm text-gray-500" colspan="4">No hay conceptos no remunerativos.</td>
                </tr>
                @endforelse
            </tbody>

            <tfoot>
                <tr class="font-semibold bg-gray-50">
                    <td class="px-4 py-3 font-bold">Total no remunerativo</td>
                    <td></td>
                    <td></td>
                    <td class="px-4 py-3 text-right border-r border-gray-300" id="subtotal_no_remunerativo">{{ number_format($lineasNoRem->sum('importe'), 2, ',', '.') }}</td>
                    <td class="bg-gray-200"></td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>