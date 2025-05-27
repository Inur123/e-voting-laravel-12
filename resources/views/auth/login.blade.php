<!DOCTYPE html>
<html>
<head>
    <title>Login</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
        <h2 class="text-2xl font-bold text-center mb-6">Login</h2>

        @if ($errors->any())
            <p class="text-red-500 text-sm mb-4 text-center">{{ $errors->first() }}</p>
        @endif

        <form method="POST" action="/login" class="space-y-4">
            @csrf
            <div>
                <input type="email" name="email" placeholder="Email" required
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
                <input type="password" name="password" placeholder="Password" required
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <button type="submit"
                class="w-full bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600 transition duration-200">
                Login
            </button>
        </form>

        <p class="text-center mt-4 text-sm text-gray-600">
            Belum punya akun?
            <a href="/register" class="text-blue-500 hover:text-blue-600">Register</a>
        </p>
    </div>
</body>
</html>
