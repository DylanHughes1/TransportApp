<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center">
                    <a href="/admin/dashboard">
                        <img src="https://res.cloudinary.com/dkfj6dqh2/image/upload/v1691175028/truck_tqj1yi.png" alt="logo" id="logo" style="width: 80px;">
                    </a>
                </div>

                <!-- Navigation Links -->
                {{-- <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                </x-nav-link>
            </div> --}}
        </div>

        <!-- Settings Dropdown -->
        <div class="hidden sm:flex sm:items-center sm:ml-6 relative">
            <div @click.away="open = false">
                <button @click="open = !open" class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                    <div>{{Auth::guard('admin')->user()->name }}</div>
                    <div class="ml-1">
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </div>
                </button>
                <div x-show="open" x-cloak class="origin-bottom-right absolute right-0 mt-2 w-48 rounded-md shadow-lg z-10">
                    <div class="py-1 bg-white rounded-md shadow-xs">
                        @auth('admin')
                        @if(auth('admin')->user()->isFullAdmin())
                        <a href="/admin/permisos" class="block w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900 text-left flex flex-items">
                            <svg class="w-5 h-5 mr-3" fill="#757575" viewBox="0 0 1920 1920" xmlns="http://www.w3.org/2000/svg">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <path d="M1707 1760c0 29.44-23.893 53.333-53.333 53.333h-320c-29.44 0-53.334-23.893-53.334-53.333v-266.667H1707V1760ZM213.667 1484.053V1337.6c0-86.613 56.426-162.133 140.48-187.947 182.826-56 373.12-82.24 562.346-82.986 146.88.746 292.8 19.413 436.267 54.4-44.053 39.04-72.427 95.466-72.427 158.933v106.667h-106.666v288.32c-87.467 20.266-176.96 31.68-266.667 31.68-144.427 0-423.467-29.334-693.333-222.614ZM1387 1280c0-58.773 47.893-106.667 106.667-106.667 58.773 0 106.666 47.894 106.666 106.667v106.667H1387V1280ZM899.533 106.667h14.934c174.08 0 322.346 122.56 357.653 290.24-30.187 17.493-61.44 29.76-115.52 29.76-69.547 0-101.12-19.947-141.227-45.227-45.653-28.8-97.28-61.44-196.906-61.44-100.374 0-152.32 32.747-198.187 61.653-26.773 16.96-49.813 31.467-82.987 39.147 25.28-177.28 178.134-314.133 362.24-314.133Zm807.467 1280V1280c0-61.653-26.667-116.8-68.587-155.733l.107-.107c-37.867-43.733-123.093-69.76-146.88-76.267-100.373-30.826-202.88-53.013-306.453-67.626C1306.893 894.72 1387 753.813 1387 594.133h-106.667c0 201.707-164.16 365.867-365.866 365.867h-14.934c-201.706 0-365.866-164.16-365.866-365.867v-64.32c66.24-9.173 106.88-34.773 143.573-57.92 40.107-25.28 71.787-45.226 141.227-45.226 68.693 0 100.16 19.84 139.946 45.013 45.867 28.907 97.814 61.653 198.187 61.653 100.373 0 152.533-33.066 202.453-64.746l28.267-18.027-3.84-33.28C1355.427 179.413 1153.72 0 914.467 0h-14.934C638.947 0 427 211.947 427 480v114.133c0 159.787 80.107 300.694 201.92 386.24-103.36 14.507-205.653 36.587-306.133 67.307C193.72 1087.36 107 1203.84 107 1337.6v200.213l21.333 15.894C429.453 1779.627 745.4 1813.333 907 1813.333c90.453 0 180.48-11.52 268.907-30.506 11.306 77.333 77.333 137.173 157.76 137.173h320c88.213 0 160-71.787 160-160v-373.333H1707Z" fill-rule="evenodd"></path>
                                </g>
                            </svg>
                            {{ __('Permisos') }}
                        </a>
                        @endif
                        @endauth
                        <form method="POST" action="{{ route('admin.logout') }}">
                            @csrf
                            <button type="submit" class="block w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900 text-left flex flex-items">
                                <svg class="w-5 h-5 mr-3 text-gray-500" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                    <g id="SVGRepo_iconCarrier">
                                        <path d="M21 12L13 12" stroke="#757575" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                        <path d="M18 15L20.913 12.087V12.087C20.961 12.039 20.961 11.961 20.913 11.913V11.913L18 9" stroke="#757575"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                        <path
                                            d="M16 5V4.5V4.5C16 3.67157 15.3284 3 14.5 3H5C3.89543 3 3 3.89543 3 5V19C3 20.1046 3.89543 21 5 21H14.5C15.3284 21 16 20.3284 16 19.5V19.5V19"
                                            stroke="#757575" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                    </g>
                                </svg>
                                {{ __('Cerrar Sesión') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Hamburger -->
        <div class="-mr-2 flex items-center sm:hidden">
            <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                    <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::guard('admin')->user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::guard('admin')->user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <!-- Authentication -->
                <form method="POST" action="{{ route('admin.logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('admin.logout')"
                        onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Cerrar Sesión') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>