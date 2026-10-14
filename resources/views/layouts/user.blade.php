@extends('layouts.base')

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

        <!-- Right User Profile & Dropdown -->
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

<main class="flex-1 max-w-7xl mx-auto px-6 lg:px-12 py-10 w-full">
    @yield('user_content')
</main>

<!-- Footer -->
<footer class="bg-[#F8F6F0] border-t border-[#ECE6DB] py-6 text-xs text-[#777]">
    <div class="max-w-7xl mx-auto px-6 lg:px-12 flex flex-col md:flex-row justify-between items-center gap-3">
        <div>© 2026 Sekolah Inspirasi. Tumbuh bersama, menginspirasi dunia.</div>
        <div>Butuh bantuan? <a href="mailto:halo@sekolahinspirasi.sch.id" class="text-[#333] underline">halo@sekolahinspirasi.sch.id</a></div>
    </div>
</footer>
@endsection
