<form method="POST" action="/truck_driver/viajes/{{$viaje->id}}">
    @csrf
    @method('PUT')
    <div class="grid gap-6 mb-6 md:grid-cols-3">
        <div>                                  
            <label for="Fecha Salida" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Fecha Salida</label>
            <input type="date" name="fecha_salida" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" 
            value="{{ $viaje->fecha_salida }}" placeholder="Año-Mes-Día" required>
        </div>
        <div>
            <label for="destino" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Destino</label>
            <input type="text" name="destino" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" 
            value="{{ $viaje->destino }}"required="false">
        </div>
        <div>
            <label for="cargaKg" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Carga Kg</label>
            <input type="number" name="carga_kg" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
            value="{{ $viaje->carga_kg }}">
        </div>
        <div>
            <label for="Origen" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Origen</label>
            <input type="text" name="origen" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" 
            value="{{ $viaje->origen }}" required="false">
        </div>
        <div>
            <label for="km_salida" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Km Salida</label>
            <input type="number" name="km_salida" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
            value="{{ $viaje->km_salida }}">
        </div>
        <div>
            <label for="descargaKg" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Descarga Kg</label>
            <input type="number" name="descarga_kg" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
            value="{{ $viaje->descarga_kg }}">
        </div>
        <div>
            <label for="Fecha llegada" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Fecha Llegada</label>
            <input type="date" name="fecha_llegada" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" 
            value="{{ $viaje->fecha_llegada }}" required="false">
        </div>
        <div>
            <label for="porte" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Porte</label>
            <input type="number" name="c_porte" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
            value="{{ $viaje->c_porte }}">
        </div>
        <div>
            <label for="kmLlegada" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Km Llegada</label>
            <input type="number" name="km_llegada" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
            value="{{ $viaje->km_llegada }}">
        </div>
        <div>
            <label for="Km" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Km</label>
            <input type="number" name="km_viaje" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
            value="{{ $viaje->km_viaje }}">
        </div>
        <div>
            <label for="producto" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Producto</label>
            <input type="text" name="producto" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
            value="{{ $viaje->producto }}">
        </div>
        <div>
            <label for="km12" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Km 1,2</label>
            <input type="number" name="km_1_2" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
            value="{{ $viaje->km_1_2 }}">
        </div>
    </div>
        <div class="col-span-4 md:col-span-1 flex justify-end"> 
            <a href="b/{{$viaje->id}}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                Siguiente
                <svg aria-hidden="true" class="w-5 h-5 ml-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
            </a>
        </div>

        <div class="col-span-4 mt-4 md:mt-0">
            <td class="flex justify-between">
                <input type="hidden" name="finalizar" value="1">
                <button type="submit" name="finalizar" class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800"onclick="return confirm('¿Estás seguro que deseas finalizar?')">Finalizar</button>                                                       
                <button type="submit" name="guardar"class="focus:outline-none text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:focus:ring-yellow-900">Guardar</button>
                <a href="/truck_driver/dashboard" class="col-md-12 text-right">
                    <button type="button" id="nextButton" class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Cancelar</button>
                </a>
                <div class="space-y-6">
                @if ($errors->any())
                
                <div class="flex p-4 mb-4 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 dark:border-red-800" role="alert">
                    <svg aria-hidden="true" class="flex-shrink-0 inline w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                    <span class="sr-only">Info</span>
                    <div>
                    <span class="font-medium">Error!</span> Debe completar todos los datos para poder continuar.
                    </div>
                </div>
                @endif
            <td>
        </div>

</form>             