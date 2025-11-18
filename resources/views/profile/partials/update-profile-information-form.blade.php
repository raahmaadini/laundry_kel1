<section class="bg-white rounded-2xl shadow-md p-8">
    <header class="mb-6">
        <h2 class="text-2xl font-bold text-slate-900">
            {{ __('Informasi Profil') }}
        </h2>

        <p class="mt-2 text-sm text-slate-600">
            {{ __('Perbarui nama dan alamat email akun Anda.') }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="space-y-5">
        @csrf
        @method('patch')

        <div>
            <label for="name" class="block text-sm font-semibold text-slate-700 mb-2">{{ __('Nama Lengkap') }}</label>
            <input id="name" name="name" type="text" class="w-full px-4 py-2 rounded-lg border border-slate-200 bg-white focus:shadow-md focus:border-blue-300 focus:ring-0 transition" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name" placeholder="Masukkan nama lengkap Anda" />
            @error('name')<span class="text-red-500 text-sm mt-1">{{ $message }}</span>@enderror
        </div>

        <div>
            <label for="email" class="block text-sm font-semibold text-slate-700 mb-2">{{ __('Email') }}</label>
            <input id="email" name="email" type="email" class="w-full px-4 py-2 rounded-lg border border-slate-200 bg-white focus:shadow-md focus:border-blue-300 focus:ring-0 transition" value="{{ old('email', $user->email) }}" required autocomplete="username" placeholder="Masukkan email Anda" />
            @error('email')<span class="text-red-500 text-sm mt-1">{{ $message }}</span>@enderror

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-3 p-3 bg-yellow-50 border border-yellow-200 rounded-lg">
                    <p class="text-sm text-yellow-800">
                        {{ __('Email Anda belum diverifikasi.') }}

                        <button form="send-verification" class="font-semibold text-yellow-600 hover:text-yellow-700 ml-1">
                            {{ __('Klik di sini untuk mengirim ulang email verifikasi.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('Email verifikasi telah dikirim ke alamat email Anda.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex gap-3 pt-4 border-t border-slate-200">
            <button type="submit" class="px-6 py-2.5 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition font-semibold shadow-sm">{{ __('Simpan Perubahan') }}</button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-green-600 font-medium"
                >{{ __('✓ Berhasil disimpan') }}</p>
            @endif
        </div>
    </form>
</section>
