@extends('layouts.base')

@section('title', 'Akses Ditolak - Sekolah Inspirasi')

@section('content')
<!-- Header Navbar -->
<header class="bg-[#F8F6F0] border-b border-[#ECE6DB] sticky top-0 z-30">
    <div class="max-w-7xl mx-auto px-6 lg:px-12 h-20 flex items-center justify-between">
        <!-- Logo -->
        <a href="{{ route('home') }}" class="flex items-center gap-3">
            <div class="w-8 h-8 rounded-full bg-[#B84A29]"></div>
            <div class="leading-tight">
                <span class="font-bold text-base block text-[#1D1D1D]">Sekolah</span>
                <span class="font-medium text-sm text-[#4D4D4D]">Inspirasi</span>
            </div>
        </a>

        <!-- Middle Navigation Links -->
        <nav class="hidden md:flex items-center gap-8 text-sm font-medium">
            <a href="{{ route('home') }}" class="text-[#4D4D4D] hover:text-[#B84A29] transition-colors">
                Beranda sekolah
            </a>
            <a href="{{ route('user.information.index') }}" class="text-[#B84A29] font-semibold border-b-2 border-[#B84A29] pb-0.5">
                Informasi sekolah
            </a>
        </nav>

        <!-- Right User Profile -->
        <div class="flex items-center gap-4">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-full bg-[#E5D7CA] text-[#4A3222] font-bold text-xs flex items-center justify-center">
                    {{ strtoupper(substr(Auth::user()->name ?? 'AP', 0, 2)) }}
                </div>
                <div class="hidden sm:block text-left text-xs">
                    <div class="font-bold text-[#1F1F1F]">{{ Auth::user()->name ?? 'Ayu Putri' }}</div>
                    <div class="text-[#777]">Akun pengguna</div>
                </div>
            </div>

            <form action="{{ route('logout') }}" method="POST" class="inline">
                @csrf
                <button type="submit" class="px-3.5 py-1.5 text-xs text-[#777] hover:text-[#B84A29] border border-[#DDD7CD] hover:border-[#B84A29] rounded-lg transition">
                    Keluar
                </button>
            </form>
        </div>
    </div>
</header>

<main class="flex-1 flex flex-col items-center justify-center px-6 py-16 text-center">
    <!-- Big Circle Illustration -->
    <div class="w-28 h-28 rounded-full bg-[#F5E6DD] flex items-center justify-center mb-6 relative">
        <div class="w-14 h-14 rounded-full bg-[#EAD4C7] flex items-center justify-center text-xl text-[#B84A29] font-bold">
            /
        </div>
    </div>

    <p class="text-xs uppercase font-bold tracking-widest text-[#B84A29] mb-2">Akses Terbatas</p>
    <h1 class="text-4xl md:text-5xl font-bold text-[#141414] tracking-tight mb-4">
        Halaman ini khusus untuk admin.
    </h1>
    <p class="text-sm text-[#666] max-w-lg mb-8 leading-relaxed">
        Anda masuk sebagai pengguna. Akun Anda dapat membaca informasi sekolah, tetapi tidak memiliki akses ke halaman pengelolaan admin.
    </p>

    <div class="mb-12">
        <a href="{{ route('user.information.index') }}" class="inline-block px-6 py-3.5 bg-[#B84A29] hover:bg-[#A03D20] text-white text-xs font-semibold rounded-xl transition shadow-xs">
            Kembali ke informasi sekolah
        </a>
    </div>

    <!-- Help Card -->
    <div class="bg-white rounded-3xl p-6 border border-[#EBE4D8] max-w-lg w-full text-center shadow-xs">
        <h3 class="text-xs font-bold text-[#141414] mb-1">Merasa seharusnya memiliki akses?</h3>
        <p class="text-xs text-[#666]">
            Hubungi tata usaha di <a href="mailto:halo@sekolahinspirasi.sch.id" class="text-[#333] underline">halo@sekolahinspirasi.sch.id</a> untuk memeriksa izin akun Anda.
        </p>
    </div>
</main>

<footer class="bg-[#F8F6F0] border-t border-[#ECE6DB] py-6 text-xs text-[#777]">
    <div class="max-w-7xl mx-auto px-6 lg:px-12 flex flex-col md:flex-row justify-between items-center gap-3">
        <div>© 2026 Sekolah Inspirasi. Tumbuh bersama, menginspirasi dunia.</div>
        <div>Butuh bantuan? halo@sekolahinspirasi.sch.id</div>
    </div>
</footer>
@endsection
