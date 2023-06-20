@foreach ($viajes as $viaje)                                   
                                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                {{$viaje->fecha_salida}}
                                            </th>
                                            <td class="px-6 py-4">
                                                {{$viaje->origen}}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{$viaje->km_viaje}}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{$viaje->km_salida}}
                                            </td>
                                            <td class="px-6 py-4">
                                                $99
                                            </td>
                                            <td class="px-6 py-4">
                                                {{$viaje->destino}}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                {{$viaje->fecha_llegada}}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{$viaje->km_llegada}}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{$viaje->producto}}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{$viaje->carga_kg}}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{$viaje->km_llegada - $viaje->km_salida}}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{$viaje->km_vacios}}
                                            </td>
                                            <td class="px-6 py-4">
                                                $99
                                            </td>
                                            <td class="px-6 py-4">
                                                {{-- FAC.= kg * $/TN --}}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{-- $/KM = FAC/DIST --}}
                                            </td>
                                        </tr>
                                    @endforeach