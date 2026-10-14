@extends('layouts.user')

@section('title', 'Informasi Sekolah - Sekolah Inspirasi')

@section('user_content')
<!-- Header Banner Section -->
<div class="flex flex-col md:flex-row justify-between items-start md:items-end gap-6 mb-10">
    <div>
        <p class="text-xs uppercase font-bold tracking-wider text-[#B84A29] mb-2">Portal Informasi Sekolah</p>
        <h1 class="text-4xl md:text-5xl font-bold text-[#141414] tracking-tight mb-2">
            Tetap dekat dengan cerita sekolah.
        </h1>
        <p class="text-sm text-[#666]">
            Selamat datang, {{ explode(' ', Auth::user()->name)[0] }}. Temukan kegiatan, pengumuman, dan inspirasi terbaru untuk keluarga Anda.
        </p>
    </div>

    <!-- Green Info Notice Box -->
    <div class="bg-[#E7ECE7] rounded-2xl p-4 max-w-xs text-xs text-[#2D4537] leading-relaxed shrink-0">
        Ruang baca keluarga sekolah. Semua informasi terbit tersedia untuk Anda.
    </div>
</div>

<!-- Category Filter Pills & Search Bar -->
<div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-8">
    <div class="flex flex-wrap items-center gap-2 text-xs">
        <a href="{{ route('user.information.index') }}" 
           class="px-4 py-2 rounded-full font-semibold transition {{ !$category ? 'bg-[#B84A29] text-white shadow-xs' : 'bg-white border border-[#DDD7CD] text-[#555] hover:border-[#B84A29]' }}">
            Semua ({{ $counts['all'] }})
        </a>
        <a href="{{ route('user.information.index', ['category' => 'Kegiatan']) }}" 
           class="px-4 py-2 rounded-full font-semibold transition {{ $category === 'Kegiatan' ? 'bg-[#B84A29] text-white shadow-xs' : 'bg-white border border-[#DDD7CD] text-[#555] hover:border-[#B84A29]' }}">
            Kegiatan ({{ $counts['Kegiatan'] }})
        </a>
        <a href="{{ route('user.information.index', ['category' => 'Pengumuman']) }}" 
           class="px-4 py-2 rounded-full font-semibold transition {{ $category === 'Pengumuman' ? 'bg-[#B84A29] text-white shadow-xs' : 'bg-white border border-[#DDD7CD] text-[#555] hover:border-[#B84A29]' }}">
            Pengumuman ({{ $counts['Pengumuman'] }})
        </a>
        <a href="{{ route('user.information.index', ['category' => 'Artikel']) }}" 
           class="px-4 py-2 rounded-full font-semibold transition {{ $category === 'Artikel' ? 'bg-[#B84A29] text-white shadow-xs' : 'bg-white border border-[#DDD7CD] text-[#555] hover:border-[#B84A29]' }}">
            Artikel ({{ $counts['Artikel'] }})
        </a>
    </div>

    <form action="{{ route('user.information.index') }}" method="GET" class="w-full md:w-72">
        @if($category)
            <input type="hidden" name="category" value="{{ $category }}">
        @endif
        <div class="relative">
            <input 
                type="text" 
                name="search" 
                value="{{ $search }}" 
                placeholder="Cari informasi sekolah..." 
                class="w-full px-4 py-2.5 bg-white border border-[#DDD7CD] rounded-full text-xs focus:outline-none focus:ring-2 focus:ring-[#B84A29]"
            >
        </div>
    </form>
</div>

<!-- Featured Story Card (Cerita Pilihan) -->
@if($featured)
    <div class="bg-white rounded-3xl p-8 border border-[#EBE4D8] shadow-xs grid grid-cols-1 lg:grid-cols-12 gap-8 items-center mb-16">
        <div class="lg:col-span-7 bg-[#F4EFE6] rounded-2xl h-64 sm:h-80 overflow-hidden flex items-center justify-center">
            @if($featured->cover_image)
                <img src="{{ asset('storage/' . $featured->cover_image) }}" alt="{{ $featured->title }}" class="w-full h-full object-cover">
            @else
                <span class="text-xs text-[#999] uppercase font-bold tracking-widest">{{ $featured->category }}</span>
            @endif
        </div>
        <div class="lg:col-span-5 flex flex-col justify-between h-full py-2">
            <div>
                <p class="text-xs uppercase font-bold tracking-wider text-[#B84A29] mb-2">
                    Cerita Pilihan · {{ $featured->category }}
                </p>
                <h2 class="text-3xl font-bold text-[#141414] leading-tight mb-4">
                    {{ $featured->title }}
                </h2>
                <p class="text-xs text-[#666] leading-relaxed mb-6">
                    {{ $featured->summary ?? Str::limit(strip_tags($featured->content), 150) }}
                </p>
            </div>
            <div>
                <div class="text-[11px] text-[#888] mb-4">
                    {{ $featured->created_at->translatedFormat('d F Y') }} · 4 menit baca
                </div>
                <a href="{{ route('user.information.show', $featured) }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-[#B84A29] hover:underline">
                    Baca selengkapnya ↗
                </a>
            </div>
        </div>
    </div>
@endif

<!-- Other Information Grid -->
<div class="mb-16">
    <div class="flex justify-between items-center mb-8">
        <h3 class="text-2xl font-bold text-[#141414]">Informasi lainnya</h3>
        <span class="text-xs text-[#888]">{{ $counts['all'] }} informasi terbit · Terbaru lebih dahulu</span>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        @forelse($otherList as $item)
            <div class="bg-white rounded-3xl p-6 border border-[#EBE4D8] shadow-xs flex flex-col justify-between">
                <div>
                    <div class="h-48 bg-[#F4EFE6] rounded-2xl mb-6 overflow-hidden flex items-center justify-center">
                        @if($item->cover_image)
                            <img src="{{ asset('storage/' . $item->cover_image) }}" alt="{{ $item->title }}" class="w-full h-full object-cover">
                        @else
                            <span class="text-xs text-[#999] uppercase font-bold">{{ $item->category }}</span>
                        @endif
                    </div>
                    <div class="text-[10px] uppercase font-bold tracking-wider text-[#888] mb-2">
                        <span class="text-[#B84A29]">{{ $item->category }}</span> · {{ $item->created_at->translatedFormat('d M Y') }}
                    </div>
                    <h4 class="text-xl font-bold text-[#141414] leading-snug mb-3">
                        {{ $item->title }}
                    </h4>
                    <p class="text-xs text-[#666] leading-relaxed mb-6">
                        {{ $item->summary ?? Str::limit(strip_tags($item->content), 120) }}
                    </p>
                </div>
                <div>
                    <a href="{{ route('user.information.show', $item) }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-[#B84A29] hover:underline">
                        Baca selengkapnya ↗
                    </a>
                </div>
            </div>
        @empty
            <div class="col-span-2 py-12 text-center text-[#888] text-sm">
                Tidak ada informasi lain yang ditemukan.
            </div>
        @endforelse
    </div>
</div>

<div class="text-center text-xs text-[#888] pt-6 border-t border-[#ECE6DB]">
    Anda sudah melihat semua informasi terbaru.
</div>
@endsection
