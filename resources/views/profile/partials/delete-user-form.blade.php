<section class="space-y-6 bg-red-50 rounded-2xl shadow-md p-8 border border-red-200">
    <header>
        <h2 class="text-2xl font-bold text-red-900">
            {{ __('Hapus Akun') }}
        </h2>

        <p class="mt-2 text-sm text-red-700">
            {{ __('Setelah akun Anda dihapus, semua data dan sumber daya akan dihapus secara permanen. Silakan unduh data yang ingin Anda simpan sebelum menghapus akun.') }}
        </p>
    </header>

    <button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="px-6 py-2.5 bg-red-600 text-white rounded-lg hover:bg-red-700 transition font-semibold shadow-sm"
    >{{ __('Hapus Akun Saya') }}</button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-8 space-y-6">
            @csrf
            @method('delete')

            <div>
                <h2 class="text-2xl font-bold text-red-900">
                    {{ __('Anda yakin ingin menghapus akun?') }}
                </h2>

                <p class="mt-2 text-sm text-slate-600">
                    {{ __('Tindakan ini tidak dapat dibatalkan. Semua data Anda akan dihapus secara permanen. Masukkan kata sandi Anda untuk mengonfirmasi.') }}
                </p>
            </div>

            <div>
                <label for="password" class="block text-sm font-semibold text-slate-700 mb-2">{{ __('Kata Sandi') }}</label>

                <input
                    id="password"
                    name="password"
                    type="password"
                    class="w-full px-4 py-2 rounded-lg border border-slate-200 bg-white focus:shadow-md focus:border-red-300 focus:ring-0 transition"
                    placeholder="{{ __('Masukkan kata sandi Anda') }}"
                />

                @error('password', 'userDeletion')<span class="text-red-500 text-sm mt-1">{{ $message }}</span>@enderror
            </div>

            <div class="flex gap-3 pt-4 border-t border-slate-200">
                <button type="button" x-on:click="$dispatch('close')" class="flex-1 px-6 py-2.5 bg-slate-100 text-slate-700 rounded-lg hover:bg-slate-200 transition font-semibold">
                    {{ __('Batal') }}
                </button>

                <button type="submit" class="flex-1 px-6 py-2.5 bg-red-600 text-white rounded-lg hover:bg-red-700 transition font-semibold shadow-sm">
                    {{ __('Hapus Akun') }}
                </button>
            </div>
        </form>
    </x-modal>
</section>
