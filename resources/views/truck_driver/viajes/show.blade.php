<x-truck_driver-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Viaje {{ \Carbon\Carbon::parse($viaje->fecha_salida)->format('d/m/y') }}
            </h2>
        </x-slot>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">          
                        
                        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
                        
                        @component('components.viajeComps.formulario-viaje', ['viaje' => $viaje])
                        @endcomponent

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-truck-driver-app-layout>
