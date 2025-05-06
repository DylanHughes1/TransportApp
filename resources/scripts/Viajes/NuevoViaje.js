document.addEventListener("DOMContentLoaded", () => {

    // Dropdown
    function setupDropdown(dropdownId, buttonId, selectedSpanId, hiddenInputId, textInputId) {
        const dropdownButton = document.getElementById(buttonId);
        const selectedOptionSpan = document.getElementById(selectedSpanId);
        const selectedOptionInput = document.getElementById(hiddenInputId);
        const nuevaLocalidadInput = document.getElementById(textInputId);
        const dropdownMenu = document.getElementById(dropdownId);

        if (!dropdownButton || !selectedOptionSpan || !selectedOptionInput || !nuevaLocalidadInput || !dropdownMenu) {
            console.error(`Error: Uno o más elementos no encontrados para ${dropdownId}`);
            return;
        }

        dropdownButton.addEventListener("click", () => {
            dropdownMenu.classList.toggle("hidden");
        });

        const options = dropdownMenu.querySelectorAll("a");
        options.forEach(option => {
            option.addEventListener("click", (event) => {
                event.preventDefault();
                const selectedValue = option.getAttribute("data-value");

                if (selectedValue === "Seleccionar Localidad") {
                    nuevaLocalidadInput.disabled = false;
                    selectedOptionInput.value = "";
                } else {
                    nuevaLocalidadInput.value = "";
                    nuevaLocalidadInput.disabled = true;
                    selectedOptionInput.value = selectedValue;
                }

                selectedOptionSpan.textContent = option.textContent;
                dropdownMenu.classList.add("hidden");
            });
        });
    }

    setupDropdown("dropdownOrigen", "dropdownOrigenButton", "selectedOption", "selectedOptionInput", "salida");
    setupDropdown("dropdownDestino", "dropdownDestinoButton", "selectedOption2", "selectedOptionInput2", "destino");

    // Show Input
    function showInputField() {
        document.getElementById('input-tonelada').classList.add('hidden');
        document.getElementById('input-total').classList.add('hidden');

        const selectedOption = document.querySelector('input[name="pricing-option"]:checked');

        if (selectedOption) {
            if (selectedOption.value === 'tonelada') {
                document.getElementById('input-tonelada').classList.remove('hidden');
            } else if (selectedOption.value === 'total') {
                document.getElementById('input-total').classList.remove('hidden');
            }
        }
    }
    document.querySelectorAll('input[name="pricing-option"]').forEach((input) => {
        input.addEventListener('change', showInputField);
    });
    window.addEventListener('DOMContentLoaded', showInputField);

    //Spinner
    $(document).ready(function () {
        $('form').on('submit', function () {
            $('#loading-spinner').removeClass('hidden');
            $('button, input[type="submit"]').prop('disabled', true);
        });
    });

});
