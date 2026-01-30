<x-guest-layout>
    
        <div class="w-full max-w-md p-6 bg-white rounded shadow-lg text-center">
            
            {{-- Logo --}}
            <div class="mb-4">
                <img src="{{ asset('images/logo.png') }}" alt="Logo PU" class="mx-auto w-24 h-24">
            </div>

            {{-- Judul --}}
            <h1 class="text-2xl font-semibold text-gray-800">e-Notulen</h1>
            <p class="mt-1 text-sm text-gray-600 leading-tight">
                Website E-Notulen Online <br>
                Kementerian Pekerjaan Umum <br>
                Direktorat Jenderal Bina Marga <br>
                Direktorat Bina Teknik Jalan dan Jembatan
            </p>

            {{-- Status Session --}}
            <x-auth-session-status class="mb-4" :status="session('status')" />

            {{-- Form Login --}}
            <form method="POST" action="{{ route('login') }}" class="mt-6 text-left">
                @csrf

                {{-- Email --}}
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input id="email" type="email" name="email" :value="old('email')" required autofocus
                        class="w-full px-3 py-2 mt-1 border rounded focus:outline-none focus:ring focus:border-blue-300" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                {{-- Password --}}
                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input id="password" type="password" name="password" required
                        class="w-full px-3 py-2 mt-1 border rounded focus:outline-none focus:ring focus:border-blue-300" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                {{-- Remember Me --}}
                <div class="mb-4 flex items-center">
                    <input id="remember_me" type="checkbox" class="mr-2 rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                    <label for="remember_me" class="text-sm text-gray-600">Remember me</label>
                </div>

                {{-- Forgot Password + Submit --}}
                <div class="flex items-center justify-between">
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-sm text-gray-600 hover:text-gray-900">
                            Forgot your password?
                        </a>
                    @endif

                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                         Sign In
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
