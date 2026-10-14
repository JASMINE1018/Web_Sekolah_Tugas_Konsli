@extends('layouts.user')

@section('title', $information->title . ' - Sekolah Inspirasi')

@section('user_content')
<!-- Back button -->
<div class="mb-8">
    <a href="{{ route('user.information.index') }}" class="inline-flex items-center gap-1.5 text-xs font-semibold text-[#B84A29] hover:underline">
        ← Kembali ke informasi sekolah
    </a>
</div>

<!-- Header Titles -->
<div class="max-w-4xl mb-8">
    <div class="text-xs uppercase font-bold tracking-wider text-[#B84A29] mb-3">
        {{ $information->category }} · CERITA BELAJAR
    </div>
    <h1 class="text-4xl md:text-5xl font-bold text-[#141414] leading-[1.15] mb-4">
        {{ $information->title }}
    </h1>
    @if($information->summary)
        <p class="text-base text-[#555] leading-relaxed mb-6">
            {{ $information->summary }}
        </p>
    @endif

    <div class="flex items-center gap-3 text-xs text-[#777]">
        <div class="w-8 h-8 rounded-full bg-[#E5D7CA] text-[#4A3222] font-bold text-xs flex items-center justify-center">
            {{ strtoupper(substr($information->author->name ?? 'DP', 0, 2)) }}
        </div>
        <div>
            <span class="font-bold text-[#141414]">{{ $information->author->name ?? 'Dina Pramesti' }}</span>
            <span class="mx-1">·</span>
            <span>{{ $information->created_at->translatedFormat('d F Y, H.i') }} WIB</span>
            <span class="mx-1">·</span>
            <span>4 menit baca</span>
        </div>
    </div>
</div>

<!-- Big Banner / Cover Image -->
<div class="mb-12">
    <div class="h-80 sm:h-[450px] bg-[#EBE5DA] rounded-3xl overflow-hidden flex items-center justify-center shadow-xs">
        @if($information->cover_image)
            <img src="{{ asset('storage/' . $information->cover_image) }}" alt="{{ $information->title }}" class="w-full h-full object-cover">
        @else
            <span class="text-xs text-[#888] uppercase tracking-wider">Dokumentasi Kegiatan Sekolah Inspirasi</span>
        @endif
    </div>
    <p class="text-[11px] text-[#888] mt-2.5">
        Foto: Dokumentasi Sekolah Inspirasi.
    </p>
</div>

<!-- Main Body & Sidebar Info -->
<div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-start mb-16">
    <!-- Article Text Content (8 cols) -->
    <div class="lg:col-span-8 space-y-6 text-sm leading-relaxed text-[#2D2D2D]">
        <div class="prose max-w-none text-[#2D2D2D]">
            {!! nl2br(e($information->content)) !!}
        </div>

        <div class="pt-8">
            <a href="{{ route('user.information.index') }}" class="inline-block px-5 py-2.5 bg-white border border-[#DDD7CD] hover:border-[#B84A29] text-xs font-semibold rounded-xl transition">
                Kembali ke daftar informasi
            </a>
        </div>
    </div>

    <!-- Right Summary Box (4 cols) -->
    <div class="lg:col-span-4 space-y-6">
        <div class="bg-[#E7ECE7] rounded-3xl p-6 text-[#2D4537] space-y-4">
            <h3 class="text-base font-bold text-[#1D3326]">Sekilas proyek belajar</h3>

            <div>
                <span class="text-[10px] uppercase font-bold text-[#5A7364] block">Peserta</span>
                <span class="text-xs font-semibold text-[#1F3327]">Siswa kelas 4 SD</span>
            </div>

            <div>
                <span class="text-[10px] uppercase font-bold text-[#5A7364] block">Durasi</span>
                <span class="text-xs font-semibold text-[#1F3327]">4 minggu</span>
            </div>

            <div>
                <span class="text-[10px] uppercase font-bold text-[#5A7364] block">Yang dipelajari</span>
                <span class="text-xs font-semibold text-[#1F3327]">Sains, matematika, kolaborasi, dan kepedulian</span>
            </div>
        </div>

        <p class="text-xs text-[#777] leading-relaxed">
            Ada pertanyaan tentang kegiatan sekolah? Hubungi wali kelas atau tata usaha kami.
        </p>
    </div>
</div>

<!-- Bottom Section: Cerita Lain untuk Anda -->
<div class="pt-12 border-t border-[#ECE6DB] mb-12">
    <h3 class="text-2xl font-bold text-[#141414] mb-8">Cerita lain untuk Anda</h3>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        @foreach($otherStories as $other)
            <div class="bg-white rounded-3xl p-6 border border-[#EBE4D8] shadow-xs flex flex-col justify-between">
                <div>
                    <span class="text-[10px] uppercase font-bold text-[#B84A29] block mb-2">{{ $other->category }}</span>
                    <h4 class="text-lg font-bold text-[#141414] mb-4 leading-snug">{{ $other->title }}</h4>
                </div>
                <a href="{{ route('user.information.show', $other) }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-[#B84A29] hover:underline">
                    Baca selengkapnya ↗
                </a>
            </div>
        @endforeach
    </div>
</div>
@endsection
