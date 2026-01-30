<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">Ubah Kata Sandi</h2>
        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            Pastikan kata sandi Anda panjang dan aman agar akun tetap terlindungi.
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div>
            <x-input-label for="current_password" :value="__('Kata Sandi Saat Ini')" />
            <x-text-input id="current_password" name="current_password" type="password" 
                          class="mt-1 block w-full" autocomplete="current-password" />
            <x-input-error class="mt-2" :messages="$errors->get('current_password')" />
        </div>

        <div>
            <x-input-label for="password" :value="__('Kata Sandi Baru')" />
            <x-text-input id="password" name="password" type="password" 
                          class="mt-1 block w-full" autocomplete="new-password" />
            <x-input-error class="mt-2" :messages="$errors->get('password')" />
        </div>

        <div>
            <x-input-label for="password_confirmation" :value="__('Konfirmasi Kata Sandi')" />
            <x-text-input id="password_confirmation" name="password_confirmation" type="password" 
                          class="mt-1 block w-full" autocomplete="new-password" />
            <x-input-error class="mt-2" :messages="$errors->get('password_confirmation')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>Simpan</x-primary-button>

            @if (session('status') === 'password-updated')
                <p x-data="{ show: true }" x-show="show"
                   x-transition x-init="setTimeout(() => show = false, 2000)"
                   class="text-sm text-green-600 dark:text-green-400">
                    {{ __('Tersimpan.') }}
                </p>
            @endif
        </div>
    </form>
</section>
