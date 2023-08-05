<x-admin-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Calcular Sueldo: {{$truck_driver->name}}
        </h2>
    </x-slot>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
                    
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">

                        <div class="flex flex-col px-4 py-3 space-y-3 lg:flex-row lg:items-center lg:justify-between lg:space-y-0 lg:space-x-4">
                            <div class="flex items-center flex-1 space-x-4">

                                @php
                                    // Establecer la configuración regional en español
                                    setlocale(LC_TIME, 'spanish');
                                    
                                    // Obtener el nombre del mes actual en español
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
                                <button id="editButton2" type="button" class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-full text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">Editar</button>
                    
                    <form id="myForm" action="/admin/sueldo/calcular/{{$truck_driver->id}}"  method="POST">  
                        @csrf
                                <button id="saveButton" type="submit" class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-full text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700" disabled>Guardar</button>
                            </div>                
                        </div>

                        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400 border-b">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">
                                            Datos
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Cantidad
                                        </th>
                                        <th scope="col" class="mr-6 py-3">
                                            Valor
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Total
                                        </th>
                                    </tr>
                                </thead>
                                

                                <tbody class="text-justify">
                                    <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                                        <th scope="row" class="px-6 py-5 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            Sueldo Básico
                                        </th>
                                        <td class="px-6 py-3">
                                            Días
                                        </td>
                                        <td class="mr-6 py-3">
                                            30
                                        </td>
                                        <td class="columna-total px-6 py-3">
                                            {{$datos->sueldo_basico}}
                                        </td>
                                    
                                    </tr>
                                
                                    <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                                        <th scope="row" class="px-6 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            Hs Extraordinarias por km recorrido
                                        </th>
                                        <td class="px-6 py-3">
                                            <input type="number" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" name="hs_ext_km_recorrido" value="{{ $tabla1->hs_ext_km_recorrido }}" disabled>
                                        </td>
                                        
                                        <td class="mr-6 py-3">
                                            {{$datos->hs_ext_km_recorrido}}
                                        </td>
                                        <td class="columna-total px-6 py-3">
                                            @php
                                                $producto = $tabla1->hs_ext_km_recorrido * $datos->hs_ext_km_recorrido;
                                                echo $producto;
                                            @endphp
                                        </td>
                                    
                                    </tr>
                                    <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                                        <th scope="row" class="px-6 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            Hs Extraord. por km recorrido – 100%
                                        </th>
                                        <td class="px-6 py-3">
                                            
                                            <input type="number" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" name="hs_ext_km_recorrido_100" value="{{ $tabla1->hs_ext_km_recorrido_100 }}" disabled>
                                        </td>
                                        <td class="mr-6 py-3">
                                            {{$datos->hs_ext_km_recorrido}}
                                        </td>
                                        <td class="columna-total px-6 py-3">
                                            @php
                                                $producto = $tabla1->hs_ext_km_recorrido_100 * $datos->hs_ext_km_recorrido;
                                                echo $producto;
                                            @endphp
                                        </td>
                                    
                                    </tr>
                                    <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                                        <th scope="row" class="px-6 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            Permanencia fuera Resid. Habit inc.b)
                                        </th>
                                        <td class="px-6 py-3">
                                            <input type="number" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" name="perm_f_res" value=" {{ $tabla1->perm_f_res }}" disabled>
                                        </td>
                                        <td class="mr-6 py-3">
                                            {{$datos->perm_f_res}}
                                        </td>
                                        <td class="columna-total px-6 py-3">
                                            @php
                                                $producto = $tabla1->perm_f_res * $datos->perm_f_res;
                                                echo $producto;
                                            @endphp
                                        </td>
                                    
                                    </tr>
                                    <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                                        <th scope="row" class="px-6 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            Control descarga
                                        </th>
                                        <td class="px-6 py-3">
                                            
                                            <input type="number" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" name="c_descarga" value="{{ $tabla1->c_descarga }}" disabled>
                                        </td>
                                        <td class="mr-6 py-3">
                                            {{$datos->c_descarga}}
                                        </td>
                                        <td class="columna-total px-6 py-3">
                                            @php
                                                $producto = $tabla1->c_descarga * $datos->c_descarga;
                                                echo $producto;
                                            @endphp
                                        </td>
                                    
                                    </tr>
                                    <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                                        <th scope="row" class="px-6 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            Horas extras al 50%
                                        </th>
                                        <td class="px-6 py-3">
                                            
                                            <input type="number" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" name="hs_50" value=" {{$tabla1->hs_50}}"disabled>
                                        </td>
                                        <td class="mr-6 py-3">
                                            {{$datos->hs_50}}
                                        </td>
                                        <td class="columna-total px-6 py-3">
                                            @php
                                                $producto = $tabla1->hs_50 * $datos->hs_50;
                                                echo $producto;
                                            @endphp
                                        </td>
                                    
                                    </tr>
                                    <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                                        <th scope="row" class="px-6 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            Horas extras al 100%
                                        </th>
                                        <td class="px-6 py-3">
                                            
                                            <input type="number" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" name="hs_100" value=" {{$tabla1->hs_100}}"disabled>
                                        </td>
                                        <td class="mr-6 py-3">
                                            {{$datos->hs_100}}
                                        </td>
                                        <td class="columna-total px-6 py-3">
                                            @php
                                                $producto = $tabla1->hs_100 * $datos->hs_100;
                                                echo $producto;
                                            @endphp
                                        </td>
                                    
                                    </tr>
                                    <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                                        <th scope="row" class="px-6 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            Inasistencias Injustificadas
                                        </th>
                                        <td class="px-6 py-3">
                                            Días
                                        </td>
                                        <td name="inasistencias_inj" class="mr-6 py-3">
                                            <input type="number" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-14 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" name="inasistencias_inj" value="{{$tabla1->inasistencias_inj}}" disabled>
                                        </td>
                                        <td class="columna-total px-6 py-3">
                                            @php
                                                $producto = -1*($tabla1->inasistencias_inj * ($datos->sueldo_basico/30));
                                                echo ($producto == 0) ? '0' : $producto;
                                            @endphp
                                        </td>
                                    
                                    </tr>
                                    <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                                        <th scope="row" class="px-6 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            Dia del Camionero (15 diciembre)
                                        </th>
                                        <td class="px-6 py-3">
                                            
                                        </td>
                                        <td class="px-6 py-8">
                                            
                                        </td>
                                        <td class="columna-total px-6 py-3">
                                            {{$datos->dia_camionero}}
                                        </td>           
                                    </tr>
                                    <tfoot>
                                        <tr class="font-semibold border-b bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-white">
                                            <th scope="row" class="px-6 py-4 text-base text">SUBTOTAL 1</th>
                                            <td class="px-6 py-3"></td>
                                            <td class="px-6 py-3"></td>
                                           <td class="px-6 py-3"> {{$tabla1->subtotal1}} </td>
                                        </tr>
                                    </tfoot>
                                </tbody>
                            </table>
                        </div>
                    
                            
                        <script>
                            $('#editButton2').click(function() {
                                $('input[disabled]').prop('disabled', false);
                                $('button[disabled]').prop('disabled', false);
                            });                           
                        </script>
{{-- ---------------------------------------------------------------------------------------- --}}
                        <div class="relative overflow-x-auto shadow-md">
                            <label for="blank" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">&nbsp;</label>

                            <table class="w-full text-sm text-justify text-gray-500 dark:text-gray-400">
                                <tbody>
                                    <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                                        <th scope="row" class="px-6 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white w-60">
                                            Antigüedad
                                        </th>      
                                        <td class="w-24"></td>                                  
                                        <td class="px-6 py-3">
                                            Años:
                                        </td>
                                        <td class="w-36"></td> 
                                        <td class="px-4 py-3">
                                            <input type="number" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-14 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" name="antig" value="{{intval($tabla1->antig)}}"disabled>
                                        </td>
                                        <td class="subtotal1 px-6 py-3">
                                            @php
                                                $producto = ($tabla1->antig * $tabla1->subtotal1 * 0.01);
                                                echo $producto;
                                            @endphp
                                        </td>
                                    
                                    </tr>
                                    <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                                        <th scope="row" class="px-6 py-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            Vacaciones Anuales
                                        </th>
                                        <td class="w-24"></td> 
                                        <td class="px-6 py-3">
                                            Días:
                                        </td>
                                        <td class="px-6 py-3">
                                            
                                        </td>
                                        <td class="subtotal1 px-6 py-3">
                                            0
                                        </td>                                
                                    </tr>                             
                                </tbody>
                                <tfoot>
                                    <tr class="font-semibold bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-white">
                                        <th scope="row" class="px-6 py-4 text-base">TOTAL REMUNERATIVO</th>
                                        <td class="px-6 py-3"></td>
                                        <td class="px-6 py-3"></td>
                                        <td class="px-6 py-3"></td>
                                        <td class="px-6 py-3"></td>
                                        <td class="px-6 py-3">
                                            {{$tabla1->total_remun1}}
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </form>
{{-- ---------------------------------------------------------------------------------------- --}}
                        <hr class="h-px my-8 bg-gray-200 border-0 dark:bg-gray-700">

                        <div class="flex justify-end mb-4 mr-4">
                
                        <form id="myForm" action="/admin/sueldo/calcular/{{$truck_driver->id}}/2"  method="POST">  
                            @csrf
                                    <button id="saveButton2" type="submit" class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-full text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700" disabled>Guardar</button>
                                </div>  

                                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400 border-b">
                                            <tr>
                                                <th scope="col" class="px-6 py-3">
                                                    Descuentos
                                                </th>
                                                <th scope="col" class="px-6 py-3">
                                                    Porcentaje
                                                </th>
                                                <th scope="col" class="px-6 py-3">
                                                    
                                                </th>
                                                <th scope="col" class="px-6 py-3">
                                                    Total
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                                                <th scope="row" class="px-6 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                    Jubilación
                                                </th>
                                                <td class="px-6 py-3">
                                                    <input  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" name="jubilacion" value=" {{floatval($tabla2->jubilacion)}}%"disabled>
                                                </td>
                                                <td class="px-6 py-3">
                                                    -
                                                </td>
                                                <td class="descuento px-6 py-3">
                                                    @php
                                                    $producto = ($tabla2->jubilacion/100) * $tabla1->total_remun1;
                                                    echo str_replace(',', '', number_format($producto, 2));
                                                    @endphp
                                                </td>
                                            
                                            </tr>
                                            <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                                                <th scope="row" class="px-6 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                    Obra Social
                                                </th>
                                                <td class="px-6 py-3">
                                                    <input  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" name="obra_social" value=" {{floatval($tabla2->obra_social)}}%"disabled>
                                                </td>
                                                <td class="px-6 py-3">
                                                    
                                                </td>
                                                <td class="descuento px-6 py-3">
                                                    @php
                                                    $producto = ($tabla2->obra_social/100) * $tabla1->total_remun1;
                                                    echo str_replace(',', '', number_format($producto, 2));
                                                    @endphp
                                                </td>
                                            
                                            </tr>
                                            <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                                                <th scope="row" class="px-6 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                    Cuota Solidaria
                                                </th>
                                                <td class="px-6 py-3">
                                                    <input  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" name="cuota_solidaria" value=" {{floatval($tabla2->cuota_solidaria)}}%"disabled>
                                                </td>
                                                <td class="px-6 py-3">
                                                    
                                                </td>
                                                <td class="descuento px-6 py-3">
                                                    @php
                                                    $producto = ($tabla2->cuota_solidaria/100) * $tabla1->total_remun1;
                                                    echo str_replace(',', '', number_format($producto, 2));
                                                    @endphp
                                                </td>
                                            
                                            </tr>
                                            <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                                                <th scope="row" class="px-6 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                    Ley 19.032
                                                </th>
                                                <td class="px-6 py-3">
                                                    <input  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" name="ley_19032" value=" {{floatval($tabla2->ley_19032)}}%"disabled>
                                                </td>
                                                <td class="px-6 py-3">
                                                    
                                                </td>
                                                <td class="descuento px-6 py-3">
                                                    @php
                                                    $producto = ($tabla2->ley_19032/100) * $tabla1->total_remun1;
                                                    echo str_replace(',', '', number_format($producto, 2));
                                                    @endphp
                                                </td>
                                            
                                            </tr>
                                            <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                                                <th scope="row" class="px-6 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                    Seguro Sepelio
                                                </th>
                                                <td class="px-6 py-3">
                                                    <input  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" name="seguro_sepelio" value=" {{floatval($tabla2->seguro_sepelio)}}%"disabled>
                                                </td>
                                                <td class="px-6 py-3">
                                                    
                                                </td>
                                                <td class="descuento px-6 py-3">
                                                    @php
                                                    $producto = ($tabla2->seguro_sepelio/100) * $tabla1->total_remun1;
                                                    echo str_replace(',', '', number_format($producto, 2));
                                                    @endphp
                                                </td>
                                            
                                            </tr>
                                            <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                                                <th scope="row" class="px-6 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                    AJU.APO.DTO.561/19
                                                </th>
                                                <td class="px-6 py-3">
                                                    <input  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" name="aju_apo_dto" value=" {{floatval($tabla2->aju_apo_dto)}}%"disabled>
                                                </td>
                                                <td class="px-6 py-3">
                                                    
                                                </td>
                                                <td class="descuento px-6 py-3">
                                                    @php
                                                    $producto = ($tabla2->aju_apo_dto/100) * $tabla1->total_remun1;
                                                    echo str_replace(',', '', number_format($producto, 2));
                                                    @endphp
                                                </td>
                                            
                                            </tr>
                                            <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                                                <th scope="row" class="px-6 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                    ASOC.MUT.1NOV.PMOS
                                                </th>
                                                <td class="px-6 py-3">
                                                    <input  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" name="asoc_mut_1nov" value=" {{floatval($tabla2->asoc_mut_1nov)}}%"disabled>
                                                </td>
                                                <td class="px-6 py-3">
                                                    
                                                </td>
                                                <td class="descuento px-6 py-3">
                                                    @php
                                                    $producto = ($tabla2->asoc_mut_1nov/100) * $tabla1->total_remun1;
                                                    echo str_replace(',', '', number_format($producto, 2));
                                                    @endphp
                                                </td>
                                            
                                            </tr>
                                            <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                                                <th scope="row" class="px-6 py-5 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                    TOTAL DE DESCUENTO
                                                </th>
                                                <td class="px-6 py-3">
                                                    
                                                </td>
                                                <td class="px-6 py-3">
                                                    
                                                </td>
                                                <td class="px-6 py-3 text-red-500 font-bold">
                                                   - {{$tabla2->total_descuento}}
                                                </td>
                                            </tr>
                                            <tfoot>
                                                <tr class="font-semibold border-b bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-white">
                                                    <th scope="row" class="px-6 py-4 text-base">SUBTOTAL 2</th>
                                                    <td class="px-6 py-3"></td>
                                                    <td class="px-6 py-3"></td>
                                                    <td class="px-6 py-3">
                                                        {{$tabla2->subtotal2}}</td>
                                                </tr>
                                            </tfoot>
                                        </tbody>
                                    </table>
                                </div>
                        </form>
{{-- ---------------------------------------------------------------------------------------- --}}
                        <hr class="h-px my-8 bg-gray-200 border-0 dark:bg-gray-700"> 

                        <div class="flex justify-end mb-4 mr-4">
                            <!-- Modal toggle -->
                            <button data-modal-target="defaultModal" data-modal-show="defaultModal"  class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-full text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">Agregar Fila</button>

                            <!-- Main modal -->
                            <div id="defaultModal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full">
                                <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
                                    <!-- Modal content -->
                                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                        <!-- Modal header -->
                                        <div class="flex justify-between items-start p-5 rounded-t border-b dark:border-gray-600">
                                            <h3 class="text-xl font-semibold text-gray-900 lg:text-2xl dark:text-white">
                                                Agregar Fila
                                            </h3>
                                        </div>
                                        <!-- Modal body -->
                                        <div class="p-6 space-y-6 text-center text-lg font-medium text-gray-800">
                                            <form action="/admin/sueldo/calcular/{{$truck_driver->id}}/4" method="POST">
                                                @csrf
                                                <input type="text" name="nombre" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 mb-4" placeholder="Nombre" required>
                                                <input type="text" name="valor" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 mb-4" placeholder="Valor" required>

                                                <div class="flex justify-center">
                                                    <button type="submit" class="px-4 py-2 mr-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 dark:bg-blue-800 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Aceptar</button>
                                                    <button type="button" class="px-4 py-2 text-sm font-medium text-white bg-red-600 rounded-lg hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 dark:bg-blue-800 dark:hover:bg-blue-700 dark:focus:ring-blue-800" data-modal-hide="defaultModal">Cancelar</button>
                                                </div>
                                            </form>
                                        </div>                    
                                    </div>
                                </div>
                            </div>
                            
                            <form id="myForm" action="/admin/sueldo/calcular/{{$truck_driver->id}}/3"  method="POST">  
                                @csrf
                                    <button id="saveButton3" type="submit" class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-full text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700" disabled>Guardar</button>
                        </div> 

                        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400 border-b">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">
                                            DATOS
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Cantidad
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Valor
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Total
                                        </th> 
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                                        <th scope="row" class="px-6 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">                                          
                                            <input class="bg-white text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" name="viatico_x_km_name" value="{{$tabla3->viatico_x_km_name}}" disabled>
                                        </th>
                                        <td class="px-6 py-3">
                                            <input type="number" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" name="viatico_x_km" value="{{$tabla3->viatico_x_km}}"disabled>
                                        </td>
                                        <td class="px-6 py-3">
                                            {{$datos->kms_rec}}
                                        </td>
                                        <td class="px-6 py-3">
                                            {{$tabla3->viatico_x_km * $datos->kms_rec}}
                                        </td>
                                    
                                    </tr>
                                    <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                                        <th scope="row" class="px-6 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            <input class="bg-white text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" name="cruce_frontera_name" value="{{$tabla3->cruce_frontera_name}}"disabled>
                                        </th>
                                        <td class="px-6 py-3">
                                            <input type="number" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" name="cruce_frontera" value="{{$tabla3->cruce_frontera}}"disabled>
                                        </td>
                                        <td class="px-6 py-3">
                                            {{$datos->cruce_frontera}}
                                        </td>
                                        <td class="px-6 py-3">
                                            {{$tabla3->cruce_frontera * $datos->cruce_frontera}}
                                        </td>
                                    
                                    </tr>
                                    <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                                        <th scope="row" class="px-6 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            <input class="bg-white text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" name="comida_name" value="{{$tabla3->comida_name}}"disabled>
                                        </th>
                                        <td class="px-6 py-3">
                                            <input type="number" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" name="comida" value="{{$tabla3->comida}}"disabled>
                                        </td>
                                        <td class="px-6 py-3">
                                            {{$datos->comida}}
                                        </td>
                                        <td class="px-6 py-3">
                                            {{$tabla3->comida * $datos->comida}}
                                        </td>
                                    
                                    </tr>
                                    <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                                        <th scope="row" class="px-6 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            <input class="bg-white text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" name="especial_name" value="{{$tabla3->especial_name}}"disabled>
                                        </th>
                                        <td class="px-6 py-3">
                                            <input type="number" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" name="especial" value="{{$tabla3->especial}}"disabled>
                                        </td>
                                        <td class="px-6 py-3">
                                            {{$datos->especial}}
                                        </td>
                                        <td class="px-6 py-3">
                                            {{$tabla3->especial * $datos->especial}}
                                        </td>
                                    
                                    </tr>
                                    <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                                        <th scope="row" class="px-6 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            <input class="bg-white text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" name="pernoctada_name" value="{{$tabla3->pernoctada_name}}"disabled>
                                        </th>
                                        <td class="px-6 py-3">
                                            <input type="number" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" name="pernoctada" value="{{$tabla3->pernoctada}}"disabled>
                                        </td>
                                        <td class="px-6 py-3">
                                            {{$datos->pernoctada}}
                                        </td>
                                        <td class="px-6 py-3">
                                            {{$tabla3->pernoctada * $datos->pernoctada}}
                                        </td>
                                    
                                    </tr>
                                    <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                                        <th scope="row" class="px-6 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            <input class="bg-white text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" name="permanencia_fuera_rec_name" value="{{$tabla3->permanencia_fuera_rec_name}}"disabled>
                                        </th>
                                        <td class="px-6 py-3">
                                            <input type="number" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" name="permanencia_fuera_rec" value="{{$tabla3->permanencia_fuera_rec}}"disabled>
                                        </td>
                                        <td class="px-6 py-3">
                                            {{$datos->perm_f_res}}
                                        </td>
                                        <td class="px-6 py-3">
                                            {{$tabla3->permanencia_fuera_rec * $datos->perm_f_res}}
                                        </td>
                                    
                                    </tr>
                                    <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                                        <th scope="row" class="px-6 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            <input class="bg-white text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" name="viatico_km_1_2_name" value="{{$tabla3->viatico_km_1_2_name}}"disabled>
                                        </th>
                                        <td class="px-6 py-3">
                                            <input type="number" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" name="viatico_km_1_2" value="{{$tabla3->viatico_km_1_2}}"disabled>
                                        </td>
                                        <td class="px-6 py-3">
                                            {{$datos->km_1_2}}
                                        </td>
                                        <td class="px-6 py-3">
                                            {{$tabla3->viatico_km_1_2 * $datos->km_1_2}}
                                        </td>
                                    
                                    </tr>
                                    <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                                        <th scope="row" class="px-6 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            <input class="bg-white text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" name="adicional_vacas_anuales_name" value="{{$tabla3->adicional_vacas_anuales_name}}"disabled>
                                        </th>
                                        <td class="px-6 py-3">
                                            <input type="number" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" name="adicional_vacas_anuales" value="{{$tabla3->adicional_vacas_anuales}}"disabled>
                                        </td>
                                        <td class="px-6 py-3">
                                            {{$datos->vacaciones_anual_x_dia}}
                                        </td>
                                        <td class="px-6 py-3">
                                            {{$tabla3->adicional_vacas_anuales * $datos->vacaciones_anual_x_dia}}
                                        </td>
                                    
                                    </tr>
                                    <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                                        <th scope="row" class="px-6 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            <input class="bg-white text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" name="asignacion_no_remuner_name" value="{{($tabla3->asignacion_no_remuner_name)}}"disabled>
                                        </th>
                                        <td class="px-6 py-3">
                                            <input type="number" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" name="asignacion_no_remuner" value="{{($tabla3->asignacion_no_remuner)}}"disabled>
                                            
                                        </td>
                                        <td class="px-6 py-3">
                                            -
                                        </td>
                                        <td class="px-6 py-3">
                                            {{ $tabla3->asignacion_no_remuner ? $tabla3->asignacion_no_remuner : 0 }}
                                        </td>
                                    </tr>

                                    @if(count($tabla3->nuevasFilas) > 0)
                                        @foreach ($tabla3->nuevasFilas as $nuevaFila)
                                        <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                                            <th scope="row" class="px-6 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                <input class="bg-white text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" name="nombre{{$nuevaFila->id}}" value="{{$nuevaFila->nombre}}"disabled>
                                            </th>
                                            <td class="px-6 py-3">
                                                <input type="number" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" name="valor{{$nuevaFila->id}}" value="{{$nuevaFila->valor}}"disabled>                                             
                                            </td>
                                            <td class="px-6 py-3">
                                                -
                                            </td>
                                            <td class="px-6 py-3">
                                                {{ $nuevaFila->valor ? $nuevaFila->valor : 0 }}
                                            </td>
                                        </tr>
                                        @endforeach
                                    @endif

                                    <tfoot>
                                        <tr class="font-semibold border-b bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-white">
                                            <th scope="row" class="px-6 py-4 text-base">TOTAL REMUNERATIVO</th>
                                            <td class="px-6 py-3"></td>
                                            <td class="px-6 py-3"></td>
                                            <td class="px-6 py-3">{{$tabla3->total_remun2 - $tabla2->subtotal2}}</td>
                                        </tr>
                                    </tfoot>
                                </tbody>
                            </table>
                        </div>


                    
{{-- ---------------------------------------------------------------------------------------- --}}
                        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                            <label for="blank" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">&nbsp;</label>

                            <div class="relative overflow-x-auto shadow-md">
                                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                    <tbody>
                                        <tfoot>
                                        <tr class="font-semibold border-b bg-yellow-200 dark:bg-gray-800 text-gray-900 dark:text-white">
                                            <th scope="row" class="px-6 py-4 text-base">TOTAL FINAL</th>
                                            <td class="px-6 py-3"></td><td class="px-6 py-3"></td><td class="px-6 py-3"></td>
                                            <td class="px-6 py-3"></td><td class="px-6 py-3"></td><td class="px-6 py-3"></td>
                                            
                                            <td class="px-6 py-3 text-center text-base">{{$tabla3->total_remun2}}</td>
                                        </tr>
                                    </tfoot>
                                    </tbody>
                                </table>
                            </div>
                        </div>
{{-- ---------------------------------------------------------------------------------------- --}}
                        <div class="relative overflow-x-auto shadow-md">
                            <label for="blank" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">&nbsp;</label>

                            <div class="flex justify-end shadow-md">
                                <table class="w-auto bg-gray-200 border border-gray-300">
                                  <tr>
                                    <td class="px-4 py-2 text-center border-b">Adelantos:</td>
                                    <td class="px-4 py-2 text-center border-b"> <input type="number" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" name="adelantos" value="{{$tabla3->adelantos}}"disabled></td>
                                  </tr>
                                  <tr>
                                    <td class="px-4 py-2 text-center border-b">Celular:</td>
                                    <td class="px-4 py-2 text-center border-b"><input type="number" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" name="celular" value="{{$tabla3->celular}}"disabled></td>
                                  </tr>
                                  <tr>
                                    <td class="px-4 py-2 text-center border-b">Gastos:</td>
                                    <td class="px-4 py-2 text-center border-b"><input type="number" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" name="gastos" value="{{$tabla3->gastos}}"disabled></td>
                                  </tr>
                                  <tr>
                                    <td class="px-4 py-2 text-center border-b font-bold">Subtotal:</td>
                                    <td class="px-4 py-2 text-center border-b text-red-500 font-bold">
                                        @if($tabla3->adelantos + $tabla3->celular + $tabla3->gastos !== 0)
                                            -{{ $tabla3->adelantos + $tabla3->celular + $tabla3->gastos }}
                                        @else {{ $tabla3->adelantos + $tabla3->celular + $tabla3->gastos }}
                                        @endif
                                    </td>
                                  </tr>
                                </table>
                            </div>                   
                        </div>
                    </form>
                        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                            <label for="blank" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">&nbsp;</label>

                            <div class="relative overflow-x-auto shadow-md">
                                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 border border-gray-300">
                                    <tbody>
                                        <tfoot>
                                        <tr class="font-semibold border-b bg-green-200 dark:bg-gray-800 text-gray-900 dark:text-white">
                                            <th scope="row" class="px-6 py-4 text-base">TOTAL A DEPOSITAR</th>
                                            <td class="px-6 py-3"></td><td class="px-6 py-3"></td><td class="px-6 py-3"></td>
                                            <td class="px-6 py-3"></td><td class="px-6 py-3">
                                            
                                            <td class="px-6 py-3 text-center text-base">{{$tabla3->total_remun2 - $tabla3->adelantos - $tabla3->celular - $tabla3->gastos}}</td>
                                        </tr>
                                    </tfoot>
                                    </tbody>
                                </table>
                            </div>
                        </div>



                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-app-layout>