<table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400 border-b">
        <tr>
            <th scope="col" class="px-6 py-3">
                Datos
            </th>
            <th scope="col" class="px-6 py-3">
                Cantidad
            </th>
            <th scope="col" class="pr-16 py-3">
                Valor
            </th>
            <th scope="col" class="px-6 py-3">
                Total
            </th>
        </tr>
    </thead>

    <tbody class="text-justify">
        <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
            <th scope="row" class="px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                <input
                    class="bg-white text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    name="viatico_x_km_name" value="{{$tabla3->viatico_x_km_name}}" disabled>
            </th>
            <td class="px-2 py-3">
                <input type="number"
                    style="border: none; background-color: transparent; width: 125px; text-align: left;" data-id="1"
                    data-field="viatico_x_km" class="py-1 text-sm editable-amount" name="viatico_x_km"
                    value="{{$tabla3->viatico_x_km}}">
            </td>
            <td class="mr-6 py-3">
                {{$datos->kms_rec}}
            </td>
            <td class="px-6 py-3 col-total">
                {{$tabla3->viatico_x_km * $datos->kms_rec}}
            </td>

        </tr>
        <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
            <th scope="row" class="px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                <input data-field="cruce_frontera_name"
                    class="editable-name bg-white text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    name="cruce_frontera_name" value="{{$tabla3->cruce_frontera_name}}">
            </th>
            <td class="px-2 py-3">
                <input type="number"
                    style="border: none; background-color: transparent; width: 125px; text-align: left; " data-id="2"
                    data-field="cruce_frontera" class="py-1 text-sm editable-amount" name="cruce_frontera"
                    value="{{$tabla3->cruce_frontera}}">
            </td>
            <td class="mr-6 py-3">
                {{$datos->cruce_frontera}}
            </td>
            <td class="px-6 py-3 col-total">
                {{$tabla3->cruce_frontera * $datos->cruce_frontera}}
            </td>

        </tr>
        <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
            <th scope="row" class="px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                <input data-field="comida_name"
                    class="editable-name bg-white text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    name="comida_name" value="{{$tabla3->comida_name}}">
            </th>
            <td class="px-2 py-3">
                <input type="number"
                    style="border: none; background-color: transparent; width: 125px; text-align: left; " data-id="3"
                    data-field="comida" class="py-1 text-sm editable-amount" name="comida" value="{{$tabla3->comida}}">
            </td>
            <td class="mr-6 py-3">
                {{$datos->comida}}
            </td>
            <td class="px-6 py-3 col-total">
                {{$tabla3->comida * $datos->comida}}
            </td>

        </tr>
        <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
            <th scope="row" class="px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                <input data-field="especial_name"
                    class="editable-name bg-white text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    name="especial_name" value="{{$tabla3->especial_name}}">
            </th>
            <td class="px-2 py-3">
                <input type="number"
                    style="border: none; background-color: transparent; width: 125px; text-align: left; " data-id="4"
                    data-field="especial" class="py-1 text-sm editable-amount" name="especial"
                    value="{{$tabla3->especial}}">
            </td>
            <td class="mr-6 py-3">
                {{$datos->especial}}
            </td>
            <td class="px-6 py-3 col-total">
                {{$tabla3->especial * $datos->especial}}
            </td>

        </tr>
        <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
            <th scope="row" class="px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                <input data-field="pernoctada_name"
                    class="editable-name bg-white text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    name="pernoctada_name" value="{{$tabla3->pernoctada_name}}">
            </th>
            <td class="px-2 py-3">
                <input type="number"
                    style="border: none; background-color: transparent; width: 125px; text-align: left; " data-id="5"
                    data-field="pernoctada" class="py-1 text-sm editable-amount" name="pernoctada"
                    value="{{$tabla3->pernoctada}}">
            </td>
            <td class="mr-6 py-3">
                {{$datos->pernoctada}}
            </td>
            <td class="px-6 py-3 col-total">
                {{$tabla3->pernoctada * $datos->pernoctada}}
            </td>

        </tr>
        <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
            <th scope="row" class="px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                <input data-field="permanencia_fuera_rec_name"
                    class="editable-name bg-white text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    name="permanencia_fuera_rec_name" value="{{$tabla3->permanencia_fuera_rec_name}}">
            </th>
            <td class="px-2 py-3">
                <input type="number"
                    style="border: none; background-color: transparent; width: 125px; text-align: left; " data-id="6"
                    data-field="permanencia_fuera_rec" class="py-1 text-sm editable-amount" name="permanencia_fuera_rec"
                    value="{{$tabla3->permanencia_fuera_rec}}">
            </td>
            <td class="mr-6 py-3">
                {{$datos->perm_f_res}}
            </td>
            <td class="px-6 py-3 col-total">
                {{$tabla3->permanencia_fuera_rec * $datos->perm_f_res}}
            </td>

        </tr>
        <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
            <th scope="row" class="px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                <input data-field="viatico_km_1_2_name"
                    class="editable-name bg-white text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    name="viatico_km_1_2_name" value="{{$tabla3->viatico_km_1_2_name}}">
            </th>
            <td class="px-2 py-3">
                <input type="number"
                    style="border: none; background-color: transparent; width: 125px; text-align: left; " data-id="7"
                    data-field="viatico_km_1_2" class="py-1 text-sm editable-amount" name="viatico_km_1_2"
                    value="{{$tabla3->viatico_km_1_2}}">
            </td>
            <td class="mr-6 py-3">
                {{$datos->km_1_2}}
            </td>
            <td class="px-6 py-3 col-total">
                {{$tabla3->viatico_km_1_2 * $datos->km_1_2}}
            </td>

        </tr>
        <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
            <th scope="row" class="px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                <input data-field="adicional_vacas_anuales_name"
                    class="editable-name bg-white text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    name="adicional_vacas_anuales_name" value="{{$tabla3->adicional_vacas_anuales_name}}">
            </th>
            <td class="px-2 py-3">
                <input type="number"
                    style="border: none; background-color: transparent; width: 125px; text-align: left; " data-id="8"
                    data-field="adicional_vacas_anuales" class="py-1 text-sm editable-amount"
                    name="adicional_vacas_anuales" value="{{$tabla3->adicional_vacas_anuales}}">
            </td>
            <td class="mr-6 py-3">
                {{$datos->vacaciones_anual_x_dia}}
            </td>
            <td class="px-6 py-3 col-total">
                {{$tabla3->adicional_vacas_anuales * $datos->vacaciones_anual_x_dia}}
            </td>

        </tr>
        <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
            <th scope="row" class="px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                <input data-field="asignacion_no_remuner_name"
                    class="editable-name bg-white text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    name="asignacion_no_remuner_name" value="{{($tabla3->asignacion_no_remuner_name)}}">
            </th>
            <td class="px-2 py-3">
                <input type="number"
                    style="border: none; background-color: transparent; width: 125px; text-align: left; " data-id="9"
                    data-field="asignacion_no_remuner" class="py-1 text-sm editable-amount" name="asignacion_no_remuner"
                    value="{{($tabla3->asignacion_no_remuner)}}">

            </td>
            <td class="mr-6 py-3">
                -
            </td>
            <td class="px-6 py-3 col-total">
                {{ $tabla3->asignacion_no_remuner ? $tabla3->asignacion_no_remuner : 0 }}
            </td>
        </tr>

        @if(count($tabla3->nuevasFilas) > 0)
        @foreach ($tabla3->nuevasFilas as $nuevaFila)
        <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
            <th scope="row" class="px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                <input
                    class="editable-rowName bg-white text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    data-field="nombre" data-id="{{$nuevaFila->id}}" name="nombre{{$nuevaFila->id}}"
                    value="{{$nuevaFila->nombre}}">
            </th>
            <td class="px-2 py-3">
                &nbsp;&nbsp;&nbsp;-
            </td>
            <td class="mr-6 py-3">
                <input type="number"
                    style="border: none; background-color: transparent; width: 125px; text-align: left;"
                    data-id="{{$nuevaFila->id}}" data-field="valor" class="py-1 text-sm editable-rowAmount"
                    name="valor{{$nuevaFila->id}}" value="{{$nuevaFila->valor}}">
            </td>
            <td class="px-6 py-3 col-total">
                {{ $nuevaFila->valor ? $nuevaFila->valor : 0 }}
            </td>
        </tr>

        @endforeach
        @endif

    <tfoot>
        <tr class="font-semibold border-b bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-white">
            <th scope="row" class="px-6 py-4 text-base">TOTAL NO REMUNERATIVO</th>
            <td class="px-6 py-3"></td>
            <td class="px-6 py-3"></td>
            <td id="total_no_remun" class="px-6 py-3">{{$tabla3->total_remun2 }}</td>
        </tr>
    </tfoot>
    </tbody>
