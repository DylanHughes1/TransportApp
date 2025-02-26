<x-admin-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Sueldos
        </h2>
    </x-slot>

    <body class="text-center">
        <div class="flex items-top justify-center min-h-screen py-4">
            <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-md sm:rounded-lg p-8">
                    <h1 class="text-center text-3xl font-bold text-gray-900 mb-8">Sueldos</h1>
                    <div class="flex justify-between items-start gap-4">

                        <!-- Sección del select -->
                        <div class="w-1/2 rounded-lg border border-gray-200 p-6 rounded-md shadow-md mr-4">
                            @component('admin.sueldo.sueldosComps.seleccion-chofer', ['truck_drivers' => $truck_drivers])
                            @endcomponent
                        </div>

                        <hr class="border-t border-gray-200 my-6">
                        <!-- Sección de la card -->
                        <div class="w-1/2 flex justify-center">
                            <a href="sueldo/datos"
                                class="redirect-link block w-full p-6 bg-white border border-gray-200 rounded-lg shadow-md hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700 transition-colors duration-300 ease-in-out">
                                <div class="flex flex-col items-center">
                                    <svg class="w-14 h-14 mb-2" fill="#000000" viewBox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg">
                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round">
                                        </g>
                                        <g id="SVGRepo_iconCarrier">
                                            <path
                                                d="M406.083 788.495c0-5.657-4.583-10.24-10.24-10.24h-81.92a10.238 10.238 0 00-10.24 10.24v119.47h102.4v-119.47zm-143.36 160.43v-160.43c0-28.278 22.922-51.2 51.2-51.2h81.92c28.278 0 51.2 22.922 51.2 51.2v160.43h-184.32z">
                                            </path>
                                            <path
                                                d="M549.443 706.575c0-5.657-4.583-10.24-10.24-10.24h-81.92a10.238 10.238 0 00-10.24 10.24v201.39h102.4v-201.39zm-143.36 242.35v-242.35c0-28.278 22.922-51.2 51.2-51.2h81.92c28.278 0 51.2 22.922 51.2 51.2v242.35h-184.32z">
                                            </path>
                                            <path
                                                d="M692.803 624.655c0-5.657-4.583-10.24-10.24-10.24h-81.92a10.238 10.238 0 00-10.24 10.24v283.31h102.4v-283.31zm-143.36 324.27v-324.27c0-28.278 22.922-51.2 51.2-51.2h81.92c28.278 0 51.2 22.922 51.2 51.2v324.27h-184.32zm-92.985-663.189l-80.404-158.218c-3.461-6.812 1.489-14.878 9.134-14.878h251.628c7.645 0 12.59 8.061 9.127 14.873l-80.397 158.224c-5.124 10.084-1.103 22.412 8.981 27.536s22.412 1.103 27.536-8.981l80.394-158.218c17.319-34.058-7.427-74.394-45.64-74.394H385.189c-38.208 0-62.956 40.328-45.651 74.392l80.406 158.221c5.124 10.083 17.453 14.104 27.536 8.979s14.104-17.453 8.979-27.536z">
                                            </path>
                                            <path
                                                d="M725.04 909.844c101.8 0 184.32-82.52 184.32-184.32v-43.151c0-197.073-161.327-358.4-358.4-358.4h-79.923c-197.073 0-358.4 161.327-358.4 358.4v43.151c0 101.797 82.526 184.32 184.32 184.32H725.04zm0 40.96H296.957c-124.415 0-225.28-100.862-225.28-225.28v-43.151c0-219.695 179.665-399.36 399.36-399.36h79.923c219.695 0 399.36 179.665 399.36 399.36v43.151c0 124.422-100.858 225.28-225.28 225.28z">
                                            </path>
                                        </g>
                                    </svg>
                                    <h5
                                        class="text-xl font-bold tracking-tight text-gray-900 dark:text-white text-center">
                                        Datos para liquidar Sueldos</h5>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('components.spinner')
        @vite(['resources/scripts/Spinner/Spinner.js'])
    </body>
</x-admin-app-layout>