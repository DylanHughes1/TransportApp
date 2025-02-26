<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
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
            <th scope="row" class="px-6 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
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

        <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700 calculate-row">
            <th scope="row" class="px-6 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                Hs Extraordinarias por km recorrido
            </th>

            <td class="px-2 py-3">
                <input type="number" name="hs_ext_km_recorrido" data-id="1" data-field="hs_ext_km_recorrido"
                    style="border: none; background-color: transparent; width: 125px; text-align: left;"
                    class="py-1 text-sm editable-field" value="{{ $tabla1->hs_ext_km_recorrido }}">
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
        <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700 calculate-row">
            <th scope="row" class="px-6 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                Hs Extraord. por km recorrido – 100%
            </th>
            <td class="px-2 py-3">
                <input type="number" name="hs_ext_km_recorrido_100" data-id="2" data-field="hs_ext_km_recorrido_100"
                    style="border: none; background-color: transparent; width: 125px; text-align: left;"
                    class="py-1 text-sm editable-field" value="{{ $tabla1->hs_ext_km_recorrido_100 }}">
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
        <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700 calculate-row">
            <th scope="row" class="px-6 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                Permanencia fuera Resid. Habit inc.b)
            </th>
            <td class="px-2 py-3">
                <input type="number" data-id="3" data-field="perm_f_res"
                    style="border: none; background-color: transparent; width: 125px; text-align: left;"
                    class="py-1 text-sm editable-field" name="perm_f_res" value="{{ $tabla1->perm_f_res }}">
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
        <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700 calculate-row">
            <th scope="row" class="px-6 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                Control descarga
            </th>
            <td class="px-2 py-3">

                <input type="number" data-id="4" data-field="c_descarga"
                    style="border: none; background-color: transparent; width: 125px; text-align: left;"
                    class="py-1 text-sm editable-field" name="c_descarga" value="{{ $tabla1->c_descarga }}">
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
        <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700 calculate-row">
            <th scope="row" class="px-6 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                Horas extras al 50%
            </th>
            <td class="px-2 py-3">

                <input type="number" data-id="5" data-field="hs_50"
                    style="border: none; background-color: transparent; width: 125px; text-align: left;"
                    class="py-1 text-sm editable-field" name="hs_50" value="{{$tabla1->hs_50}}">
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
        <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700 calculate-row">
            <th scope="row" class="px-6 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                Horas extras al 100%
            </th>
            <td class="px-2 py-3">

                <input type="number" data-id="6" data-field="hs_100"
                    style="border: none; background-color: transparent; width: 125px; text-align: left;"
                    class="py-1 text-sm editable-field" name="hs_100" value="{{$tabla1->hs_100}}">
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
                Inasistencias Justificadas
            </th>
            <td class="px-6 py-3">
                Días
            </td>
            <td name="inasistencias_inj" class="mr-2 py-3">
                <input type="number" data-id="7" data-field="inasistencias_inj"
                    style="border: none; background-color: transparent; width: 125px; text-align: left;"
                    class="py-1 text-sm editable-field" name="inasistencias_inj" value="{{$tabla1->inasistencias_inj}}">
            </td>
            <td class="columna-total px-6 py-3">
                @php
                    $producto = ($tabla1->inasistencias_inj * ($datos->sueldo_basico / 30));
                    echo ($producto == 0) ? '0' : $producto;
                @endphp
            </td>
        </tr>
        <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
            <th scope="row" class="px-6 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                <span id="diaCamioneroToggle" class="text-green-500 font-semibold cursor-pointer">
                    Día del Camionero (15 diciembre)
                </span>
            </th>
            <td class="px-6 py-3"></td>
            <td class="px-6 py-5"></td>
            <td class="columna-total px-6 py-3" id="diaCamioneroValor" data-field="diaCamioneroValor">
                {{$datos->dia_camionero}}
            </td>
        </tr>

    <tfoot>
        <tr class="font-semibold border-b bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-white">
            <th scope="row" class="px-6 py-4 text-base text">SUBTOTAL 1</th>
            <td class="px-6 py-3"></td>
            <td class="px-6 py-3"></td>
            <td id="subtotal1" class="px-6 py-3 font-bold text-gray-900"> {{$tabla1->subtotal1}} </td>
        </tr>
    </tfoot>
    </tbody>
