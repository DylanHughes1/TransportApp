<x-admin-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Permisos
        </h2>
    </x-slot>

    <body class="bg-gray-100 min-h-screen px-4 py-8">

        <div class="max-w-7xl mx-auto">
            {{-- Grid: dos tablas lado a lado --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-12">

                {{-- Administradores --}}
                <div class="bg-white shadow-md rounded-lg p-6">
                    <h2 class="text-2xl font-semibold text-gray-800 mb-4">Administradores</h2>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 text-sm">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-4 py-2 text-left">ID</th>
                                    <th class="px-4 py-2 text-left">Nombre</th>
                                    <th class="px-4 py-2 text-left">Subrol</th>
                                    <th class="px-4 py-2 text-left">Acción</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @forelse($admins as $admin)
                                <tr>
                                    <td class="px-4 py-2">{{ $admin->id }}</td>
                                    <td class="px-4 py-2">{{ $admin->name }}</td>
                                    <td class="px-4 py-2">
                                        <form method="POST" action="/admin/{{$admin->id}}/update-subrol">
                                            @csrf
                                            @method('PUT')
                                            <select name="subrol" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                <option value="full" {{ $admin->subrole === 'full' ? 'selected' : '' }}>Full</option>
                                                <option value="limitado" {{ $admin->subrole === 'limitado' ? 'selected' : '' }}>Limitado</option>
                                            </select>
                                    </td>
                                    <td class="px-4 py-2">
                                        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                                            Guardar
                                        </button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="px-4 py-2 text-center text-gray-500">
                                        No hay administradores registrados.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- Choferes --}}
                <div class="bg-white shadow-md rounded-lg p-6">
                    <h2 class="text-2xl font-semibold text-gray-800 mb-4">Choferes</h2>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 text-sm">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-4 py-2 text-left">ID</th>
                                    <th class="px-4 py-2 text-left">Nombre</th>
                                    <th class="px-4 py-2 text-left">Acción</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @forelse($truck_drivers as $driver)
                                <tr>
                                    <td class="px-4 py-2">{{ $driver->id }}</td>
                                    <td class="px-4 py-2">{{ $driver->name }}</td>
                                    <td class="px-4 py-2">
                                        <form method="POST" action="/admin/{{$driver->id}}/truck-drivers/">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900"
                                                onclick="return confirm('¿Seguro que deseas eliminar este chofer?')">
                                                Eliminar
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="3" class="px-4 py-2 text-center text-gray-500">
                                        No hay choferes registrados.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
        @include('components.spinner')
        @vite(['resources/scripts/Spinner/Spinner.js'])
    </body>

</x-admin-app-layout>