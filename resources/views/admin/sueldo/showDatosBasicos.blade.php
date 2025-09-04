<x-admin-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-900 tracking-tight">
            Sueldos
        </h2>
    </x-slot>

    <div class="bg-gray-100 py-10">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <form method="POST" action="/admin/sueldo/datos" class="bg-white p-10 shadow-xl rounded-2xl border border-gray-200 space-y-10">
                @csrf
                @method('PUT')
                @foreach($datos as $dato)

                <!-- Sueldo Base -->
                <div>
                    <h2 class="text-lg font-bold text-gray-700 flex items-center mb-6">
                        <span class="w-1.5 h-6 bg-green-500 rounded mr-3"></span>
                        Sueldo Base
                    </h2>
                    <div class="grid md:grid-cols-3 gap-6">
                        <x-input-field label="Sueldo Básico" name="sueldo_basico" :value="$dato->sueldo_basico" />
                        <x-input-field label="Día del Camionero" name="dia_camionero" :value="$dato->dia_camionero" />
                        <x-input-field label="Vacaciones Anual por Día" name="vacaciones_anual_x_dia" :value="$dato->vacaciones_anual_x_dia" />
                    </div>
                </div>

                <!-- Remuneraciones Complementarias -->
                <div>
                    <h2 class="text-lg font-bold text-gray-700 flex items-center mb-6">
                        <span class="w-1.5 h-6 bg-blue-500 rounded mr-3"></span>
                        Remuneraciones Complementarias
                    </h2>
                    <div class="grid md:grid-cols-3 gap-6">
                        <x-input-field label="HS.EXT.KM.RECOR" name="hs_ext_km_recorrido" :value="$dato->hs_ext_km_recorrido" />
                        <x-input-field label="PERM,F/RES" name="perm_f_res" :value="$dato->perm_f_res" />
                        <x-input-field label="C.Descarga" name="c_descarga" :value="$dato->c_descarga" />
                    </div>
                </div>

                <!-- Viáticos -->
                <div>
                    <h2 class="text-lg font-bold text-gray-700 flex items-center mb-6">
                        <span class="w-1.5 h-6 bg-yellow-500 rounded mr-3"></span>
                        Viáticos Corta y Local
                    </h2>
                    <div class="grid md:grid-cols-3 gap-6">
                        <x-input-field label="Comida" name="comida" :value="$dato->comida" />
                        <x-input-field label="Especial" name="especial" :value="$dato->especial" />
                        <x-input-field label="Pernoctada" name="pernoctada" :value="$dato->pernoctada" />
                    </div>
                </div>

                <!-- Larga Distancia -->
                <div>
                    <h2 class="text-lg font-bold text-gray-700 flex items-center mb-6">
                        <span class="w-1.5 h-6 bg-purple-500 rounded mr-3"></span>
                        Larga Distancia
                    </h2>
                    <div class="grid md:grid-cols-3 gap-6">
                        <x-input-field label="KMS.REC" name="kms_rec" :value="$dato->kms_rec" />
                        <x-input-field label="PERM.F/RES Larga Distancia" name="perm_f_res_larga_distancia" :value="$dato->perm_f_res_larga_distancia" />
                        <x-input-field label="Cruce Frontera" name="cruce_frontera" :value="$dato->cruce_frontera" />
                    </div>
                </div>

                <!-- Botón -->
                <div class="pt-6 border-t flex justify-center">
                    <button type="submit" name="guardar"
                        class="inline-flex items-center px-8 py-3 bg-green-600 hover:bg-green-700 text-white text-base font-semibold rounded-xl shadow-md transition-all focus:ring-4 focus:ring-green-300">
                        Guardar
                    </button>
                </div>

                @endforeach
            </form>
        </div>
    </div>
</x-admin-app-layout>