</table>

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
                <td class="w-20"></td>
                <td class="px-4 py-3">
                    <input type="number" data-id="8" data-field="antig"
                        style="border: none; background-color: transparent; width: 125px; text-align: left;"
                        class="py-1 text-sm editable-field" name="antig" value="{{intval($tabla1->antig)}}">
                </td>
                <td id="antig" class="subtotal1 py-3">
                    @php
                        $producto = ($tabla1->antig * $tabla1->subtotal1 * 0.01);
                        echo $producto;
                    @endphp
                </td>

            </tr>
            <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                <th scope="row" class="px-6 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    Vacaciones Anuales
                </th>
                <td class="w-16"></td>
                <td class="px-6 py-3">
                    Días:
                </td>
                <td class="px-6 py-3"></td>
                <td class="subtotal1 px-4 py-3">
                    <input type="number" data-id="8" data-field="vacaciones"
                        style="border: none; background-color: transparent; width: 125px; text-align: left;"
                        class="py-1 text-sm editable-field" name="antig" value="{{intval($tabla1->vacaciones)}}">
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
                <td id="total_remun1" class="pr-10 py-3">
                    {{$tabla1->total_remun1}}
                </td>
            </tr>
        </tfoot>
    </table>
</div>


<script>
    $(document).ready(function () {
        let isDiaCamioneroActive = true;
        const truckDriverId = '{{$truck_driver->id}}';
        const token = '{{ csrf_token() }}';
        const sueldoBasico = parseFloat("{{ $datos->sueldo_basico }}") || 0;

        $('.editable-field').on('blur', function () {
            const inputField = $(this);
            const value = parseFloat(inputField.val()) || 0;
            const id = inputField.data('id');
            const field = inputField.data('field');
            const totalColumn = inputField.closest('tr').find('.columna-total');

            updateTotalColumn(inputField, value, field, totalColumn);
            updateSubtotal();
            

            sendAjaxRequest(`/admin/sueldo/actualizarValor/${truckDriverId}`, { id, field, value });
        });

        $('#diaCamioneroToggle').on('click', function () {
            isDiaCamioneroActive = !isDiaCamioneroActive;
            $(this)
                .toggleClass('text-green-500 font-semibold')
                .toggleClass('text-gray-500 line-through font-normal');
            updateSubtotal();
        });

        function updateTotalColumn(inputField, value, field, totalColumn) {
            let product = 0;

            if (field === 'inasistencias_inj') {
                product = value * (sueldoBasico / 30);
            } else if (inputField.closest('tr').hasClass('calculate-row')) {
                const secondValue = parseFloat(inputField.closest('tr').find('td:nth-child(3)').text()) || 0;
                product = value * secondValue;
            }

            totalColumn.text(product.toFixed(2));
        }

        function updateSubtotal() {
            let subtotal = 0;
            let inasistenciasValue = 0;

            $('.columna-total').each(function () {
                const totalValue = parseFloat($(this).text()) || 0;
                const isInasistencias = $(this).closest('tr').find('input').data('field') === 'inasistencias_inj';
                const isDiaCamionero = $(this).attr('id') === 'diaCamioneroValor';

                if (isInasistencias) {
                    inasistenciasValue = totalValue;
                } else if (!isDiaCamionero || (isDiaCamionero && isDiaCamioneroActive)) {
                    subtotal += totalValue;
                }
            });

            subtotal -= inasistenciasValue;
            $('#subtotal1').text(subtotal.toFixed(2));
            updateTotalRemunerativo();
        }

        function updateTotalRemunerativo() {
            let subtotal1 = parseFloat($('#subtotal1').text()) || 0;
            let antiguedad = parseFloat($('input[data-field="antig"]').val()) || 0;
            let totalRemunerativo = subtotal1 + (subtotal1 * antiguedad * 0.01);
            $('#antig').text((subtotal1 * antiguedad * 0.01).toFixed(2));
            let total_descuento = parseFloat($('#total_descuento').text());

            let subtotal2 = totalRemunerativo + total_descuento;

            $('#total_remun1').text(totalRemunerativo.toFixed(2));

            sendAjaxRequest(`/admin/sueldo/actualizarTotales1/${truckDriverId}`, { subtotal1, total_remun1: totalRemunerativo });
            sendAjaxRequest(`/admin/sueldo/actualizarSubtotal2/${truckDriverId}`, { total_descuento, subtotal2 });

            $('#subtotal2').text(subtotal2.toFixed(2));

            let total_final = parseFloat($('#subtotal2').text()) - parseFloat($('#total_no_remun').text());
            $('#total_final').text(total_final.toFixed(2));

            let gastos_extra = parseFloat($('#subtotal_extra').text()) || 0;
            let total_depositar = total_final + gastos_extra;
            $('#total_depositar').text(total_depositar.toFixed(2));
        }

        function sendAjaxRequest(url, data) {
            $.ajax({
                url: url,
                method: 'POST',
                data: { _token: token, ...data },
                success: function () {
                    console.log('Actualización exitosa');
                },
                error: function () {
                    console.log('Error al actualizar');
                }
            });
        }
    });
</script>