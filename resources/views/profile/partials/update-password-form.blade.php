<section class="bg-white rounded-2xl shadow-md p-8">
    <header class="mb-6">
        <h2 class="text-2xl font-bold text-slate-900">
            {{ __('Perbarui Kata Sandi') }}
        </h2>

        <p class="mt-2 text-sm text-slate-600">
            {{ __('Pastikan akun Anda menggunakan kata sandi yang panjang dan acak untuk keamanan maksimal.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="space-y-5">
        @csrf
        @method('put')

        <div>
            <label for="update_password_current_password" class="block text-sm font-semibold text-slate-700 mb-2">{{ __('Kata Sandi Saat Ini') }}</label>
            <input id="update_password_current_password" name="current_password" type="password" class="w-full px-4 py-2 rounded-lg border border-slate-200 bg-white focus:shadow-md focus:border-blue-300 focus:ring-0 transition" autocomplete="current-password" placeholder="Masukkan kata sandi saat ini" />
            @error('current_password', 'updatePassword')<span class="text-red-500 text-sm mt-1">{{ $message }}</span>@enderror
        </div>

        <div>
            <label for="update_password_password" class="block text-sm font-semibold text-slate-700 mb-2">{{ __('Kata Sandi Baru') }}</label>
            <input id="update_password_password" name="password" type="password" class="w-full px-4 py-2 rounded-lg border border-slate-200 bg-white focus:shadow-md focus:border-blue-300 focus:ring-0 transition" autocomplete="new-password" placeholder="Masukkan kata sandi baru" />
            @error('password', 'updatePassword')<span class="text-red-500 text-sm mt-1">{{ $message }}</span>@enderror
        </div>

        <div>
            <label for="update_password_password_confirmation" class="block text-sm font-semibold text-slate-700 mb-2">{{ __('Konfirmasi Kata Sandi') }}</label>
            <input id="update_password_password_confirmation" name="password_confirmation" type="password" class="w-full px-4 py-2 rounded-lg border border-slate-200 bg-white focus:shadow-md focus:border-blue-300 focus:ring-0 transition" autocomplete="new-password" placeholder="Masukkan ulang kata sandi baru" />
            @error('password_confirmation', 'updatePassword')<span class="text-red-500 text-sm mt-1">{{ $message }}</span>@enderror
        </div>

        <div class="flex gap-3 pt-4 border-t border-slate-200">
            <button type="submit" class="px-6 py-2.5 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition font-semibold shadow-sm">{{ __('Simpan Perubahan') }}</button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-green-600 font-medium"
                >{{ __('✓ Berhasil diperbarui') }}</p>
            @endif
        </div>
    </form>
</section>
