@extends('admin.layouts.app')

@section('content')
    <div x-data="{
        pemilihList: [
            { pin: 'A1B2C3', belum_digunakan: false },  // Sudah Digunakan
            { pin: 'D4E5F6', belum_digunakan: true }    // Belum Digunakan
        ],
        newPin: '',
        jumlahPin: 1,
        generatePin() {
            // Simple PIN generation logic - in a real app, you'd want something more secure
            for (let i = 0; i < this.jumlahPin; i++) {
                const randomPin = Math.random().toString(36).substring(2, 8).toUpperCase();
                this.pemilihList.unshift({
                    pin: randomPin,
                    belum_digunakan: true
                });
                this.newPin = randomPin; // Store the last generated PIN
            }
        }
    }" class="mb-8">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-3xl font-bold text-gray-900">Data Pemilih</h2>
                <p class="text-gray-600 mt-1">Kelola pemilih dan generate PIN</p>
            </div>
        </div>

        <!-- PIN Generation Form -->
        <div class="bg-white/70 backdrop-blur-sm rounded-3xl border border-white/20 p-6 mb-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Generate PIN Baru</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label for="jumlahPin" class="block text-sm font-medium text-gray-700 mb-1">Jumlah PIN</label>
                    <input type="number" id="jumlahPin" x-model="jumlahPin" min="1" max="100"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div class="flex items-end">
                    <button @click="generatePin"
                        class="w-full bg-gradient-to-r from-blue-600 to-indigo-600 text-white px-6 py-2 rounded-lg font-medium hover:from-blue-700 hover:to-indigo-700 transition-all duration-200">
                        Generate Sekarang
                    </button>
                </div>
            </div>
        </div>

        <!-- PIN List Table -->
        <div class="bg-white/70 backdrop-blur-sm rounded-3xl border border-white/20 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50/50">
                        <tr>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900">PIN</th>
                            <th class="px-6 py-4 text-center text-sm font-semibold text-gray-900">Status PIN</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        <template x-for="pemilih in pemilihList" :key="pemilih.pin">
                            <tr class="hover:bg-gray-50/50 transition-colors">
                                <td class="px-6 py-4 text-sm text-gray-900" x-text="pemilih.pin"></td>
                                <td class="px-6 py-4 text-center">
                                    <span
                                        :class="pemilih.belum_digunakan ? 'bg-amber-100 text-amber-700' : 'bg-emerald-100 text-emerald-700'"
                                        class="px-3 py-1 rounded-full text-xs font-medium"
                                        x-text="pemilih.belum_digunakan ? 'Belum Digunakan' : 'Sudah Digunakan'">
                                    </span>
                                </td>
                            </tr>
                        </template>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
