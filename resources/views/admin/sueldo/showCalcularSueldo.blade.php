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
                                <h5>
                                    <span class="text-gray-500">Fecha:</span>
                                    <span class="dark:text-white">Mayo de 2023</span>
                                </h5>
                                <h5>
                                    <span class="text-gray-500">Kilómetros:</span>
                                    <span class="dark:text-white">$8.226,00</span>
                                </h5>
                            </div>   
                     
                            <div class="flex justify-end mb-4">
                                <button id="editButton" type="button" class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-full text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">Editar</button>
                    
                    <form id="myForm" action="/admin/sueldo/calcular/{{$truck_driver->id}}"  method="POST">  
                        @csrf
                                <button id="saveButton" type="submit" class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-full text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">Guardar</button>
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
                                        <th scope="col" class="px-6 py-3">
                                            Valor
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Total
                                        </th>
                                    </tr>
                                </thead>
                                

                                <tbody class="text-justify">
                                    <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            Sueldo Básico
                                        </th>
                                        <td class="px-6 py-4">
                                            Días
                                        </td>
                                        <td class="px-6 py-4">
                                            30
                                        </td>
                                        <td class="columna-total px-6 py-4">
                                            {{$datos->sueldo_basico}}
                                        </td>
                                    
                                    </tr>
                                
                                    <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            Hs Extraordinarias por km recorrido
                                        </th>
                                        <td class="px-6 py-4">
                                            <input name="hs_ext_km_recorrido" value="{{$tabla1->hs_ext_km_recorrido}}" disabled>
                                        </td>
                                        <td class="px-6 py-4">
                                            {{$datos->hs_ext_km_recorrido}}
                                        </td>
                                        <td class="columna-total px-6 py-4">
                                            @php
                                                $producto = $tabla1->hs_ext_km_recorrido * $datos->hs_ext_km_recorrido;
                                                echo $producto;
                                            @endphp
                                        </td>
                                    
                                    </tr>
                                    <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            Hs Extraord. por km recorrido – 100%
                                        </th>
                                        <td class="px-6 py-4">
                                            
                                            <input name="hs_ext_km_recorrido_100" value=" {{$tabla1->hs_ext_km_recorrido_100}}" disabled>
                                        </td>
                                        <td class="px-6 py-4">
                                            {{$datos->hs_ext_km_recorrido}}
                                        </td>
                                        <td class="columna-total px-6 py-4">
                                            @php
                                                $producto = $tabla1->hs_ext_km_recorrido_100 * $datos->hs_ext_km_recorrido;
                                                echo $producto;
                                            @endphp
                                        </td>
                                    
                                    </tr>
                                    <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            Permanencia fuera Resid. Habit inc.b)
                                        </th>
                                        <td class="px-6 py-4">
                                            <input name="perm_f_res" value=" {{$tabla1->perm_f_res}}" disabled>
                                        </td>
                                        <td class="px-6 py-4">
                                            {{$datos->perm_f_res}}
                                        </td>
                                        <td class="columna-total px-6 py-4">
                                            @php
                                                $producto = $tabla1->perm_f_res * $datos->perm_f_res;
                                                echo $producto;
                                            @endphp
                                        </td>
                                    
                                    </tr>
                                    <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            Control descarga
                                        </th>
                                        <td class="px-6 py-4">
                                            
                                            <input name="c_descarga" value=" {{$tabla1->c_descarga}}" disabled>
                                        </td>
                                        <td class="px-6 py-4">
                                            {{$datos->c_descarga}}
                                        </td>
                                        <td class="columna-total px-6 py-4">
                                            @php
                                                $producto = $tabla1->c_descarga * $datos->c_descarga;
                                                echo $producto;
                                            @endphp
                                        </td>
                                    
                                    </tr>
                                    <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            Horas extras al 50%
                                        </th>
                                        <td class="px-6 py-4">
                                            
                                            <input name="hs_50" value=" {{$tabla1->hs_50}}"disabled>
                                        </td>
                                        <td class="px-6 py-4">
                                            {{$datos->hs_50}}
                                        </td>
                                        <td class="columna-total px-6 py-4">
                                            @php
                                                $producto = $tabla1->hs_50 * $datos->hs_50;
                                                echo $producto;
                                            @endphp
                                        </td>
                                    
                                    </tr>
                                    <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            Horas extras al 100%
                                        </th>
                                        <td class="px-6 py-4">
                                            
                                            <input name="hs_100" value=" {{$tabla1->hs_100}}"disabled>
                                        </td>
                                        <td class="px-6 py-4">
                                            {{$datos->hs_100}}
                                        </td>
                                        <td class="columna-total px-6 py-4">
                                            @php
                                                $producto = $tabla1->hs_100 * $datos->hs_100;
                                                echo $producto;
                                            @endphp
                                        </td>
                                    
                                    </tr>
                                    <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            Inasistencias Injustificadas
                                        </th>
                                        <td class="px-6 py-4">
                                            Días
                                        </td>
                                        <td name="inasistencias_inj" class="px-6 py-4">
                                            {{$tabla1->inasistencias_inj}}
                                        </td>
                                        <td class="px-6 py-4">
                                            -
                                        </td>
                                    
                                    </tr>
                                    <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            Dia del Camionero (15 diciembre)
                                        </th>
                                        <td class="px-6 py-4">
                                            
                                        </td>
                                        <td class="px-6 py-4">
                                            
                                        </td>
                                        <td class="px-6 py-4">
                                            -
                                        </td>           
                                    </tr>
                                    <tfoot>
                                        <tr class="font-semibold border-b bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-white">
                                            <th scope="row" class="px-6 py-3 text-base">SUBTOTAL 1</th>
                                            <td class="px-6 py-4"></td>
                                            <td class="px-6 py-4"></td>
                                            <td id="total" class="subtotal1 px-6 py-4"></td>
                                        </tr>
                                    </tfoot>
                                </tbody>
                            </table>
                        </div>
                    
                            
                        <script>
                            $('#editButton').click(function() {
                                $('input[disabled]').prop('disabled', false);
                            });                           
                        </script>
{{-- ---------------------------------------------------------------------------------------- --}}
                        <div class="relative overflow-x-auto shadow-md">
                            <label for="blank" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">&nbsp;</label>

                            <table class="w-full text-sm text-justify text-gray-500 dark:text-gray-400">
                                <tbody>
                                    <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            Antigüedad
                                        </th>
                                        <td class="px-6 py-4">
                                            Años
                                        </td>
                                        <td class="px-6 py-4">
                                            15
                                        </td>
                                        <td class="subtotal1 px-6 py-4">
                                            30441.72
                                        </td>
                                    
                                    </tr>
                                    <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            Vacaciones Anuales
                                        </th>
                                        <td class="px-6 py-4">
                                            Días
                                        </td>
                                        <td class="px-6 py-4">
                                            
                                        </td>
                                        <td class="subtotal1 px-6 py-4">
                                            0
                                        </td>                                
                                    </tr>                             
                                </tbody>
                                <tfoot>
                                    <tr class="font-semibold bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-white">
                                        <th scope="row" class="px-6 py-3 text-base">TOTAL REMUNERATIVO</th>
                                        <td class="px-6 py-4"></td>
                                        <td class="px-6 py-4"></td>
                                        <td class="px-6 py-4"></td>
                                        <td class="px-6 py-4"></td>
                                        <td class="px-6 py-4">
                                            <input id="totalR" name="totalR" value="" disabled>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </form>
{{-- ---------------------------------------------------------------------------------------- --}}
                        <hr class="h-px my-8 bg-gray-200 border-0 dark:bg-gray-700">

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
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            Jubilación
                                        </th>
                                        <td class="px-6 py-4">
                                            <input name="jubilacion" value=" {{intval($tabla2->jubilacion)}}%"disabled>
                                        </td>
                                        <td class="px-6 py-4">
                                            -
                                        </td>
                                        <td class="descuento px-6 py-4">
                                            @php
                                              $producto = ($tabla2->jubilacion/100) * $tabla1->total_remun1;
                                              echo str_replace(',', '', number_format($producto, 2));
                                            @endphp
                                        </td>
                                    
                                    </tr>
                                    <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            Obra Social
                                        </th>
                                        <td class="px-6 py-4">
                                            <input name="obra_social" value=" {{intval($tabla2->obra_social)}}%"disabled>
                                        </td>
                                        <td class="px-6 py-4">
                                            
                                        </td>
                                        <td class="descuento px-6 py-4">
                                            @php
                                              $producto = ($tabla2->obra_social/100) * $tabla1->total_remun1;
                                              echo str_replace(',', '', number_format($producto, 2));
                                            @endphp
                                        </td>
                                    
                                    </tr>
                                    <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            Cuota Solidaria
                                        </th>
                                        <td class="px-6 py-4">
                                            <input name="cuota_solidaria" value=" {{intval($tabla2->cuota_solidaria)}}%"disabled>
                                        </td>
                                        <td class="px-6 py-4">
                                            
                                        </td>
                                        <td class="descuento px-6 py-4">
                                            @php
                                              $producto = ($tabla2->cuota_solidaria/100) * $tabla1->total_remun1;
                                              echo str_replace(',', '', number_format($producto, 2));
                                            @endphp
                                        </td>
                                    
                                    </tr>
                                    <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            Ley 19.032
                                        </th>
                                        <td class="px-6 py-4">
                                            <input name="ley_19032" value=" {{intval($tabla2->ley_19032)}}%"disabled>
                                        </td>
                                        <td class="px-6 py-4">
                                            
                                        </td>
                                        <td class="descuento px-6 py-4">
                                            @php
                                              $producto = ($tabla2->ley_19032/100) * $tabla1->total_remun1;
                                              echo str_replace(',', '', number_format($producto, 2));
                                            @endphp
                                        </td>
                                    
                                    </tr>
                                    <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            Seguro Sepelio
                                        </th>
                                        <td class="px-6 py-4">
                                            <input name="seguro_sepelio" value=" {{intval($tabla2->seguro_sepelio)}}%"disabled>
                                        </td>
                                        <td class="px-6 py-4">
                                            
                                        </td>
                                        <td class="descuento px-6 py-4">
                                            @php
                                              $producto = ($tabla2->seguro_sepelio/100) * $tabla1->total_remun1;
                                              echo str_replace(',', '', number_format($producto, 2));
                                            @endphp
                                        </td>
                                    
                                    </tr>
                                    <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            AJU.APO.DTO.561/19
                                        </th>
                                        <td class="px-6 py-4">
                                            <input name="aju_apo_dto" value=" {{intval($tabla2->aju_apo_dto)}}%"disabled>
                                        </td>
                                        <td class="px-6 py-4">
                                            
                                        </td>
                                        <td class="descuento px-6 py-4">
                                            @php
                                              $producto = ($tabla2->aju_apo_dto/100) * $tabla1->total_remun1;
                                              echo str_replace(',', '', number_format($producto, 2));
                                            @endphp
                                        </td>
                                    
                                    </tr>
                                    <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            ASOC.MUT.1NOV.PMOS
                                        </th>
                                        <td class="px-6 py-4">
                                            <input name="asoc_mut_1nov" value=" {{intval($tabla2->asoc_mut_1nov)}}%"disabled>
                                        </td>
                                        <td class="px-6 py-4">
                                            
                                        </td>
                                        <td class="descuento px-6 py-4">
                                            @php
                                              $producto = ($tabla2->asoc_mut_1nov/100) * $tabla1->total_remun1;
                                              echo str_replace(',', '', number_format($producto, 2));
                                            @endphp
                                        </td>
                                    
                                    </tr>
                                    <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            TOTAL DE DESCUENTO
                                        </th>
                                        <td class="px-6 py-4">
                                            
                                        </td>
                                        <td class="px-6 py-4">
                                            
                                        </td>
                                        <td class="px-6 py-4 text-red-500 font-bold">
                                            <input id="totalDesc" name="totalDesc" value="" disabled>
                                        </td>
                                    </tr>
                                    <tfoot>
                                        <tr class="font-semibold border-b bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-white">
                                            <th scope="row" class="px-6 py-3 text-base">SUBTOTAL 2</th>
                                            <td class="px-6 py-4"></td>
                                            <td class="px-6 py-4"></td>
                                            <td class="px-6 py-4">$182.808,41</td>
                                        </tr>
                                    </tfoot>
                                </tbody>
                            </table>
                        </div>

                        <script>
                            // Calcula el total al cargar la página
                            window.onload = function() {
                                calcularTotal();
                                calcularDescuento();
                            };
                            function calcularTotal() {
                                
                                var total1 = 0;
                                var columnasTotal = document.getElementsByClassName('columna-total');
                                for (var i = 0; i < columnasTotal.length; i++) {
                                total1 += parseFloat(columnasTotal[i].textContent);
                                }
                                document.getElementById('total').textContent = total1.toFixed(2);

                                var total2 = 0;
                                var columnasTotal = document.getElementsByClassName('subtotal1');
                                for (var i = 0; i < columnasTotal.length; i++) {                                 
                                    total2 += parseFloat(columnasTotal[i].textContent);
                                }
                                document.getElementById('totalR').value = total2.toFixed(2);
                            }
                            
                            function calcularDescuento() {
                                
                                var total1 = 0;
                                var columnasTotal = document.getElementsByClassName('descuento');
                                for (var i = 0; i < columnasTotal.length; i++) {
                                    console.log(parseFloat(columnasTotal[i].textContent));
                                    total1 += parseFloat(columnasTotal[i].textContent);
                                }
                                document.getElementById('totalDesc').value = "-" + total1.toFixed(2);

                                // var total2 = 0;
                                // var columnasTotal = document.getElementsByClassName('subtotal1');
                                // for (var i = 0; i < columnasTotal.length; i++) {                                 
                                //     total2 += parseFloat(columnasTotal[i].textContent);
                                // }
                                // document.getElementById('totalR').value = total2.toFixed(2);
                            }
                        </script>

