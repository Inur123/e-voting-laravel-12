<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'E-Voting System')</title>
   @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        .glass {
            background: rgba(255, 255, 255, 0.25);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }
        .floating {
            animation: float 6s ease-in-out infinite;
        }
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }
        .pulse-ring {
            animation: pulse-ring 2s cubic-bezier(0.455, 0.03, 0.515, 0.955) infinite;
        }
        @keyframes pulse-ring {
            0% { transform: scale(0.8); opacity: 1; }
            80%, 100% { transform: scale(1.2); opacity: 0; }
        }
    </style>
</head>
<body class="min-h-screen @yield('body-class', 'bg-gradient-to-br from-indigo-900 via-purple-900 to-pink-800') relative overflow-hidden">
    <!-- Animated Background Elements -->
    <div class="absolute inset-0">
        <div class="absolute top-20 left-20 w-72 h-72 bg-blue-500 rounded-full mix-blend-multiply filter blur-xl opacity-20 floating"></div>
        <div class="absolute top-40 right-20 w-72 h-72 bg-purple-500 rounded-full mix-blend-multiply filter blur-xl opacity-20 floating" style="animation-delay: 2s;"></div>
        <div class="absolute -bottom-8 left-40 w-72 h-72 bg-pink-500 rounded-full mix-blend-multiply filter blur-xl opacity-20 floating" style="animation-delay: 4s;"></div>
    </div>

    <!-- Main Content -->
    <div class="relative min-h-screen flex items-center justify-center p-4">
        @yield('content')
    </div>

    @stack('scripts')
</body>
</html>
