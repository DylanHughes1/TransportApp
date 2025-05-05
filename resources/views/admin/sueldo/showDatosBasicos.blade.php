<x-admin-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Sueldos
        </h2>
    </x-slot>

    <body class="bg-gray-100 text-center">
        <div class="min-h-screen flex items-top justify-center py-12 px-4 sm:px-6 lg:px-8">
            <div class="max-w-5xl w-full space-y-6">
                <form method="POST" action="/admin/sueldo/datos/" class="bg-white p-8 shadow rounded-lg">
                    @csrf
                    @method('PUT')
                    @foreach($datos as $dato)

                    <div class="mb-6">
                        <h2 class="text-xl font-semibold text-left text-gray-800 border-b pb-2 mb-4">Sueldo Base</h2>
                        <div class="grid md:grid-cols-3 gap-6">
                            <x-input-field label="Sueldo Básico" name="sueldo_basico" :value="$dato->sueldo_basico" />
                            <x-input-field label="Día del Camionero" name="dia_camionero" :value="$dato->dia_camionero" />
                            <x-input-field label="Vacaciones Anual por Día" name="vacaciones_anual_x_dia" :value="$dato->vacaciones_anual_x_dia" />
                        </div>
                    </div>

                    <div class="mb-6">
                        <h2 class="text-xl font-semibold text-left text-gray-800 border-b pb-2 mb-4">Remuneraciones Complementarias</h2>
                        <div class="grid md:grid-cols-3 gap-6">
                            <x-input-field label="HS.EXT.KM.RECOR" name="hs_ext_km_recorrido" :value="$dato->hs_ext_km_recorrido" />
                            <x-input-field label="PERM,F/RES" name="perm_f_res" :value="$dato->perm_f_res" />
                            <x-input-field label="C.Descarga" name="c_descarga" :value="$dato->c_descarga" />
                        </div>
                    </div>

                    <div class="mb-6">
                        <h2 class="text-xl font-semibold text-left text-gray-800 border-b pb-2 mb-4">Viáticos Corta y Local</h2>
                        <div class="grid md:grid-cols-3 gap-6">
                            <x-input-field label="Comida" name="comida" :value="$dato->comida" />
                            <x-input-field label="Especial" name="especial" :value="$dato->especial" />
                            <x-input-field label="Pernoctada" name="pernoctada" :value="$dato->pernoctada" />
                        </div>
                    </div>

                    <div class="mb-6">
                        <h2 class="text-xl font-semibold text-left text-gray-800 border-b pb-2 mb-4">Larga Distancia</h2>
                        <div class="grid md:grid-cols-3 gap-6">
                            <x-input-field label="KMS.REC" name="kms_rec" :value="$dato->kms_rec" />
                            <x-input-field label="PERM.F/RES Larga Distancia" name="perm_f_res_larga_distancia" :value="$dato->perm_f_res_larga_distancia" />
                            <x-input-field label="Cruce Frontera" name="cruce_frontera" :value="$dato->cruce_frontera" />
                        </div>
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" name="guardar"
                            class="inline-flex items-center px-6 py-2 bg-green-600 hover:bg-green-700 text-white text-sm font-medium rounded-lg focus:ring-4 focus:ring-green-300">
                            Guardar
                        </button>
                    </div>

                    @endforeach
                </form>
            </div>
        </div>
    </body>
</x-admin-app-layout>