{{-- ---------------------------------------------------------------------------------------- --}}
                        <hr class="h-px my-8 bg-gray-200 border-0 dark:bg-gray-700">

                        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400 border-b">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">
                                            X
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
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            Viático por Km recorrido cohef. 1
                                        </th>
                                        <td class="px-6 py-4">
                                            8226
                                        </td>
                                        <td class="px-6 py-4">
                                            8.21356
                                        </td>
                                        <td class="px-6 py-4">
                                            $ 67564.74
                                        </td>
                                    
                                    </tr>
                                    <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            Cruce Frontera
                                        </th>
                                        <td class="px-6 py-4">
                                            0
                                        </td>
                                        <td class="px-6 py-4">
                                            3818.08
                                        </td>
                                        <td class="px-6 py-4">
                                            
                                        </td>
                                    
                                    </tr>
                                    <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            Comida
                                        </th>
                                        <td class="px-6 py-4">
                                            0
                                        </td>
                                        <td class="px-6 py-4">
                                            1570.98
                                        </td>
                                        <td class="px-6 py-4">
                                            0
                                        </td>
                                    
                                    </tr>
                                    <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            Especial
                                        </th>
                                        <td class="px-6 py-4">
                                            0
                                        </td>
                                        <td class="px-6 py-4">
                                            788.31
                                        </td>
                                        <td class="px-6 py-4">
                                            -
                                        </td>
                                    
                                    </tr>
                                    <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            Pernoctada
                                        </th>
                                        <td class="px-6 py-4">
                                            0
                                        </td>
                                        <td class="px-6 py-4">
                                            1829.75
                                        </td>
                                        <td class="px-6 py-4">
                                            -
                                        </td>
                                    
                                    </tr>
                                    <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            Permanencia fuera residencia habit inc. a)
                                        </th>
                                        <td class="px-6 py-4">
                                            0
                                        </td>
                                        <td class="px-6 py-4">
                                            5544.20
                                        </td>
                                        <td class="px-6 py-4">
                                            0
                                        </td>
                                    
                                    </tr>
                                    <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            Viático KM recorri 1,2
                                        </th>
                                        <td class="px-6 py-4">
                                            0
                                        </td>
                                        <td class="px-6 py-4">
                                            9.85627
                                        </td>
                                        <td class="px-6 py-4">
                                            0
                                        </td>
                                    
                                    </tr>
                                    <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            Adicional Vacaciones Anuales 2022
                                        </th>
                                        <td class="px-6 py-4">
                                            0
                                        </td>
                                        <td class="px-6 py-4">
                                            2389.23
                                        </td>
                                        <td class="px-6 py-4">
                                            $
                                        </td>
                                    
                                    </tr>
                                    <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            Asignación No remuner Cuota - Acuerdo 151221
                                        </th>
                                        <td class="px-6 py-4">
                                            -
                                        </td>
                                        <td class="px-6 py-4">
                                            -
                                        </td>
                                        <td class="px-6 py-4">
                                            0
                                        </td>
                                    </tr>
                                    <tfoot>
                                        <tr class="font-semibold border-b bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-white">
                                            <th scope="row" class="px-6 py-3 text-base">TOTAL REMUNERATIVO</th>
                                            <td class="px-6 py-4"></td>
                                            <td class="px-6 py-4"></td>
                                            <td class="px-6 py-4">$67564.74</td>
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
                                            <th scope="row" class="px-6 py-3 text-base">TOTAL FINAL</th>
                                            <td class="px-6 py-4"></td><td class="px-6 py-4"></td><td class="px-6 py-4"></td>
                                            <td class="px-6 py-4"></td><td class="px-6 py-4"></td><td class="px-6 py-4"></td>
                                            
                                            <td class="px-6 py-4 text-center text-base">$250.373,16</td>
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
                                    <td class="px-4 py-2 text-center border-b">-19000</td>
                                  </tr>
                                  <tr>
                                    <td class="px-4 py-2 text-center border-b">Celular:</td>
                                    <td class="px-4 py-2 text-center border-b">-4330</td>
                                  </tr>
                                  <tr>
                                    <td class="px-4 py-2 text-center border-b">Gastos:</td>
                                    <td class="px-4 py-2 text-center border-b">3200</td>
                                  </tr>
                                  <tr>
                                    <td class="px-4 py-2 text-center border-b font-bold">Subtotal:</td>
                                    <td class="px-4 py-2 text-center border-b text-red-500 font-bold">-20130</td>
                                  </tr>
                                </table>
                            </div>                   
                        </div>

                        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                            <label for="blank" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">&nbsp;</label>

                            <div class="relative overflow-x-auto shadow-md">
                                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 border border-gray-300">
                                    <tbody>
                                        <tfoot>
                                        <tr class="font-semibold border-b bg-green-200 dark:bg-gray-800 text-gray-900 dark:text-white">
                                            <th scope="row" class="px-6 py-3 text-base">TOTAL A DEPOSITAR</th>
                                            <td class="px-6 py-4"></td><td class="px-6 py-4"></td><td class="px-6 py-4"></td>
                                            <td class="px-6 py-4"></td><td class="px-6 py-4">
                                            
                                            <td class="px-6 py-4 text-center text-base">$230.243</td>
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