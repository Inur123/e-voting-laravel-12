<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Voting - E-Voting</title>

  @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        .glass {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        .card-hover {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .card-hover:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        .pulse-dot {
            animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }
        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: .5; }
        }
    </style>
</head>
<body class="bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-100 min-h-screen">
    <div x-data="hasilVoting()" class="min-h-screen">
        <header class="glass sticky top-0 z-50 border-b border-white/20">
            <div class="max-w-7xl mx-auto px-6 py-6">
                <div class="text-center">
                    <div class="flex items-center justify-center mb-2">
                        <div class="w-12 h-12 bg-gradient-to-r from-emerald-500 to-teal-600 rounded-2xl flex items-center justify-center mr-4">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                        </div>
                        <div>
                            <h1 class="text-3xl font-bold text-gray-900">Hasil Voting Real-time</h1>
                            <p class="text-gray-600 mt-1">Pemilihan Ketua & Wakil Ketua BEM</p>
                        </div>
                    </div>
                    <div class="flex items-center justify-center text-sm text-gray-600 mb-2">
                        <div class="w-2 h-2 bg-emerald-500 rounded-full pulse-dot mr-2"></div>
                        Live Update
                    </div>
                    <div class="text-gray-700 font-medium" x-text="currentTime"></div>
                </div>
            </div>
        </header>

        <div class="max-w-7xl mx-auto px-6 py-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mb-8">
                <div class="bg-white/70 backdrop-blur-sm rounded-3xl p-6 card-hover border border-white/20">
                    <div class="text-center">
                        <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-2xl flex items-center justify-center mx-auto mb-3">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                        </div>
                        <div class="text-3xl font-bold text-gray-900 mb-1">{{ $totalTokens }}</div>
                        <div class="text-gray-600 text-sm">Total Pemilih</div>
                    </div>
                </div>

                <div class="bg-white/70 backdrop-blur-sm rounded-3xl p-6 card-hover border border-white/20">
                    <div class="text-center">
                        <div class="w-12 h-12 bg-gradient-to-r from-emerald-500 to-teal-600 rounded-2xl flex items-center justify-center mx-auto mb-3">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div class="text-3xl font-bold text-emerald-600 mb-1">{{ $usedTokens }}</div>
                        <div class="text-gray-600 text-sm">Sudah Voting</div>
                    </div>
                </div>

                <div class="bg-white/70 backdrop-blur-sm rounded-3xl p-6 card-hover border border-white/20">
                    <div class="text-center">
                        <div class="w-12 h-12 bg-gradient-to-r from-amber-500 to-orange-500 rounded-2xl flex items-center justify-center mx-auto mb-3">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div class="text-3xl font-bold text-amber-600 mb-1">{{ $unusedTokens }}</div>
                        <div class="text-gray-600 text-sm">Belum Voting</div>
                    </div>
                </div>

                <div class="bg-white/70 backdrop-blur-sm rounded-3xl p-6 card-hover border border-white/20">
                    <div class="text-center">
                        <div class="w-12 h-12 bg-gradient-to-r from-purple-500 to-pink-500 rounded-2xl flex items-center justify-center mx-auto mb-3">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                            </svg>
                        </div>
                        <div class="text-3xl font-bold text-purple-600 mb-1">{{ $percentageUsed }}%</div>
                        <div class="text-gray-600 text-sm">Partisipasi</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
  function hasilVoting() {
    return {
        currentTime: new Date().toLocaleTimeString('id-ID', {
            year: 'numeric',
            month: 'long',
            day: 'numeric',
            hour: '2-digit',
            minute: '2-digit',
            second: '2-digit'
        }),
        totalTokens: {{ $totalTokens }},
        usedTokens: {{ $usedTokens }},
        unusedTokens: {{ $unusedTokens }},
        percentageUsed: {{ $percentageUsed }},
        init() {
            setInterval(() => {
                this.currentTime = new Date().toLocaleTimeString('id-ID', {
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric',
                    hour: '2-digit',
                    minute: '2-digit',
                    second: '2-digit'
                });

                // Contoh polling data (ubah URL sesuai endpoint API kamu)
                fetch('/api/hasil-voting')
                    .then(res => res.json())
                    .then(data => {
                        this.totalTokens = data.totalTokens;
                        this.usedTokens = data.usedTokens;
                        this.unusedTokens = data.unusedTokens;
                        this.percentageUsed = data.percentageUsed;
                    });
            }, 10000); // update setiap 10 detik
        }
    }
}

</script>

</body>
</html>
