@extends('layouts.base')

@section('content')
<div class="min-h-screen flex">
    <!-- Sidebar -->
    <aside class="w-64 bg-[#F8F6F0] border-r border-[#ECE6DB] flex flex-col justify-between shrink-0 p-6">
        <div>
            <!-- Logo -->
            <a href="{{ route('home') }}" class="flex items-center gap-3 mb-8">
                <div class="w-8 h-8 rounded-full bg-[#B84A29]"></div>
                <div class="leading-tight">
                    <span class="font-bold text-base block text-[#1D1D1D]">Sekolah</span>
                    <span class="font-medium text-sm text-[#4D4D4D]">Inspirasi</span>
                </div>
            </a>

            <!-- Subtitle -->
            <div class="mb-6">
                <span class="text-[10px] uppercase font-bold tracking-wider text-[#B84A29] block">Portal Admin</span>
                <p class="text-xs text-[#777] mt-0.5">Kelola kabar sekolah dengan lebih terarah.</p>
            </div>

            <!-- Navigation Links -->
            <nav class="space-y-1.5 text-sm font-medium">
                <a href="{{ route('admin.dashboard') }}" 
                   class="flex items-center px-4 py-2.5 rounded-xl transition {{ request()->routeIs('admin.dashboard') ? 'bg-[#F2E0D8] text-[#B84A29] font-semibold' : 'text-[#444] hover:bg-[#EFE9DE]' }}">
                    Ringkasan
                </a>

                <a href="{{ route('admin.information.index') }}" 
                   class="flex items-center px-4 py-2.5 rounded-xl transition {{ request()->routeIs('admin.information.*') ? 'bg-[#F2E0D8] text-[#B84A29] font-semibold' : 'text-[#444] hover:bg-[#EFE9DE]' }}">
                    Kelola informasi
                </a>
            </nav>
        </div>

        <div>
            <!-- Back to site -->
            <a href="{{ route('home') }}" class="text-xs text-[#666] hover:text-[#B84A29] flex items-center gap-1.5 mb-6">
                <span>←</span> Lihat situs sekolah
            </a>

            <!-- User profile & Logout -->
            <div class="pt-6 border-t border-[#ECE6DB] flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-full bg-[#D6CDC2] flex items-center justify-center font-bold text-xs text-[#444]">
                        {{ strtoupper(substr(Auth::user()->name ?? 'DP', 0, 2)) }}
                    </div>
                    <div class="text-xs">
                        <div class="font-bold text-[#1D1D1D]">{{ Auth::user()->name ?? 'Dina Pramesti' }}</div>
                        <div class="text-[#777]">Administrator</div>
                    </div>
                </div>
            </div>

            <form action="{{ route('logout') }}" method="POST" class="mt-4">
                @csrf
                <button type="submit" class="text-xs text-[#888] hover:text-[#B84A29] transition">
                    Keluar
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content Area -->
    <div class="flex-1 flex flex-col min-w-0 bg-[#F5F2EA]">
        <!-- Top bar with breadcrumb and year -->
        <header class="h-16 border-b border-[#ECE6DB] px-8 flex items-center justify-between text-xs text-[#777]">
            <div class="flex items-center gap-2">
                @yield('breadcrumb')
            </div>
            <div>
                Tahun ajaran 2026/2027
            </div>
        </header>

        <!-- Main Body -->
        <main class="flex-1 p-8 overflow-y-auto">
            @if(session('success'))
                <div class="mb-6 p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-sm flex items-center justify-between">
                    <span>{{ session('success') }}</span>
                    <button type="button" onclick="this.parentElement.remove()" class="text-emerald-600 hover:text-emerald-900">&times;</button>
                </div>
            @endif

            @yield('admin_content')
        </main>
    </div>
</div>
@endsection
