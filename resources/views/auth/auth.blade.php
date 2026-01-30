<!DOCTYPE html>
<html lang="id" class="h-full bg-gray-100 dark:bg-gray-900 dark:text-white" x-data="{ tab: 'login' }">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk / Daftar</title>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full flex items-center justify-center">

<div class="w-full max-w-md bg-white dark:bg-gray-800 p-6 rounded-xl shadow-md space-y-6">

    <div class="flex justify-center space-x-4 mb-4">
        <button @click="tab = 'login'" :class="tab === 'login' ? 'bg-blue-600 text-white' : 'bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300'" class="px-4 py-2 rounded">
            Login
        </button>
        <button @click="tab = 'register'" :class="tab === 'register' ? 'bg-blue-600 text-white' : 'bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300'" class="px-4 py-2 rounded">
            Register
        </button>
    </div>

    {{-- Login Form --}}
    <form method="POST" action="{{ route('login') }}" x-show="tab === 'login'" class="space-y-4" x-transition>
        @csrf
        <h2 class="text-lg font-bold text-gray-800 dark:text-white">Login</h2>

        <div>
            <label for="email" class="block text-sm mb-1">Email</label>
            <input type="email" name="email" id="email" required autofocus class="w-full px-4 py-2 rounded border border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-700 dark:text-white">
        </div>

        <div>
            <label for="password" class="block text-sm mb-1">Password</label>
            <input type="password" name="password" id="password" required class="w-full px-4 py-2 rounded border border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-700 dark:text-white">
        </div>

        <div class="flex justify-between items-center">
            <label class="inline-flex items-center">
                <input type="checkbox" name="remember" class="form-checkbox text-blue-600">
                <span class="ml-2 text-sm">Ingat saya</span>
            </label>
            <a href="{{ route('password.request') }}" class="text-sm text-blue-600 hover:underline">Lupa password?</a>
        </div>

        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2 rounded">Masuk</button>
    </form>

    {{-- Register Form --}}
    <form method="POST" action="{{ route('register') }}" x-show="tab === 'register'" class="space-y-4" x-transition>
        @csrf
        <h2 class="text-lg font-bold text-gray-800 dark:text-white">Daftar</h2>

        <div>
            <label for="name" class="block text-sm mb-1">Nama</label>
            <input type="text" name="name" id="name" required class="w-full px-4 py-2 rounded border border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-700 dark:text-white">
        </div>

        <div>
            <label for="email" class="block text-sm mb-1">Email</label>
            <input type="email" name="email" id="email" required class="w-full px-4 py-2 rounded border border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-700 dark:text-white">
        </div>

        <div>
            <label for="password" class="block text-sm mb-1">Password</label>
            <input type="password" name="password" id="password" required class="w-full px-4 py-2 rounded border border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-700 dark:text-white">
        </div>

        <div>
            <label for="password_confirmation" class="block text-sm mb-1">Konfirmasi Password</label>
            <input type="password" name="password_confirmation" id="password_confirmation" required class="w-full px-4 py-2 rounded border border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-700 dark:text-white">
        </div>

        <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white py-2 rounded">Daftar</button>
    </form>

</div>

</body>
</html>