</table>

<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <label for="blank" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">&nbsp;</label>

    <div class="relative overflow-x-auto shadow-md">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <tbody>
            <tfoot>
                <tr class="font-semibold border-b bg-yellow-200 dark:bg-gray-800 text-gray-900 dark:text-white">
                    <th scope="row" class="px-6 py-4 text-base">TOTAL FINAL</th>
                    <td class="px-6 py-3"></td>
                    <td class="px-6 py-3"></td>
                    <td class="px-6 py-3"></td>
                    <td class="px-6 py-3"></td>
                    <td class="px-6 py-3"></td>
                    <td class="px-6 py-3"></td>

                    <td id="total_final" class="px-6 py-3 text-center text-base">
                        {{$tabla2->subtotal2 - $tabla3->total_remun2}}
                    </td>
                </tr>
            </tfoot>
            </tbody>
        </table>
    </div>
</div>

<div class="relative overflow-x-auto shadow-md">
    <label for="blank" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">&nbsp;</label>

    <div class="flex justify-end shadow-md">
        <table class="w-auto bg-gray-200 border border-gray-300">
            <tr>
                <td class="px-4 py-2 text-center border-b">Adelantos:</td>
                <td class="px-4 py-2 text-center border-b"> <input type="number"
                        class="editable-value bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        data-field="adelantos" name="adelantos" value="{{$tabla3->adelantos}}"></td>
            </tr>
            <tr>
                <td class="px-4 py-2 text-center border-b">Celular:</td>
                <td class="px-4 py-2 text-center border-b"><input type="number"
                        class="editable-value bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        data-field="celular" name="celular" value="{{$tabla3->celular}}"></td>
            </tr>
            <tr>
                <td class="px-4 py-2 text-center border-b">Gastos:</td>
                <td class="px-4 py-2 text-center border-b"><input type="number"
                        class="editable-value bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        data-field="gastos" name="gastos" value="{{$tabla3->gastos}}"></td>
            </tr>
            <tr>
                <td class="px-4 py-2 text-center border-b font-bold">Subtotal:</td>
                <td id="subtotal_extra" class="px-4 py-2 text-center border-b text-red-500 font-bold">
                    @php
                    $subtotal = $tabla3->adelantos + $tabla3->celular + $tabla3->gastos;
                    @endphp
                    @if($subtotal !== 0.00)
                    -{{ number_format($subtotal, 2) }}
                    @else
                    -
                    @endif
                </td>

            </tr>
        </table>
    </div>
