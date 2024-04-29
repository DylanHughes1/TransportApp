<label for="choferes" class="text-center block mb-2 text-sm font-medium text-gray-900 dark:text-white">Seleccione un
    Chofer</label>

<div>
    <input type="text" id="search"
        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
        placeholder="Filtrar nombre del chofer" oninput="filterDrivers()">

    <ul class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
        id="results" style="display: none;">
    </ul>
</div>

<script>
    function filterDrivers() {
        const input = document.getElementById('search');
        const filter = input.value ? input.value.toLowerCase() : '';
        const results = document.getElementById('results');

        // Limpiar los resultados anteriores
        results.innerHTML = '';

        if (!filter) {
            results.style.display = 'none';
            return;
        }

        const filteredDrivers = @json($truck_drivers).filter(driver =>
            driver.name && driver.name.toLowerCase().includes(filter)
        );

        if (filteredDrivers.length > 0) {
            results.style.display = 'block';

            let li = "";
            filteredDrivers.forEach(driver => {
                const listItem = document.createElement('li');
                listItem.textContent = driver.name;
                listItem.style.padding = '5px 10px'; // Agregar padding
                listItem.style.margin = '2px 0';

                listItem.addEventListener('click', () => {
                    input.value = driver.name;
                    results.style.display = 'none';
                    window.location.href = '/admin/planilla/' + driver.id;
                });

                li += "<li>" + driver.name + "</li>";
                li += "<hr>";
                results.appendChild(listItem);
            });
        } else {
            results.style.display = 'none';
        }
        results.style.position = 'absolute';
        results.style.zIndex = '1';
    }
</script>
