<x-truck_driver-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Viaje {{ \Carbon\Carbon::parse($viaje->fecha_salida)->format('d/m/y') }}
        </h2>
    </x-slot>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex items-center justify-center pb-4">
                        <form action="/truck_driver/viajes/b/{{$viaje->id}}" method="POST" class="w-full">
                            @csrf
                            @method('PUT')
                            <div class="grid gap-6 mb-6 md:grid-cols-2">

                                <div class="text-center">
                                    <h2 class="block mb-2 text-lg font-medium text-gray-900 dark:text-white">Campos
                                        Opcionales</h2>
                                </div>
                                <div>
                                    <label for="Combustible"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Cargó
                                        Combustible?</label>
                                    <select id="combustible"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        <option selected>Selecione una opción</option>
                                        <option value="si">Si</option>
                                        <option value="no">No</option>
                                    </select>
                                </div>
                                <button id="myButton" class="hidden" data-modal-toggle="combustibleModal"
                                    type="button"></button>

                                <script>

                                    $('#combustible').on('change', function () {

                                        if ($(this).val() === 'si') {
                                            $('[data-modal-toggle="combustibleModal"]').trigger('click');
                                        }
                                    });

                                </script>

                                <div>
                                    <label for="gasto"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Ingrese
                                        cualquier gasto extra</label>
                                    <textarea id="observacion" name="observacion" rows="4"
                                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        placeholder="Arreglo de pinchadura, Gasto en Peaje..."
                                        onchange="autoSave(this)">{{ $viaje->observacion }}</textarea>
                                </div>


                                <div class="text-left">
                                    <a href="/truck_driver/viajes/{{$viaje->id}}"
                                        class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                                        <svg aria-hidden="true" class="w-5 h-5 mr-2" fill="currentColor"
                                            viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M7.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l2.293 2.293a1 1 0 010 1.414z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                        Anterior
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <!-- Modal toggle -->
    <button
        class="hidden text-white bg-gradient-to-br from-pink-500 to-voilet-500 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 text-center inline-flex items-center shadow-md shadow-gray-300 hover:scale-[1.02] transition-transform"
        type="button" data-modal-toggle="combustibleModal">
        Toggle modal
    </button>

    <!-- Main modal -->
    <div id="combustibleModal" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full">
        <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex justify-between items-start p-5 rounded-t border-b dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 lg:text-2xl dark:text-white">
                        Combustible
                    </h3>
                    <button type="button"
                        class=" text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-toggle="combustibleModal">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-6 space-y-6">
                    <form method="POST" action="/truck_driver/viajes/b/{{ $viaje->id }}">
                        @csrf

                        <div class="form-group">
                            <label for="campo1"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">KM</label>
                            <input type="number" name=Km id="campo1"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="campo1"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Fecha de
                                carga:</label>
                            <input type="date" name="fecha" id="campo1"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="campo1"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Litros:</label>
                            <input type="number" name="litros" id="campo1"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="campo1"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Lugar de
                                Carga:</label>
                            <input type="text" name="lugar_carga" id="campo1"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                required>
                        </div>
                        <input type="hidden" name="viaje_id" value="{{ $viaje->id }}">

                </div>
                <!-- Modal footer -->
                <div class="flex items-center p-6 space-x-2 rounded-b border-t border-gray-200 dark:border-gray-600">
                    <button type="submit"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Guardar</button>

                </div>
                </form>
            </div>
        </div>
    </div>
    </div>

    <script>
        function autoSave(input) {
            let formData = new FormData();
            formData.append(input.name, input.value);

            $.ajax({
                url: "/truck_driver/viajes/autoSave/{{$viaje->id}}",
                method: "POST",
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'X-HTTP-Method-Override': 'PUT'
                },
                success: function (response) {
                    console.log("Guardado automáticamente");
                },
                error: function (error) {
                    console.error("Error al guardar", error);
                }
            });
        }
    </script>

    </x-truck-driver-app-layout>