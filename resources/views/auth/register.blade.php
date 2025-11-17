<x-guest-layout>
    <div class="mb-4 text-center">
        <h3 class="text-2xl font-bold text-gray-800">Buat akun baru</h3>
        <p class="text-sm text-gray-500 mt-1">Daftar untuk mulai mengelola laundry Anda</p>
    </div>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="space-y-4">
            <!-- Name -->
            <div>
                <x-input-label for="name" :value="__('Nama')" />
                <x-text-input id="name" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="Nama lengkap" />
                <x-input-error :messages="$errors->get('name')" />
            </div>

            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="email@contoh.com" />
                <x-input-error :messages="$errors->get('email')" />
            </div>

            <!-- Password -->
            <div>
                <x-input-label for="password" :value="__('Password')" />
                <x-text-input id="password" type="password" name="password" required autocomplete="new-password" placeholder="Minimal 8 karakter" />
                <x-input-error :messages="$errors->get('password')" />
            </div>

            <!-- Confirm Password -->
            <div>
                <x-input-label for="password_confirmation" :value="__('Konfirmasi Password')" />
                <x-text-input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Ketik ulang password" />
                <x-input-error :messages="$errors->get('password_confirmation')" />
            </div>
        </div>

        <div class="mt-6 flex items-center justify-between">
            <a class="text-sm text-indigo-600 hover:text-indigo-800" href="{{ route('login') }}">Sudah punya akun? Masuk</a>

            <x-primary-button class="py-2 px-4">
                {{ __('Daftar') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
