@extends('admin.layouts.app')

@section('content')
    <div x-data="{
        showAddPaslon: false,
        showEditPaslon: false,
        editData: {}
    }">
        <div class="mb-8">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h2 class="text-3xl font-bold text-gray-900">Pasangan Calon</h2>
                    <p class="text-gray-600 mt-1">Kelola kandidat yang akan dipilih</p>
                </div>
                <button @click="showAddPaslon = true"
                    class="bg-gradient-to-r from-blue-600 to-indigo-600 text-white px-6 py-3 rounded-2xl font-medium hover:from-blue-700 hover:to-indigo-700 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:scale-105">
                    <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Tambah Paslon
                </button>
            </div>

            <!-- Modal Add Paslon (sama seperti sebelumnya) -->
            <div x-show="showAddPaslon"
                class="fixed inset-0 flex items-center justify-center z-50 bg-black/30 backdrop-blur-sm" x-transition
                x-cloak>
                <div @click.away="showAddPaslon = false"
                    class="bg-white rounded-2xl p-6 w-full max-w-md shadow-lg relative">
                    <button @click="showAddPaslon = false"
                        class="absolute top-2 right-3 text-gray-500 hover:text-gray-700 text-xl">&times;</button>
                    <h3 class="text-xl font-bold mb-4">Tambah Paslon</h3>
                    <form action="{{ route('admin.paslon.store') }}" method="POST" enctype="multipart/form-data" x-data>
                        @csrf
                        <div class="mb-3">
                            <label class="block text-sm font-medium text-gray-700">Nomor Urut</label>
                            <input type="number" name="nomor_urut" min="1" class="w-full mt-1 border rounded-xl p-2" required>
                        </div>
                        <div class="mb-3">
                            <label class="block text-sm font-medium text-gray-700">Nama Paslon</label>
                            <input type="text" name="nama" class="w-full mt-1 border rounded-xl p-2" required>
                        </div>
                        <div class="mb-3">
                            <label class="block text-sm font-medium text-gray-700">Visi & Misi</label>
                            <textarea name="visi_misi" rows="4" class="w-full mt-1 border rounded-xl p-2" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="block text-sm font-medium text-gray-700">Foto</label>
                            <input type="file" name="gambar" accept="image/*" class="w-full mt-1 border rounded-xl p-2">
                        </div>
                        <div class="mt-4 flex justify-end space-x-2">
                            <button type="button" @click="showAddPaslon = false"
                                class="px-4 py-2 bg-gray-300 text-gray-800 rounded-xl hover:bg-gray-400">Batal</button>
                            <button type="submit"
                                class="px-4 py-2 bg-blue-600 text-white rounded-xl hover:bg-blue-700">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Modal Edit Paslon -->
            <div x-show="showEditPaslon"
                class="fixed inset-0 flex items-center justify-center z-50 bg-black/30 backdrop-blur-sm" x-transition
                x-cloak>
                <div @click.away="showEditPaslon = false"
                    class="bg-white rounded-2xl p-6 w-full max-w-md shadow-lg relative">
                    <button @click="showEditPaslon = false"
                        class="absolute top-2 right-3 text-gray-500 hover:text-gray-700 text-xl">&times;</button>
                    <h3 class="text-xl font-bold mb-4">Edit Paslon</h3>
                    <form :action="`{{ url('admin/paslon') }}/${editData.id}`" method="POST" enctype="multipart/form-data" x-data>
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label class="block text-sm font-medium text-gray-700">Nomor Urut</label>
                            <input type="number" name="nomor_urut" min="1" class="w-full mt-1 border rounded-xl p-2"
                                x-model="editData.nomor_urut" required>
                        </div>
                        <div class="mb-3">
                            <label class="block text-sm font-medium text-gray-700">Nama Paslon</label>
                            <input type="text" name="nama" class="w-full mt-1 border rounded-xl p-2" x-model="editData.nama" required>
                        </div>
                        <div class="mb-3">
                            <label class="block text-sm font-medium text-gray-700">Visi & Misi</label>
                            <textarea name="visi_misi" rows="4" class="w-full mt-1 border rounded-xl p-2" x-model="editData.visi_misi" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="block text-sm font-medium text-gray-700">Foto (biarkan kosong jika tidak diubah)</label>
                            <input type="file" name="gambar" accept="image/*" class="w-full mt-1 border rounded-xl p-2">
                        </div>
                        <div class="mt-4 flex justify-end space-x-2">
                            <button type="button" @click="showEditPaslon = false"
                                class="px-4 py-2 bg-gray-300 text-gray-800 rounded-xl hover:bg-gray-400">Batal</button>
                            <button type="submit"
                                class="px-4 py-2 bg-blue-600 text-white rounded-xl hover:bg-blue-700">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Grid Paslon -->
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($paslons as $paslon)
                    <div class="bg-white/70 backdrop-blur-sm rounded-3xl p-6 card-hover border border-white/20">
                        <div class="text-center">
                            <div class="relative mb-4">
                                <img src="{{ $paslon->gambar ? asset('storage/' . $paslon->gambar) : asset('images/placeholder.png') }}"
                                    alt="Foto Paslon {{ $paslon->nama }}"
                                    class="w-24 h-24 mx-auto rounded-2xl object-cover shadow-lg">
                                <div
                                    class="absolute -top-2 -right-2 w-8 h-8 bg-gradient-to-r from-green-400 to-green-600 rounded-full flex items-center justify-center">
                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </div>
                            </div>
                            <h3 class="font-bold text-lg text-gray-900">Paslon {{ $paslon->nomor_urut }}
                               </h3>
                                 <h2 class="font-bold text-lg text-gray-900 mb-2">
                                {{ $paslon->nama }}</h2>
                            <p class="text-gray-600 text-sm mb-4 line-clamp-2">Visi & Misi:
                                {{ Str::limit($paslon->visi_misi, 100) }}</p>
                            <div class="flex space-x-2 justify-center">
                                <button
                                    @click="editData = {{ json_encode($paslon) }}; showEditPaslon = true"
                                    class="bg-blue-100 text-blue-600 px-4 py-2 rounded-xl text-sm font-medium hover:bg-blue-200 transition-colors">
                                    Edit
                                </button>
                                <form action="{{ route('admin.paslon.destroy', $paslon->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus paslon ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="bg-red-100 text-red-600 px-4 py-2 rounded-xl text-sm font-medium hover:bg-red-200 transition-colors">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </div>
@endsection
