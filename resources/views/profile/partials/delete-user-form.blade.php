<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">Hapus Akun</h2>
        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            Setelah akun dihapus, semua data akan hilang permanen. Harap pastikan sebelum melanjutkan.
        </p>
    </header>

    <x-danger-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')">
        {{ __('Hapus Akun') }}
    </x-danger-button>

    <x-modal name="confirm-user-deletion" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                Apakah Anda yakin ingin menghapus akun?
            </h2>

            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                Setelah akun dihapus, semua data akan hilang permanen. Tindakan ini tidak bisa dibatalkan.
            </p>

            <div class="mt-6">
                <x-input-label for="password" :value="__('Masukkan Kata Sandi Anda')" />
                <x-text-input id="password" name="password" type="password" class="mt-1 block w-3/4"
                              placeholder="********" />
                <x-input-error class="mt-2" :messages="$errors->userDeletion->get('password')" />
            </div>

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">Batal</x-secondary-button>
                <x-danger-button class="ml-3">Hapus Akun</x-danger-button>
            </div>
        </form>
    </x-modal>
</section>
