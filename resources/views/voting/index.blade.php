<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Voting - E-Voting</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
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
            transform: translateY(-8px);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        }
        .selected-card {
            transform: translateY(-8px);
            box-shadow: 0 25px 50px -12px rgba(59, 130, 246, 0.5);
        }
        .checkmark {
            animation: checkmark 0.3s ease-in-out;
        }
        @keyframes checkmark {
            0% { transform: scale(0); }
            50% { transform: scale(1.2); }
            100% { transform: scale(1); }
        }
    </style>
</head>
<body class="bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-100 min-h-screen">
    <div x-data="votingPage()" class="min-h-screen">
        <!-- Modern Header -->
        <header class="glass sticky top-0 z-50 border-b border-white/20">
            <div class="max-w-7xl mx-auto px-6 py-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <div class="w-12 h-12 bg-gradient-to-r from-blue-600 to-indigo-600 rounded-2xl flex items-center justify-center">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <h1 class="text-xl font-bold text-gray-900">E-Voting System</h1>
                            <p class="text-sm text-gray-600">Pemilihan Ketua & Wakil Ketua BEM</p>
                        </div>
                    </div>

                    <div class="text-right">
                        <div class="text-sm text-gray-600">Pemilih</div>
                        <div class="font-semibold text-gray-900">{{ Auth::user()->name ?? 'Pemilih' }}</div>
                        <div class="text-xs text-gray-500">{{ Auth::user()->nim ?? 'NIM' }}</div>
                    </div>
                </div>
            </div>
        </header>

        <div class="max-w-7xl mx-auto px-6 py-8">
            <!-- Modern Alert -->
            <div class="bg-gradient-to-r from-amber-50 to-orange-50 border-l-4 border-amber-400 rounded-2xl p-6 mb-8 shadow-sm">
                <div class="flex items-start">
                    <div class="flex-shrink-0">
                        <svg class="h-6 w-6 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-9 2a9 9 0 1118 0 9 9 0 01-18 0z"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-semibold text-amber-800">Perhatian Penting</h3>
                        <p class="text-amber-700 mt-1">
                            Pilih salah satu pasangan calon di bawah ini. Setelah memilih dan mengkonfirmasi, Anda tidak dapat mengubah pilihan.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Voting Interface -->
            <div x-show="!showConfirmation && !votingComplete" x-transition class="space-y-8">
                <div class="text-center">
                    <h2 class="text-4xl font-bold text-gray-900 mb-4">Pilih Pasangan Calon</h2>
                    <p class="text-gray-600 text-lg">Klik pada kartu kandidat untuk memilih</p>
                </div>

                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($paslons as $paslon)
                    <div
                        @click="selectPaslon({{ $paslon->id }}, '{{ $paslon->nomor_urut }}', '{{ $paslon->nama }}', '{{ addslashes($paslon->visi_misi) }}', '{{ $paslon->gambar }}')"
                        :class="selectedPaslon?.id === {{ $paslon->id }} ? 'selected-card ring-4 ring-blue-500 bg-gradient-to-br from-blue-50 to-indigo-50' : 'bg-white/70 hover:bg-white/90'"
                        class="backdrop-blur-sm rounded-3xl p-8 cursor-pointer transition-all duration-300 border border-white/20 card-hover relative overflow-hidden"
                    >
                        <!-- Selection Indicator -->
                        <div x-show="selectedPaslon?.id === {{ $paslon->id }}" class="absolute top-4 right-4 checkmark">
                            <div class="w-8 h-8 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                        </div>

                        <div class="text-center">
                            <div class="relative mb-6">
                                <img src="/storage/{{ $paslon->gambar }}" alt="{{ $paslon->nama }}" class="w-32 h-32 mx-auto rounded-3xl object-cover shadow-xl">
                                <div class="absolute inset-0 w-32 h-32 mx-auto rounded-3xl bg-gradient-to-t from-black/20 to-transparent"></div>
                            </div>

                            <h3 class="text-xl font-bold text-gray-900 mb-3">No. {{ $paslon->nomor_urut }} - {{ $paslon->nama }}</h3>
                            <p class="text-gray-600 mb-6 leading-relaxed">{{ $paslon->visi_misi }}</p>

                            <!-- Visual Radio Button -->
                            <div class="flex justify-center">
                                <div :class="selectedPaslon?.id === {{ $paslon->id }} ? 'bg-gradient-to-r from-blue-500 to-indigo-600 border-blue-500 scale-110' : 'border-gray-300 hover:border-gray-400'"
                                     class="w-8 h-8 rounded-full border-2 flex items-center justify-center transition-all duration-200">
                                    <div x-show="selectedPaslon?.id === {{ $paslon->id }}" class="w-4 h-4 bg-white rounded-full"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <div class="text-center pt-8">
                    <button
                        @click="confirmVote()"
                        :disabled="!selectedPaslon"
                        :class="selectedPaslon ? 'bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-700 hover:to-teal-700 transform hover:scale-105 shadow-lg hover:shadow-xl' : 'bg-gray-300 cursor-not-allowed'"
                        class="text-white px-12 py-4 rounded-2xl font-semibold text-lg transition-all duration-200"
                    >
                        <svg class="w-6 h-6 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Konfirmasi Pilihan
                    </button>
                </div>
            </div>

            <!-- Modern Confirmation -->
            <div x-show="showConfirmation && !votingComplete" x-transition class="max-w-lg mx-auto">
                <div class="bg-white/80 backdrop-blur-sm rounded-3xl shadow-2xl p-8 border border-white/20">
                    <div class="text-center mb-8">
                        <div class="w-16 h-16 bg-gradient-to-r from-amber-500 to-orange-500 rounded-2xl flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-9 2a9 9 0 1118 0 9 9 0 01-18 0z"></path>
                            </svg>
                        </div>
                        <h2 class="text-2xl font-bold text-gray-900 mb-2">Konfirmasi Pilihan</h2>
                        <p class="text-gray-600">Pastikan pilihan Anda sudah benar</p>
                    </div>

                    <div class="text-center mb-8">
                        <div class="relative inline-block mb-4">
                            <img :src="'/storage/' + selectedPaslon?.gambar" :alt="selectedPaslon?.nama" class="w-24 h-24 mx-auto rounded-2xl object-cover shadow-lg">
                            <div class="absolute -top-2 -right-2 w-8 h-8 bg-gradient-to-r from-emerald-500 to-teal-600 rounded-full flex items-center justify-center">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2" x-text="'No. ' + selectedPaslon?.nomor_urut + ' - ' + selectedPaslon?.nama"></h3>
                        <p class="text-gray-600" x-text="selectedPaslon?.visi_misi"></p>
                    </div>

                    <div class="bg-gradient-to-r from-red-50 to-pink-50 border border-red-200 rounded-2xl p-4 mb-8">
                        <div class="flex items-start">
                            <svg class="w-5 h-5 text-red-500 mt-0.5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-9 2a9 9 0 1118 0 9 9 0 01-18 0z"></path>
                            </svg>
                            <div>
                                <p class="text-sm text-red-800 font-medium">Peringatan Penting</p>
                                <p class="text-sm text-red-700 mt-1">Setelah mengklik "Ya, Saya Yakin", pilihan Anda tidak dapat diubah lagi.</p>
                            </div>
                        </div>
                    </div>

                    <div class="flex space-x-4">
                        <button
                            @click="showConfirmation = false"
                            class="flex-1 bg-gray-100 text-gray-700 py-3 px-6 rounded-2xl font-semibold hover:bg-gray-200 transition-all duration-200"
                        >
                            Kembali
                        </button>
                        <button
                            @click="submitVote()"
                            :disabled="submitting"
                            :class="submitting ? 'bg-gray-400 cursor-not-allowed' : 'bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-700 hover:to-teal-700 transform hover:scale-105'"
                            class="flex-1 text-white py-3 px-6 rounded-2xl font-semibold transition-all duration-200"
                        >
                            <span x-show="!submitting">Ya, Saya Yakin</span>
                            <span x-show="submitting" class="flex items-center justify-center">
                                <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                Memproses...
                            </span>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Modern Success -->
            <div x-show="votingComplete" x-transition class="max-w-lg mx-auto">
                <div class="bg-white/80 backdrop-blur-sm rounded-3xl shadow-2xl p-8 text-center border border-white/20">
                    <div class="mb-8">
                        <div class="w-20 h-20 bg-gradient-to-r from-emerald-500 to-teal-600 rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg">
                            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h2 class="text-3xl font-bold text-emerald-600 mb-4">Voting Berhasil!</h2>
                        <p class="text-gray-600 text-lg">Terima kasih telah berpartisipasi dalam pemilihan</p>
                    </div>

                    <div class="bg-gradient-to-r from-gray-50 to-blue-50 rounded-2xl p-6 mb-8">
                        <p class="text-sm text-gray-600 mb-2">Pilihan Anda:</p>
                        <p class="font-bold text-lg text-gray-900" x-text="'No. ' + selectedPaslon?.nomor_urut + ' - ' + selectedPaslon?.nama"></p>
                        <p class="text-xs text-gray-500 mt-3">
                            <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span x-text="new Date().toLocaleString('id-ID')"></span>
                        </p>
                    </div>

                    <div class="text-center">
                        <div class="inline-flex items-center px-4 py-2 bg-blue-100 text-blue-800 rounded-full text-sm font-medium">
                            <svg class="animate-spin -ml-1 mr-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            Logout otomatis dalam 2 detik...
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function votingPage() {
            return {
                selectedPaslon: null,
                showConfirmation: false,
                votingComplete: false,
                submitting: false,

                selectPaslon(id, nomorUrut, nama, visiMisi, gambar) {
                    this.selectedPaslon = {
                        id: id,
                        nomor_urut: nomorUrut,
                        nama: nama,
                        visi_misi: visiMisi,
                        gambar: gambar
                    };
                },

                confirmVote() {
                    if (this.selectedPaslon) {
                        this.showConfirmation = true;
                    }
                },

                async submitVote() {
                    this.submitting = true;

                    try {
                        const response = await fetch("{{ route('voting.submit') }}", {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Accept': 'application/json'
                            },
                            body: JSON.stringify({
                                paslon_id: this.selectedPaslon.id
                            })
                        });

                        if (response.ok) {
                            this.submitting = false;
                            this.showConfirmation = false;
                            // Tampilkan pesan sukses sebentar lalu logout otomatis
                            this.votingComplete = true;

                            // Auto logout setelah 2 detik
                            setTimeout(() => {
                                window.location.href = "{{ route('token.login') }}";
                            }, 2000);
                        } else {
                            const errorData = await response.json();
                            alert(errorData.message || 'Terjadi kesalahan saat memproses voting');
                            this.submitting = false;
                        }
                    } catch (error) {
                        console.error('Error:', error);
                        alert('Terjadi kesalahan jaringan');
                        this.submitting = false;
                    }
                },

                logout() {
                    if (confirm('Yakin ingin keluar?')) {
                        window.location.href = "{{ route('token.login') }}";
                    }
                }
            }
        }
    </script>
</body>
</html>
