<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - E-Voting</title>
    <meta name="description" content="Admin Dashboard for E-Voting System">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        'sans': ['Inter', 'system-ui', 'sans-serif'],
                    },
                    animation: {
                        'fade-in': 'fadeIn 0.5s ease-in-out',
                        'slide-up': 'slideUp 0.3s ease-out',
                        'scale-in': 'scaleIn 0.2s ease-out',
                    }
                }
            }
        }
    </script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        @keyframes slideUp {
            from {
                transform: translateY(20px);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        @keyframes scaleIn {
            from {
                transform: scale(0.95);
                opacity: 0;
            }

            to {
                transform: scale(1);
                opacity: 1;
            }
        }

        .glass {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .card-hover {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .card-hover:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
    </style>
</head>

<body class="bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-100 min-h-screen font-sans">
    <div x-data="adminDashboard()" class="min-h-screen">
        <!-- Modern Navigation -->
        <nav class="glass sticky top-0 z-50 border-b border-white/20">
    <div class="max-w-7xl mx-auto px-6 py-4">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <div class="w-10 h-10 bg-gradient-to-r from-blue-600 to-indigo-600 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div>
                    <h1 class="text-xl font-bold text-gray-900">E-Voting</h1>
                    <p class="text-sm text-gray-600">Admin Dashboard</p>
                </div>
            </div>
            <div class="flex items-center space-x-2">
                <a href="{{ route('admin.paslon.index') }}"
                    class="px-4 py-2 rounded-xl font-medium transition-all duration-200
                    {{ request()->routeIs('admin.paslon.index') ? 'bg-white text-blue-600 shadow-lg' : 'text-gray-600 hover:text-gray-900' }}">
                    Paslon
                </a>

                <a href="{{ route('admin.token') }}"
                    class="px-4 py-2 rounded-xl font-medium transition-all duration-200
                    {{ request()->routeIs('admin.token') ? 'bg-white text-blue-600 shadow-lg' : 'text-gray-600 hover:text-gray-900' }}">
                    Token
                </a>
                <a href="{{ route('admin.hasil') }}"
                    class="px-4 py-2 rounded-xl font-medium transition-all duration-200
                    {{ request()->routeIs('admin.hasil') ? 'bg-white text-blue-600 shadow-lg' : 'text-gray-600 hover:text-gray-900' }}">
                    Hasil
                </a>

                 <form action="{{ route('logout') }}" method="POST">
    @csrf
    <button type="submit" class="px-4 py-2 text-gray-600 hover:text-gray-900 transition-all duration-200">
        <i class="ri-logout-circle-r-line cursor-pointer"></i>
    </button>
</form>

            </div>
        </div>
    </div>
</nav>

        <div class="max-w-7xl mx-auto px-6 py-8">
            @yield('content')
        </div>
    </div>
</body>

</html>
