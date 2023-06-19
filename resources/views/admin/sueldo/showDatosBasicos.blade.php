<x-admin-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Sueldos
        </h2>
    </x-slot>

    <body class="text-center">
        <div class="relative flex items-top justify-center min-h-screen sm:items-top py-4 sm:pt-0">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                       
                        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
                        
                        <form method="POST" action="/admin/sueldo/datos">
                            @csrf
                            @method('PUT')
                            @foreach($datos as $dato)
                                <div class="grid gap-6 mb-6 md:grid-cols-3">

                                    <div>
                                        <label for="Basico" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Sueldo Básico</label>
                                        <input type="text" name="Basico" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        value="{{$dato->sueldo_basico}}">
                                    </div>
                                    <div>
                                        <label for="dia_camionero" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Día del Camionero</label>
                                        <input type="text" name="dia_camionero" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        value="{{$dato->dia_camionero}}">
                                    </div>
                                    <div>
                                        <label for="vacaciones_anual_x_dia" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Vacaciones Anual por Día</label>
                                        <input type="text" name="vacaciones_anual_x_dia" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        value="{{$dato->vacaciones_anual_x_dia}}">
                                    </div>

                                    <div>      
                                        <h2 class="text-lg font-bold dark:text-white text-center">Remuneraciones Complementarias</h2>                         
                                        <label for="blank" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">&nbsp;</label>
                                        
                                        <label for="HS.EXT.KM.RECOR" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">HS.EXT.KM.RECOR</label>
                                        <input type="text" name="HS.EXT.KM.RECOR" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" 
                                        value="{{$dato->hs_ext_km_recorrido}}" required>
                                    </div>
                                    <div>
                                        <h2 class="text-lg font-bold dark:text-white text-center">Viáticos Corta y Local</h2>                         
                                        <label for="blank" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">&nbsp;</label>
                                        
                                        <label for="Comida" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Comida</label>
                                        <input type="text" name="Comida" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" 
                                        value="{{$dato->comida}}"required="false">
                                    </div>
                                    <div>
                                        <h2 class="text-lg font-bold dark:text-white text-center">Larga Distancia</h2>   
                                        <label for="blank" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">&nbsp;</label>
                                        
                                        <label for="KMS.REC" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">KMS.REC</label>
                                        <input type="text" name="KMS.REC" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        value="{{$dato->kms_rec}}">
                                    </div>
                                    <div>
                                        <label for="PERM,F/RES" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">PERM,F/RES</label>
                                        <input type="text" name="PERM,F/RES" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" 
                                        value="{{$dato->perm_f_res}}" required="false">
                                    </div>
                                    <div>
                                        <label for="Especial" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Especial</label>
                                        <input type="text" name="Especial" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        value="{{$dato->especial}}">
                                    </div>
                                    <div>
                                        <label for="PERM.F/RES" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">PERM.F/RES</label>
                                        <input type="text" name="PERM.F/RES" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        value="{{$dato->perm_f_res_larga_distancia}}">
                                    </div>
                                    <div>
                                        <label for="C.DESCARGA" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">C.Descarga</label>
                                        <input type="text" name="C.DESCARGA" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" 
                                        value="{{$dato->c_descarga}}" required="false">
                                    </div>
                                    <div>
                                        <label for="Pernoctada" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pernoctada</label>
                                        <input type="text" name="Pernoctada" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        value="{{$dato->pernoctada}}">
                                    </div>
                                    <div>
                                        <label for="Cruce Frontera" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Cruce Frontera</label>
                                        <input type="text" name="Cruce Frontera" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        value="{{$dato->cruce_frontera}}">
                                    </div>

                                    <div>
                                        <button type="submit" name="guardar"class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Guardar</button>
                                    </div>
                                </div>
                            @endforeach
                        </form>  

                    </div>
                </div>
            </div>
        </div>
    </body>
</x-admin-app-layout>