{{-- resources/views/admin/sueldo/sueldosComps/tabla1.blade.php --}}
@props(['ajustes', 'nomina', 'lineas', 'plantillas', 'truck_driver'])

@php
$lineasRem = $lineas->where('tipo', 'remunerativo');
$sueldoBasico = $nomina->sueldo_basico_snapshot ?? ($ajustes->sueldo_basico ?? 0);
@endphp

<div class="p-4">
    <h3 class="text-lg font-semibold mb-3">Remunerativos</h3>

    <div class="overflow-x-auto">
        <table id="tabla_remunerativos" class="w-full text-sm text-left text-gray-700 border">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2">Datos</th>
                    <th class="px-4 py-2 text-right">Cantidad</th>
                    <th class="px-4 py-2 text-right">Valor (u.)</th>
                    <th class="px-4 py-2 text-right">Total</th>
                </tr>
            </thead>
            <tbody>
                {{-- Sueldo básico (no editable cantidad por BD: lo mostramos como 1) --}}
                <tr class="border-b">
                    <td class="px-4 py-2">Sueldo básico</td>
                    <td class="px-4 py-2 text-right">
                        <input type="number" step="0.01" style="border: none; background-color: transparent; width: 125px; text-align: right;"
                            class="line-cantidad py-1 text-sm" value="1"
                            data-line-id="sueldo_basico" />
                    </td>
                    <td class="px-4 py-2 text-right">
                        <span class="line-valor" data-valor="{{ $sueldoBasico }}">{{ number_format($sueldoBasico, 2, ',', '.') }}</span>
                    </td>
                    <td class="px-4 py-2 text-right line-importe" data-raw="{{ $sueldoBasico }}">{{ number_format($sueldoBasico, 2, ',', '.') }}</td>
                </tr>

                {{-- Otras lineas remunerativas (editable cantidad) --}}
                @forelse($lineasRem as $linea)
                {{-- omitimos sueldo básico repetido si existe como linea --}}
                @if(strtolower(trim($linea->nombre)) === 'sueldo básico')
                @continue
                @endif
                <tr class="border-b" data-line-id="{{ $linea->id }}">
                    <td class="px-4 py-2">{{ $linea->nombre }}</td>
                    <td class="px-4 py-2 text-right">
                        <input type="number" step="0.01" style="border: none; background-color: transparent; width: 125px; text-align: right;"
                            class="line-cantidad py-1 text-sm"
                            value="{{ number_format($linea->cantidad, 2, '.', '') }}"
                            data-line-id="{{ $linea->id }}">
                    </td>
                    <td class="px-4 py-2 text-right">
                        <span class="line-valor" data-valor="{{ (float)$linea->valor_unitario }}">{{ number_format((float)$linea->valor_unitario, 2, ',', '.') }}</span>
                    </td>
                    <td class="px-4 py-2 text-right line-importe" data-raw="{{ (float)$linea->importe }}">{{ number_format((float)$linea->importe, 2, ',', '.') }}</td>
                </tr>
                @empty
                <tr>
                    <td class="px-4 py-4 text-center text-sm text-gray-500" colspan="4">No hay conceptos remunerativos cargados.</td>
                </tr>
                @endforelse
            </tbody>

            <tfoot>
                <tr class="font-semibold bg-gray-50">
                    <td class="px-4 py-3">Subtotal remunerativo</td>
                    <td></td>
                    <td></td>
                    <td class="px-4 py-3 text-right" id="subtotal_remunerativo">{{ number_format($sueldoBasico + $lineasRem->sum('importe'), 2, ',', '.') }}</td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>