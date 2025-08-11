@extends('layouts.template')

<x-truck_driver-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Remito
        </h2>
    </x-slot>

    <body class="antialiased">
        <div class="relative flex items-top justify-center min-h-screen sm:items-top py-4 sm:pt-0">
            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 bg-white border-b border-gray-200">

                            <form action="/truck_driver/viajes/image/{{$viaje->id}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <label class="block mb-4 text-lg font-medium text-gray-900 dark:text-white">Ingrese imágenes del remito</label>
                                <div id="image-inputs" class="flex flex-col space-y-4 w-full max-w-full sm:max-w-md mx-auto px-2 sm:px-0">
                                    <div class="flex items-center space-x-2">
                                        <input name="images[]" type="file" accept=".png, .jpg" required
                                            class="flex-grow text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 box-border">
                                        <button type="button" class="add-btn px-3 py-1 bg-blue-600 text-white rounded hover:bg-blue-700 min-w-[32px]">+</button>
                                        <button type="button" class="remove-btn px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700 min-w-[32px]" disabled>-</button>
                                    </div>
                                </div>


                                <hr class="h-px my-8 bg-gray-200 border-0 dark:bg-gray-700">

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

                                // Función para actualizar los botones (solo el último input tiene botón + habilitado, 
                                // el botón - está deshabilitado solo si hay 1 input)
                                function updateButtons() {
                                    const rows = container.querySelectorAll('div.flex.items-center');
                                    rows.forEach((row, i) => {
                                        const addBtn = row.querySelector('.add-btn');
                                        const removeBtn = row.querySelector('.remove-btn');
                                        // Solo el último input tiene el botón +
                                        addBtn.disabled = i !== rows.length - 1;
                                        addBtn.style.display = i === rows.length - 1 ? 'inline-block' : 'none';
                                        // El botón - solo deshabilitado si es el único input
                                        removeBtn.disabled = rows.length === 1;
                                    });
                                }

                                // Añadir listener al contenedor para delegar eventos en botones + y -
                                container.addEventListener('click', (e) => {
                                    if (e.target.classList.contains('add-btn')) {
                                        e.preventDefault();
                                        const newRow = document.createElement('div');
                                        newRow.className = 'flex items-center space-x-2';

                                        const input = document.createElement('input');
                                        input.type = 'file';
                                        input.name = 'images[]';
                                        input.accept = '.png, .jpg';
                                        input.className = 'flex-grow text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400';

                                        const addButton = document.createElement('button');
                                        addButton.type = 'button';
                                        addButton.className = 'add-btn px-3 py-1 bg-blue-600 text-white rounded hover:bg-blue-700';
                                        addButton.textContent = '+';

                                        const removeButton = document.createElement('button');
                                        removeButton.type = 'button';
                                        removeButton.className = 'remove-btn px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700';
                                        removeButton.textContent = '-';

                                        newRow.appendChild(input);
                                        newRow.appendChild(addButton);
                                        newRow.appendChild(removeButton);

                                        container.appendChild(newRow);

                                        updateButtons();
                                    }

                                    if (e.target.classList.contains('remove-btn')) {
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
                            <hr class="h-px my-8 bg-gray-200 border-0 dark:bg-gray-700">

                            <div class="p-4 sm:p-6 space-y-6 text-base text-gray-800 dark:text-gray-200">
                                @if ($viaje->imagenesViajes->count() > 0)
                                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                                    @foreach ($viaje->imagenesViajes as $imagenViaje)
                                    <div class="relative bg-gray-50 dark:bg-gray-800 rounded-lg shadow hover:shadow-md transition-shadow">
                                        <img
                                            class="rounded-t-lg w-full h-40 sm:h-48 md:h-52 object-cover"
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
                                <p class="text-center text-gray-500 dark:text-gray-400 italic">No hay imágenes asociadas</p>
                                @endif
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
    </x-truck-driver-app-layout>