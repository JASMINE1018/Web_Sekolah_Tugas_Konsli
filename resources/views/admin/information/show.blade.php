@extends('layouts.admin')

@section('title', $information->title . ' - Detail Informasi - Portal Admin')

@section('breadcrumb')
    <span>Portal admin</span>
    <span>/</span>
    <a href="{{ route('admin.information.index') }}" class="hover:underline">Informasi</a>
    <span>/</span>
    <span class="text-[#1D1D1D] font-medium">Detail</span>
@endsection

@section('admin_content')
<div class="max-w-6xl">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-6">
        <div>
            <h1 class="text-3xl font-bold text-[#141414] mb-1">Detail informasi</h1>
            <a href="{{ route('admin.information.index') }}" class="text-xs font-semibold text-[#B84A29] hover:underline flex items-center gap-1.5 mt-2">
                ← Kembali ke daftar informasi
            </a>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.information.edit', $information) }}" class="px-5 py-2.5 bg-[#B84A29] hover:bg-[#A03D20] text-white text-xs font-semibold rounded-xl transition shadow-xs">
                Edit informasi
            </a>
            <button 
                type="button" 
                onclick="document.getElementById('deleteFormShow').submit()" 
                class="px-5 py-2.5 border border-[#DDD7CD] hover:bg-[#F8F6F0] text-xs font-semibold text-[#444] rounded-xl transition"
            >
                Hapus
            </button>
            <form id="deleteFormShow" action="{{ route('admin.information.destroy', $information) }}" method="POST" class="hidden" onsubmit="return confirm('Apakah Anda yakin ingin menghapus informasi ini?');">
                @csrf
                @method('DELETE')
            </form>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 mb-8">
        <!-- Main Article Content (8 cols) -->
        <div class="lg:col-span-8 bg-white rounded-3xl p-8 border border-[#EBE4D8] shadow-xs space-y-6">
            @if($information->cover_image)
                <div class="h-64 sm:h-80 rounded-2xl overflow-hidden bg-[#F4EFE6]">
                    <img src="{{ asset('storage/' . $information->cover_image) }}" alt="{{ $information->title }}" class="w-full h-full object-cover">
                </div>
            @endif

            <div class="text-xs font-bold text-[#B84A29] tracking-wider uppercase">
                {{ $information->category }} · {{ $information->created_at->translatedFormat('d F Y') }}
            </div>

            <h2 class="text-3xl font-bold text-[#141414] leading-tight">
                {{ $information->title }}
            </h2>

            @if($information->summary)
                <p class="text-sm font-medium text-[#4D4D4D] leading-relaxed border-l-2 border-[#B84A29] pl-4 py-1">
                    {{ $information->summary }}
                </p>
            @endif

            <div class="pt-4 border-t border-[#F0EBE1] text-xs text-[#2D2D2D] leading-relaxed space-y-4">
                {!! nl2br(e($information->content)) !!}
            </div>
        </div>

        <!-- Right Side Stats Panel (4 cols) -->
        <div class="lg:col-span-4 space-y-6">
            <!-- Detail Publikasi Card -->
            <div class="bg-white rounded-3xl p-6 border border-[#EBE4D8] shadow-xs space-y-4 text-xs">
                <h3 class="text-base font-bold text-[#141414] pb-2 border-b border-[#EBE4D8]">Detail publikasi</h3>

                <div>
                    @if($information->status === 'Terbit')
                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-[#E3EFE4] text-[#2F6139]">
                            <span class="w-1.5 h-1.5 rounded-full bg-[#2F6139]"></span> Terbit
                        </span>
                    @else
                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-[#F6E7DE] text-[#B84A29]">
                            <span class="w-1.5 h-1.5 rounded-full bg-[#B84A29]"></span> Draf
                        </span>
                    @endif
                </div>

                <div class="pt-2">
                    <span class="text-[#888] block text-[10px] uppercase font-semibold">Kategori</span>
                    <span class="font-medium text-[#222]">{{ $information->category }}</span>
                </div>

                <div>
                    <span class="text-[#888] block text-[10px] uppercase font-semibold">Penulis</span>
                    <span class="font-medium text-[#222]">{{ $information->author->name ?? 'Dina Pramesti' }}</span>
                </div>

                <div>
                    <span class="text-[#888] block text-[10px] uppercase font-semibold">Diterbitkan</span>
                    <span class="font-medium text-[#222]">{{ $information->created_at->translatedFormat('d F Y') }}<br>{{ $information->created_at->translatedFormat('H.i') }} WIB</span>
                </div>

                <div>
                    <span class="text-[#888] block text-[10px] uppercase font-semibold">Diperbarui</span>
                    <span class="font-medium text-[#222]">{{ $information->updated_at->translatedFormat('d F Y') }}<br>{{ $information->updated_at->translatedFormat('H.i') }} WIB</span>
                </div>

                <div>
                    <span class="text-[#888] block text-[10px] uppercase font-semibold">Visibilitas</span>
                    <span class="font-medium text-[#222]">Semua pengguna</span>
                </div>
            </div>

            <!-- Light Green Status Notice -->
            <div class="bg-[#E7ECE7] rounded-3xl p-6 text-xs text-[#2D4537] leading-relaxed">
                Informasi ini sudah tampil di halaman informasi sekolah dan dapat dibaca oleh pengguna.
            </div>
        </div>
    </div>
</div>
@endsection
