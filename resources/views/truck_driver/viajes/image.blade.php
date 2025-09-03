@extends('layouts.template')

<x-truck_driver-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Remito
        </h2>
    </x-slot>

    <body class="antialiased">
        <div class="relative flex items-top justify-center min-h-screen sm:items-top py-4 sm:pt-0">
            <div class="py-6 sm:py-12 w-full">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-4 sm:p-6 bg-white border-b border-gray-200">

                            <form action="/truck_driver/viajes/image/{{$viaje->id}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="mb-6">
                                    <label class="block mb-4 text-base sm:text-lg font-medium text-gray-900 dark:text-white leading-tight">
                                        Ingrese imágenes del remito
                                    </label>

                                    <div id="image-inputs" class="w-full space-y-3">
                                        <div class="flex items-center gap-2 w-full">
                                            <input
                                                name="images[]"
                                                type="file"
                                                accept=".png, .jpg"
                                                required
                                                class="flex-1 min-w-0 text-xs sm:text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400">
                                            <button
                                                type="button"
                                                class="add-btn flex-shrink-0 w-8 h-8 sm:w-9 sm:h-9 flex items-center justify-center bg-blue-600 text-white rounded hover:bg-blue-700 text-sm sm:text-base">
                                                +
                                            </button>
                                            <button
                                                type="button"
                                                class="remove-btn flex-shrink-0 w-8 h-8 sm:w-9 sm:h-9 flex items-center justify-center bg-red-600 text-white rounded hover:bg-red-700 text-sm sm:text-base"
                                                disabled>
                                                -
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <div class="flex items-center justify-center mt-6 space-x-4">
                                    <button type="submit" name="guardar"
                                        class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                                        Guardar
                                    </button>
                                    <a href="/truck_driver/dashboard" class="col-md-12 text-right">
                                        <button type="button" id="nextButton"
                                            class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">
                                            Cancelar
                                        </button>
                                    </a>
                                </div>
                            </form>

                            <script>
                                const container = document.getElementById('image-inputs');

                                function updateButtons() {
                                    const rows = container.querySelectorAll('div.flex.items-center');
                                    rows.forEach((row, i) => {
                                        const addBtn = row.querySelector('.add-btn');
                                        const removeBtn = row.querySelector('.remove-btn');

                                        addBtn.style.display = i === rows.length - 1 ? 'flex' : 'none';
                                        addBtn.disabled = i !== rows.length - 1;

                                        removeBtn.disabled = rows.length === 1;
                                        removeBtn.style.opacity = rows.length === 1 ? '0.5' : '1';
                                    });
                                }

                                container.addEventListener('click', (e) => {
                                    if (e.target.classList.contains('add-btn') && !e.target.disabled) {
                                        e.preventDefault();

                                        const newRow = document.createElement('div');
                                        newRow.className = 'flex items-center gap-2 w-full';

                                        const input = document.createElement('input');
                                        input.type = 'file';
                                        input.name = 'images[]';
                                        input.accept = '.png, .jpg';
                                        input.className = 'flex-1 min-w-0 text-xs sm:text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400';

                                        const addButton = document.createElement('button');
                                        addButton.type = 'button';
                                        addButton.className = 'add-btn flex-shrink-0 w-8 h-8 sm:w-9 sm:h-9 flex items-center justify-center bg-blue-600 text-white rounded hover:bg-blue-700 focus:ring-2 focus:ring-blue-500 focus:outline-none transition-colors text-sm sm:text-base';
                                        addButton.textContent = '+';

                                        const removeButton = document.createElement('button');
                                        removeButton.type = 'button';
                                        removeButton.className = 'remove-btn flex-shrink-0 w-8 h-8 sm:w-9 sm:h-9 flex items-center justify-center bg-red-600 text-white rounded hover:bg-red-700 focus:ring-2 focus:ring-red-500 focus:outline-none transition-colors text-sm sm:text-base';
                                        removeButton.textContent = '-';

                                        newRow.appendChild(input);
                                        newRow.appendChild(addButton);
                                        newRow.appendChild(removeButton);

                                        container.appendChild(newRow);
                                        updateButtons();
                                    }

                                    if (e.target.classList.contains('remove-btn') && !e.target.disabled) {
                                        e.preventDefault();
                                        const rows = container.querySelectorAll('div.flex.items-center');
                                        if (rows.length > 1) {
                                            e.target.parentElement.remove();
                                            updateButtons();
                                        }
                                    }
                                });

                                updateButtons();
                            </script>

                            <hr class="h-px my-6 sm:my-8 bg-gray-200 border-0 dark:bg-gray-700">

                            <label class="block mb-4 text-base sm:text-lg font-medium text-gray-900 dark:text-white leading-tight">
                                Imágenes ya cargadas
                            </label>
                            <div class="p-2 sm:p-4 space-y-4 sm:space-y-6 text-base text-gray-800 dark:text-gray-200">
                                @if ($viaje->imagenesViajes->count() > 0)
                                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3 sm:gap-4">
                                    @foreach ($viaje->imagenesViajes as $imagenViaje)
                                    <div class="relative bg-gray-50 dark:bg-gray-800 rounded-lg shadow hover:shadow-md transition-shadow">
                                        <img
                                            class="rounded-t-lg w-full h-32 sm:h-40 md:h-48 lg:h-52 object-cover"
                                            src="{{ $imagenViaje->image_link }}"
                                            alt="Imagen del remito"
                                            loading="lazy">
                                        <div class="p-3">
                                            <a href="{{ $imagenViaje->image_link }}" target="_blank" rel="noopener noreferrer">
                                                <button
                                                    class="w-full mt-2 px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                                    Ver Imagen
                                                </button>
                                            </a>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                @else
                                <p class="text-center text-gray-500 dark:text-gray-400 italic px-4">No hay imágenes asociadas</p>
                                @endif
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
    </x-truck-driver-app-layout>