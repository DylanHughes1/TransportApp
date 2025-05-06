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
                <input style="border: none; background-color: transparent; width: 125px; text-align: left;" data-id="1"
                    data-field="jubilacion" class="py-1 text-sm editable-percent" name="jubilacion"
                    value=" {{floatval($tabla2->jubilacion)}}%">
            </td>
            <td class="px-6 py-3">
                
            </td>
            <td class="descuento px-6 py-3">
                @php
                    $producto = ($tabla2->jubilacion / 100) * $tabla1->total_remun1;
                    echo str_replace(',', '', number_format($producto, 2));
                @endphp
            </td>

        </tr>
        <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
            <th scope="row" class="px-6 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                Obra Social
            </th>
            <td class="px-6 py-3">
                <input style="border: none; background-color: transparent; width: 125px; text-align: left;" data-id="2"
                    data-field="obra_social" class="py-1 text-sm editable-percent" name="obra_social"
                    value=" {{floatval($tabla2->obra_social)}}%">
            </td>
            <td class="px-6 py-3">

            </td>
            <td class="descuento px-6 py-3">
                @php
                    $producto = ($tabla2->obra_social / 100) * $tabla1->total_remun1;
                    echo str_replace(',', '', number_format($producto, 2));
                @endphp
            </td>

        </tr>
        <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
            <th scope="row" class="px-6 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                Cuota Solidaria
            </th>
            <td class="px-6 py-3">
                <input style="border: none; background-color: transparent; width: 125px; text-align: left;" data-id="3"
                    data-field="cuota_solidaria" class="py-1 text-sm editable-percent" name="cuota_solidaria"
                    value=" {{floatval($tabla2->cuota_solidaria)}}%">
            </td>
            <td class="px-6 py-3">

            </td>
            <td class="descuento px-6 py-3">
                @php
                    $producto = ($tabla2->cuota_solidaria / 100) * $tabla1->total_remun1;
                    echo str_replace(',', '', number_format($producto, 2));
                @endphp
            </td>

        </tr>
        <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
            <th scope="row" class="px-6 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                Ley 19.032
            </th>
            <td class="px-6 py-3">
                <input style="border: none; background-color: transparent; width: 125px; text-align: left;" data-id="4"
                    data-field="ley_19032" class="py-1 text-sm editable-percent" name="ley_19032"
                    value=" {{floatval($tabla2->ley_19032)}}%">
            </td>
            <td class="px-6 py-3">

            </td>
            <td class="descuento px-6 py-3">
                @php
                    $producto = ($tabla2->ley_19032 / 100) * $tabla1->total_remun1;
                    echo str_replace(',', '', number_format($producto, 2));
                @endphp
            </td>

        </tr>
        <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
            <th scope="row" class="px-6 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                Seguro Sepelio
            </th>
            <td class="px-6 py-3">
                <input style="border: none; background-color: transparent; width: 125px; text-align: left;" data-id="5"
                    data-field="seguro_sepelio" class="py-1 text-sm editable-percent" name="seguro_sepelio"
                    value=" {{floatval($tabla2->seguro_sepelio)}}%">
            </td>
            <td class="px-6 py-3">

            </td>
            <td class="descuento px-6 py-3">
                @php
                    $producto = ($tabla2->seguro_sepelio / 100) * $tabla1->total_remun1;
                    echo str_replace(',', '', number_format($producto, 2));
                @endphp
            </td>

        </tr>
        <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
            <th scope="row" class="px-6 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                AJU.APO.DTO.561/19
            </th>
            <td class="px-6 py-3">
                <input style="border: none; background-color: transparent; width: 125px; text-align: left;" data-id="6"
                    data-field="aju_apo_dto" class="py-1 text-sm editable-percent" name="aju_apo_dto"
                    value=" {{floatval($tabla2->aju_apo_dto)}}%">
            </td>
            <td class="px-6 py-3">

            </td>
            <td class="descuento px-6 py-3">
                @php
                    $producto = ($tabla2->aju_apo_dto / 100) * $tabla1->total_remun1;
                    echo str_replace(',', '', number_format($producto, 2));
                @endphp
            </td>

        </tr>
        <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
            <th scope="row" class="px-6 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                ASOC.MUT.1NOV.PMOS
            </th>
            <td class="px-6 py-3">
                <input style="border: none; background-color: transparent; width: 125px; text-align: left;" data-id="7"
                    data-field="asoc_mut_1nov" class="py-1 text-sm editable-percent" name="asoc_mut_1nov"
                    value=" {{floatval($tabla2->asoc_mut_1nov)}}%">
            </td>
            <td class="px-6 py-3">

            </td>
            <td class="descuento px-6 py-3">
                @php
                    $producto = ($tabla2->asoc_mut_1nov / 100) * $tabla1->total_remun1;
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
            <td id="total_descuento" class="px-6 py-3 text-red-500 font-bold">
                {{$tabla2->total_descuento}}
            </td>
        </tr>
    <tfoot>
        <tr class="font-semibold border-b bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-white">
            <th scope="row" class="px-6 py-4 text-base">SUBTOTAL 2</th>
            <td class="px-6 py-3"></td>
            <td class="px-6 py-3"></td>
            <td id="subtotal2" class="px-6 py-3">
                {{$tabla2->subtotal2}}
            </td>
        </tr>
    </tfoot>
    </tbody>
</table>

<script>
    $(document).ready(function () {
        const truckDriverId = '{{$truck_driver->id}}';
        const token = '{{ csrf_token() }}';
        const totalRemun1 = parseFloat($('#total_remun1').text()) || 0;

        $('.editable-percent').on('blur', function () {
            const inputField = $(this);
            const porcentaje = parseFloat(inputField.val()) || 0;
            const field = inputField.data('field');
            const descuento = calculateDescuento(porcentaje, totalRemun1);
            
            updateDescuentoColumn(inputField, descuento);
            sendAjaxRequest(`/admin/sueldo/actualizarValorDescuento/${truckDriverId}`, { field, value: porcentaje });
            updateTotalDescuento();
        });

        function calculateDescuento(porcentaje, total) {
            return (porcentaje / 100) * total;
        }

        function updateDescuentoColumn(inputField, descuento) {
            inputField.closest('tr').find('.descuento').text(descuento.toFixed(2));
        }

        function updateTotalDescuento() {
            let total_descuento = 0;

            $('.descuento').each(function () {
                total_descuento += parseFloat($(this).text()) || 0;
            });
            
            const subtotal2 = parseFloat("{{ $tabla1->total_remun1 }}") - total_descuento;

            $('#total_descuento').text(total_descuento.toFixed(2));
            $('#subtotal2').text(subtotal2.toFixed(2));

            let total_final = parseFloat($('#subtotal2').text()) - parseFloat($('#total_no_remun').text());
            $('#total_final').text(total_final.toFixed(2));

            let gastos_extra = parseFloat($('#subtotal_extra').text()) || 0;
            let total_depositar = total_final + gastos_extra;
            $('#total_depositar').text(total_depositar.toFixed(2));

            sendAjaxRequest(`/admin/sueldo/actualizarSubtotal2/${truckDriverId}`, { total_descuento, subtotal2 });
        }

        function sendAjaxRequest(url, data) {
            $.ajax({
                url: url,
                method: 'POST',
                data: { _token: token, ...data },
                success: function () {
                    console.log('Descuento actualizado en la base de datos');
                },
                error: function () {
                    console.log('Error al actualizar el descuento');
                }
            });
        }
    });
</script>
