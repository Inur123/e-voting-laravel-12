@extends('layouts.app')

@section('title', 'Login Pemilih - E-Voting')

@section('content')
<div x-data="loginPemilih()" class="glass rounded-3xl p-8 w-full max-w-md shadow-2xl">
    <!-- Header -->
    <div class="text-center mb-8">
        <div class="relative inline-block mb-4">
            <div class="w-20 h-20 bg-gradient-to-r from-blue-500 to-purple-600 rounded-2xl flex items-center justify-center mx-auto shadow-lg">
                <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <div class="absolute inset-0 w-20 h-20 bg-gradient-to-r from-blue-500 to-purple-600 rounded-2xl pulse-ring"></div>
        </div>
        <h1 class="text-3xl font-bold text-white mb-2">E-Voting</h1>
        <p class="text-white/80">Masukkan Token untuk melakukan voting</p>
    </div>

    <!-- Token Input Form -->
    <form method="POST" action="{{ route('token.login') }}" class="space-y-6">
        @csrf
        <div>
            <label for="token" class="block text-sm font-semibold text-white/90 mb-3">Token Voting</label>
            <div class="relative">
                <input
                    x-model="token"
                    type="text"
                    id="token"
                    name="token"
                    class="w-full px-6 py-4 bg-white/10 border border-white/20 rounded-2xl focus:ring-2 focus:ring-blue-400 focus:border-transparent text-center text-lg tracking-widest text-white placeholder-white/50 backdrop-blur-sm transition-all @error('token') border-red-500 @enderror"
                    placeholder="Masukkan Token"
                    required
                    autofocus
                    value="{{ old('token') }}"
                >
                <div class="absolute inset-y-0 right-0 flex items-center pr-4">
                    <svg class="w-5 h-5 text-white/50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Error Messages -->
        @if($errors->any())
            <div class="bg-red-500/20 border border-red-500/30 text-red-200 px-4 py-3 rounded-2xl backdrop-blur-sm">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span>{{ $errors->first() }}</span>
                </div>
            </div>
        @endif

        <!-- Login Button -->
        <button
            type="submit"
            class="w-full text-white py-4 px-6 rounded-2xl font-semibold transition-all duration-200 shadow-lg bg-gradient-to-r from-blue-500 to-purple-600 hover:from-blue-600 hover:to-purple-700 transform hover:scale-105"
        >
            <span class="flex items-center justify-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013 3v1"></path>
                </svg>
                Masuk
            </span>
        </button>
    </form>

    <!-- Info Text -->
    <div class="mt-6 text-center">
        <p class="text-sm text-white/70">
            Belum punya Token? Hubungi administrator untuk mendapatkan Token voting.
        </p>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function loginPemilih() {
        return {
            token: '',
        }
    }
</script>
@endpush
