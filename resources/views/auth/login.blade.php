<x-guest-layout>
    <div class="mb-4 text-center">
        <h3 class="text-2xl font-bold text-gray-800">Masuk ke akun Anda</h3>
        <p class="text-sm text-gray-500 mt-1">Masukkan email dan password untuk melanjutkan</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="space-y-4">
            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email"
                    type="email" name="email"
                    :value="old('email')" required autofocus autocomplete="username" placeholder="email@contoh.com" />
                <x-input-error :messages="$errors->get('email')" />
            </div>

            <!-- Password -->
            <div>
                <x-input-label for="password" :value="__('Password')" />
                <x-text-input id="password"
                    type="password"
                    name="password"
                    required autocomplete="current-password" placeholder="Masukkan password" />
                <x-input-error :messages="$errors->get('password')" />
            </div>
        </div>

        <!-- Remember Me -->
        <div class="flex items-center justify-between mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox"
                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                    name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Ingat saya') }}</span>
            </label>

            <!-- Forgot Password -->
            @if (Route::has('password.request'))
                <a class="text-sm text-indigo-600 hover:text-indigo-800 underline" href="{{ route('password.request') }}">Lupa kata sandi?</a>
            @endif
        </div>

        <div class="mt-6">
            <x-primary-button class="w-full justify-center py-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>

        <!-- Link ke Register -->
        <div class="mt-4 text-center">
            <span class="text-sm text-gray-600">Belum punya akun?</span>
            <a href="{{ route('register') }}"
               class="ms-2 text-sm text-indigo-600 hover:text-indigo-800 font-semibold">Daftar di sini</a>
        </div>
    </form>
</x-guest-layout>
