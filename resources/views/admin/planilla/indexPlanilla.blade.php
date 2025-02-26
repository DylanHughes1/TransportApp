<x-admin-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Planilla
        </h2>
    </x-slot>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

    <body class="text-center bg-gray-100">
        <div class="flex items-top justify-center min-h-screen py-4">
            <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-md sm:rounded-lg p-8">
                    <h1 class="text-center text-3xl font-bold text-gray-900 mb-8">Planilla Viajes</h1>
                    <div class="flex justify-between items-start gap-4">

                        <!-- Sección del select -->
                        <div class="w-1/2 rounded-lg border border-gray-200 p-6 rounded-md shadow-md mr-4">
                            @component('admin.planilla.planillaComps.seleccion-chofer', ['truck_drivers' => $truck_drivers])
                            @endcomponent
                        </div>

                        <hr class="border-t border-gray-200 my-6">
                        <!-- Sección de la card -->
                        <div class="w-1/2 flex justify-center">
                            <a href="planillaEmpresa"
                                class="block w-full p-6 bg-white border border-gray-200 rounded-lg shadow-md hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700 transition-colors duration-300 ease-in-out">
                                <div class="flex flex-col items-center">
                                    <svg class="w-14 h-14 mb-2" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round">
                                        </g>
                                        <g id="SVGRepo_iconCarrier">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M4 4H15.0607L20 8.93934V20H4V4ZM5.5 5.5V11.5H8.01421L8.02556 5.5H5.5ZM9.52556 5.5L9.51421 11.5H18.5V10H14V5.5H9.52556ZM15.5 6.56066L17.4393 8.5H15.5V6.56066ZM18.5 13H9.51138L9.50759 15H18.5V13ZM18.5 16.5H9.50476L9.50097 18.5H18.5V16.5ZM8.00097 18.5L8.00475 16.5H5.5V18.5H8.00097ZM5.5 15H8.00759L8.01137 13H5.5V15Z"
                                                fill="#1F2328"></path>
                                        </g>
                                    </svg>
                                    <h5
                                        class="text-xl font-bold tracking-tight text-gray-900 dark:text-white text-center">
                                        Planilla de Empresa</h5>
                                </div>
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </body>

</x-admin-app-layout>