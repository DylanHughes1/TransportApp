<x-truck_driver-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <img src="https://res.cloudinary.com/dkfj6dqh2/image/upload/v1691175028/truck_tqj1yi.png" alt="logo" id="logo" style="width: 200px;">
                <div class="fs-3 text-center">Chofer</div>
            </a>
        </x-slot>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('truck_driver.login') }}">
            @csrf
        
            <!-- Email Address -->
            <div>
                <x-label for="email" :value="__('Email')" />
        
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>
        
            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Contraseña')" />
        
                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="current-password" />
            </div>
        
            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
                    <span class="ml-2 text-sm text-gray-600">{{ __('Recuérdame') }}</span>
                </label>
            </div>
        
            <div class="flex items-center justify-between mt-4">
                <div>
                    @if (Route::has('truck_driver.password.request'))
                        <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('truck_driver.password.request') }}">
                            {{ __('¿Olvidó su contraseña?') }}
                        </a>
                    @endif
                </div>
        
                <div>
                    @if (Route::has('truck_driver.register'))
                        <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('truck_driver.register') }}">
                            {{ __('Registrarse') }}
                        </a>
                    @endif
                </div>
        
                <x-button class="ml-3">
                    {{ __('Entrar') }}
                </x-button>
            </div>
        </form>
        
    </x-auth-card>
</x-truck_driver-guest-layout>