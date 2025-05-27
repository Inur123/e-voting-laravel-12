@extends('admin.layouts.app')

@section('content')
    <div class="mb-8">
        <div class="mb-6">
            <h2 class="text-3xl font-bold text-gray-900">Hasil Voting</h2>
            <p class="text-gray-600 mt-1">Pantau hasil voting secara real-time</p>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
            <template x-for="hasil in hasilVoting">
                <div class="bg-white/70 backdrop-blur-sm rounded-3xl p-6 card-hover border border-white/20">
                    <div class="text-center">
                        <h3 class="font-bold text-lg text-gray-900 mb-2" x-text="hasil.nama_paslon"></h3>
                        <div class="text-4xl font-bold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent mb-2"
                            x-text="hasil.jumlah_suara"></div>
                        <div class="text-gray-600 text-sm mb-4">suara</div>
                        <div class="w-full bg-gray-200 rounded-full h-3 mb-2">
                            <div class="bg-gradient-to-r from-blue-500 to-indigo-500 h-3 rounded-full transition-all duration-500"
                                :style="`width: ${hasil.persentase}%`"></div>
                        </div>
                        <div class="text-lg font-semibold text-gray-900" x-text="`${hasil.persentase}%`"></div>
                    </div>
                </div>
            </template>
        </div>

        <div class="bg-white/70 backdrop-blur-sm rounded-3xl p-6 border border-white/20">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 text-center">
                <div>
                    <div class="text-3xl font-bold text-gray-900">10</div>
                    <div class="text-gray-600">Total Pemilih</div>
                </div>
                <div>
                    <div class="text-3xl font-bold text-emerald-600">9</div>
                    <div class="text-gray-600">Sudah Voting</div>
                </div>
                <div>
                    <div class="text-3xl font-bold text-amber-600" >10</div>
                    <div class="text-gray-600">Belum Voting</div>
                </div>
            </div>
        </div>
    </div>
@endsection