</div>

<script>
    $(document).ready(function() {
        const truckDriverId = '{{$truck_driver->id}}';
        const token = '{{ csrf_token() }}';

        $('.editable-amount').on('blur', function() {
            const inputField = $(this);
            const value = parseFloat(inputField.val()) || 0;
            const field = inputField.data('field')
            const totalColumn = inputField.closest('tr').find('.col-total');

            updateTotalColumn(inputField, value, totalColumn);
            sendAjaxRequest(`/admin/sueldo/actualizarValor3/${truckDriverId}`, {
                field,
                value
            });
            updateTotalNoRemunerativo();

        });

        $('.editable-value').on('blur', function() {
            const inputField = $(this);
            const value = parseFloat(inputField.val()) || 0;
            const field = inputField.attr('name');

            sendAjaxRequest(`/admin/sueldo/actualizarGastosExtra/${truckDriverId}`, {
                field,
                value
            });
            updateSubtotalColumn();
        });

        $('.editable-name').on('blur', function() {
            const inputField = $(this);
            const value = inputField.val().trim();
            const field = inputField.data('field');
            sendAjaxRequest(`/admin/sueldo/actualizarNombre3/${truckDriverId}`, {
                field,
                value
            });
        });
        $('.editable-rowName').on('blur', function() {
            const inputField = $(this);
            const value = inputField.val();
            const field = inputField.data('field');
            const id = inputField.data('id');
            sendAjaxRequest(`/admin/sueldo/actualizarNombreNuevaFila/${id}`, {
                field,
                value
            });
        });
        $('.editable-rowAmount').on('blur', function() {
            const inputField = $(this);
            const value = parseFloat(inputField.val()) || 0;
            const field = inputField.data('field');
            const id = inputField.data('id');
            const totalColumn = inputField.closest('tr').find('.col-total');
            totalColumn.text(value.toFixed(2));

            sendAjaxRequest(`/admin/sueldo/actualizarValorNuevaFila/${id}`, {
                field,
                value
            });
            updateTotalNoRemunerativo();
        });

        function updateTotalColumn(inputField, value, totalColumn) {
            let product = 0;
            if (inputField.closest('tr')) {
                const secondValue = parseFloat(inputField.closest('tr').find('td:nth-child(3)').text()) || 1;
                product = value * secondValue;
            }
            totalColumn.text(product.toFixed(2));

            sendAjaxRequest(`/admin/sueldo/actualizarTotalNoRenum/${truckDriverId}`, {
                product
            });
            updateTotalNoRemunerativo();
        }

        function updateTotalNoRemunerativo() {
            let subtotal = 0;
            let inasistenciasValue = 0;

            $('.col-total').each(function() {
                const totalValue = parseFloat($(this).text()) || 0;
                subtotal += totalValue;
            });

            $('#total_no_remun').text(subtotal.toFixed(2));

            let subtotal2 = parseFloat($('#subtotal2').text()) || 0;
            let total_final = subtotal2 + subtotal;
            $('#total_final').text(total_final.toFixed(2));

            sendAjaxRequest(`/admin/sueldo/actualizarTotalNoRenum/${truckDriverId}`, {
                subtotal
            });

            let subtotal_extra = parseFloat($('#subtotal_extra').text()) || 0;

            let total_depositar = total_final + subtotal_extra;
            $('#total_depositar').text(total_depositar.toFixed(2));
        }

        function updateSubtotalColumn() {
            const adelantos = parseFloat($('input[name="adelantos"]').val()) || 0;
            const celular = parseFloat($('input[name="celular"]').val()) || 0;
            const gastos = parseFloat($('input[name="gastos"]').val()) || 0;

            const subtotal = adelantos + celular + gastos;
            let formattedSubtotal = subtotal !== 0 ? "-" + subtotal.toFixed(2) : "-";
            $('#subtotal_extra').text(formattedSubtotal);


            let total_final = parseFloat($('#total_final').text()) || 0;
            let total_depositar = total_final - subtotal;
            $('#total_depositar').text(total_depositar.toFixed(2));


        }

        function sendAjaxRequest(url, data) {
            $.ajax({
                url: url,
                method: 'POST',
                data: {
                    _token: token,
                    ...data
                },
                success: function() {
                    console.log('Actualización exitosa');
                },
                error: function() {
                    console.log('Error al actualizar');
                }
            });
        }
    });
</script>