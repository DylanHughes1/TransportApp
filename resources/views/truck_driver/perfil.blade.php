{{-- @extends('layouts.template') --}}

<x-truck_driver-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ Auth::user()->name }}
        </h2>
    </x-slot>

    <body class="text-center">
        <div class="relative flex items-top justify-center min-h-screen sm:items-top py-4 sm:pt-0">

            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-gray-200">

                        <div class="relative overflow-x-auto flex">
                            <div class=" p-6 bg-white border-gray-200 px-2">
                                <table
                                    class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 text-center">
                                    <thead
                                        class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                        <tr>
                                            <th scope="col" class="px-6 py-5">
                                                Empresa
                                            </th>
                                            <th scope="col" class="px-6 py-5">
                                                Patente Chasis
                                            </th>
                                            <th scope="col" class="px-6 py-5">
                                                Patente Batea
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                            <td
                                                class="px-6 py-4 whitespace-no-wrap text-sm leading-5 font-medium text-green-500 hover:underline">
                                                @if (trim(Auth::user()->empresa) === 'A')
                                                    Don Mario
                                                @elseif (trim(Auth::user()->empresa) === 'B')
                                                    Cereal Flet Sur
                                                @else
                                                    Sin Empresa
                                                @endif
                                            </td>
                                            <td
                                                class="px-6 py-4 whitespace-no-wrap text-sm leading-5 font-medium text-green-500 hover:underline">
                                                {{ Auth::user()->p_chasis ?? '-' }}
                                            </td>
                                            <td
                                                class="px-6 py-4 whitespace-no-wrap text-sm leading-5 font-medium text-green-500 hover:underline">
                                                {{ Auth::user()->p_batea ?? '-'}}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                @if (trim(Auth::user()->empresa))
                                    <div class="flex justify-center mt-6 -mb-6">
                                        <form method="POST" action="/truck_driver/quitarEmpresa/{{ Auth::id() }}"
                                            class="inline-block">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="truckdriver_id" value="{{ Auth::id() }}">
                                            <button type="submit"
                                                class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                                                Quitar Empresa
                                            </button>
                                        </form>
                                    </div>
                                @endif

                            </div>
                        </div>
                    </div>
                </div>
    </body>
    </x-truck-driver-app-layout>

    </body>

    </html>