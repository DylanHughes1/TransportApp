@foreach ($viajes as $key => $viaje)
<tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
        {{ \Carbon\Carbon::parse($viaje->fecha_salida)->format('d/m/y') }}
    </th>
    <td class="px-6 py-4">
        {{$viaje->origen->nombre}}
    </td>
    <td class="px-6 py-4">
        {{ number_format($viaje->km_viaje, 0) }}
    </td>
    <td class="px-6 py-4">
        {{ number_format($viaje->km_salida, 0) }}
    </td>
    <td class="px-6 py-4">
        {{$viaje->destino->nombre}}
    </td>
    <td class="px-6 py-4 whitespace-nowrap">
        {{ \Carbon\Carbon::parse($viaje->fecha_llegada)->format('d/m/y') }}
    </td>
    <td class="px-6 py-4">
        {{ number_format($viaje->km_llegada, 0) }}
    </td>
    <td class="px-6 py-4">
        {{ $viaje->producto->nombre ?? '-' }}
    </td>
    <td class="px-6 py-4">
        <span class="{{ $viaje->facturacion_opcion === 'carga' ? 'text-green-600 font-semibold' : '' }}">
            {{ number_format($viaje->carga_kg, 0) }}
        </span>
    </td>
    <td class="px-6 py-4">
        <span class="{{ $viaje->facturacion_opcion === 'descarga' ? 'text-green-600 font-semibold' : '' }}">
            {{ number_format($viaje->descarga_kg, 0) }}
        </span>
    </td>


    <td class="px-6 py-4">
        {{$viaje->TN ?? '-' }}
    </td>
    <td class="px-6 py-4">
        {{$viaje->precio_total ?? '-' }}
    </td>
    <td class="px-6 py-4">
        {{
        $viaje->TN !== null
            ? (
                $viaje->facturacion_opcion === 'carga'
                    ? ($viaje->carga_kg / 1000) * $viaje->TN
                    : ($viaje->descarga_kg / 1000) * $viaje->TN
              )
            : $viaje->precio_total
        }}
    </td>
    <td class="px-6 py-4">
        {{
                number_format(
                (
                    isset($viaje->TN)
                    ? (($viaje->carga_kg / 1000) * $viaje->TN)
                    : $viaje->precio_total
                ) / max(1, ($viaje->km_llegada - $viaje->km_salida)),
                2
            ) 
            }}
    </td>
    <td class="px-6 py-4">
        {{
            number_format(
                (
                    isset($viaje->TN)
                    ? (($viaje->carga_kg / 1000) * $viaje->TN)
                    : $viaje->precio_total
                ) / max(1, ($viaje->km_llegada - $viaje->km_salida) + $viaje->km_viaje_vacio),
                2
            ) 
            }}
    </td>

    <td class="px-6 py-4">
        <a href="#" data-modal-toggle="modalCombustible{{ $key }}" id="verMasLink"
            class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
            Ver Más
        </a>
    </td>
    <td class="px-6 py-4">
        <a href="#" data-modal-toggle="modalRemito{{ $key }}" id="verMasLink2"
            class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
            Ver Más
        </a>
    </td>
</tr>

<!-- Main modal -->
<div id="modalCombustible{{ $key }}" data-modal-backdrop="static" tabindex="-1" aria-hidden="true"
    class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative max-w-2xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex justify-between items-start p-5 rounded-t border-b dark:border-gray-600">
                <h3 class="text-2xl font-bold text-gray-900 dark:text-white">
                    Detalles de Carga de Combustible
                </h3>
                <button type="button"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    data-modal-toggle="modalCombustible{{ $key }}">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-6 space-y-6 text-base text-gray-800 dark:text-gray-200">
                @if(count($viaje->combustibles) > 0)
                <ul class="space-y-4">
                    @foreach($viaje->combustibles as $combustible)
                    <li class="bg-gray-50 dark:bg-gray-800 rounded-md p-4 shadow-sm">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 text-sm">
                            <div><span class="font-semibold">Kilometraje:</span> {{ $combustible->Km }}</div>
                            <div><span class="font-semibold">Fecha:</span> {{ $combustible->fecha }}</div>
                            <div><span class="font-semibold">Litros:</span> {{ $combustible->litros }}</div>
                            <div><span class="font-semibold">Lugar de carga:</span> {{ $combustible->lugar_carga }}</div>
                        </div>
                    </li>
                    @endforeach
                </ul>
                @else
                <p class="text-gray-500 dark:text-gray-400 italic">No se ha cargado combustible en este viaje.</p>
                @endif
            </div>
        </div>
    </div>
</div>

<div id="modalRemito{{ $key }}" tabindex="-1" data-modal-backdrop="static" aria-hidden="true"
    class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative max-w-2xl mx-auto max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex justify-between items-start p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-2xl font-bold text-gray-900 dark:text-white">
                    Remito
                </h3>
                <button type="button"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    data-modal-toggle="modalRemito{{ $key }}">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>

            <!-- Modal body -->
            <div class="p-6 space-y-6 text-base text-gray-800 dark:text-gray-200">
                @if ($viaje->imagenesViajes->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                    @foreach ($viaje->imagenesViajes as $imagenViaje)
                    <div class="relative bg-gray-50 dark:bg-gray-800 rounded-lg shadow hover:shadow-md transition-shadow">
                        <img class="rounded-t-lg w-full h-40 object-cover" src="{{ $imagenViaje->image_link }}" alt="Imagen del remito">
                        <div class="p-3">
                            <a href="{{ $imagenViaje->image_link }}" download>
                                <button
                                    class="w-full mt-2 px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700">
                                    Ver Imagen
                                </button>
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <p class="text-gray-500 dark:text-gray-400 italic">No hay imágenes asociadas</p>
                @endif
            </div>
        </div>
    </div>
</div>

</div>
@endforeach