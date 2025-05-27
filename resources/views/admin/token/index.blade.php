@extends('admin.layouts.app')

@section('content')
<div class="mb-8">
    <div class="flex items-center justify-between mb-6">
        <div>
            <h2 class="text-3xl font-bold text-gray-900">Data Pemilih</h2>
            <p class="text-gray-600 mt-1">Kelola pemilih dan generate PIN</p>
        </div>
    </div>

    <!-- Generate Token Form -->
    <form action="{{ route('admin.token.store') }}" method="POST" class="bg-white/70 backdrop-blur-sm rounded-3xl border border-white/20 p-6 mb-6">
        @csrf
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Generate Token Baru</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label for="jumlah" class="block text-sm font-medium text-gray-700 mb-1">Jumlah Token</label>
                <input type="number" id="jumlah" name="jumlah" min="1" max="500" value="1"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
            </div>

            <div class="flex items-end">
                <button type="submit"
                    class="w-full bg-gradient-to-r from-blue-600 to-indigo-600 text-white px-6 py-2 rounded-lg font-medium hover:from-blue-700 hover:to-indigo-700 transition-all duration-200">
                    Generate Sekarang
                </button>
            </div>
        </div>
    </form>

    <!-- Token List Table -->
    <div class="bg-white/70 backdrop-blur-sm rounded-3xl border border-white/20 overflow-hidden">
        <div class="overflow-x-auto">
        <table class="w-full">
    <thead class="bg-gray-50/50">
        <tr>
            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900">Token</th>
            <th class="px-6 py-4 text-center text-sm font-semibold text-gray-900">Status Token</th>
            <th class="px-6 py-4 text-center text-sm font-semibold text-gray-900">Aksi</th> <!-- Kolom Aksi -->
        </tr>
    </thead>
    <tbody class="divide-y divide-gray-100">
        @foreach ($tokens as $token)
            <tr class="hover:bg-gray-50/50 transition-colors">
                <td class="px-6 py-4 text-sm text-gray-900">{{ $token->token }}</td>
                <td class="px-6 py-4 text-center">
                    <span
                        class="px-3 py-1 rounded-full text-xs font-medium {{ $token->used ? 'bg-amber-100 text-amber-700' : 'bg-emerald-100 text-emerald-700' }}">
                        {{ $token->used ? 'Sudah Digunakan' : 'Belum Digunakan' }}
                    </span>
                </td>
             <td class="px-6 py-4 text-center">
    @if ($token->used)
        <button disabled
            class="text-gray-400 cursor-not-allowed font-semibold text-sm" title="Token sudah digunakan, tidak bisa dihapus">
            Hapus
        </button>
    @else
        <form action="{{ route('admin.token.destroy', $token->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus token ini?')">
            @csrf
            @method('DELETE')
            <button type="submit"
                class="text-red-600 hover:text-red-800 font-semibold text-sm">
                Hapus
            </button>
        </form>
    @endif
</td>

            </tr>
        @endforeach
    </tbody>
</table>

        </div>

        <!-- Pagination -->
        <div class="p-4">
            {{ $tokens->links() }}
        </div>
    </div>
</div>
@endsection
