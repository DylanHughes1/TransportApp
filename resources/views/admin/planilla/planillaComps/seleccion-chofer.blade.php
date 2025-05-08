<label for="choferes" class="text-center block mb-2 text-sm font-medium text-gray-900 dark:text-white">Seleccione un
    Chofer</label>

<div class="relative py-3 w-full max-w-md">
    <input type="text" id="search"
        class="w-full p-3 pl-4 pr-4 text-sm text-gray-900 bg-white border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
        placeholder="Filtrar nombre del chofer" oninput="filterDrivers()">

    <ul id="results"
        class="z-100 absolute left-0 right-0 mt-1 bg-white border border-gray-300 rounded-lg shadow-lg text-sm text-gray-900 dark:bg-gray-700 dark:text-white dark:border-gray-600 hidden max-h-60 overflow-y-auto z-50">
        <!-- <li class="px-4 py-2 hover:bg-blue-100 dark:hover:bg-gray-600 cursor-pointer">Ejemplo</li> -->
    </ul>
</div>

<script>
    function filterDrivers() {
        const input = document.getElementById('search');
        const filter = input.value.trim().toLowerCase();
        const results = document.getElementById('results');

        results.innerHTML = '';

        if (!filter) {
            results.classList.add('hidden');
            return;
        }

        const filteredDrivers = @json($truck_drivers).filter(driver =>
            driver.name && driver.name.toLowerCase().includes(filter)
        );

        if (filteredDrivers.length > 0) {
            filteredDrivers.forEach(driver => {
                const listItem = document.createElement('li');
                listItem.textContent = driver.name;
                listItem.className = "px-4 py-2 hover:bg-blue-100 dark:hover:bg-gray-600 cursor-pointer";
                listItem.addEventListener('click', () => {
                    input.value = driver.name;
                    results.classList.add('hidden');
                    window.location.href = '/admin/planilla/' + driver.id;
                });
                results.appendChild(listItem);
            });
            results.classList.remove('hidden');
        } else {
            results.classList.add('hidden');
        }
    }
</script>

