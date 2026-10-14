@extends('layouts.admin')

@section('title', 'Ringkasan - Portal Admin Sekolah Inspirasi')

@section('breadcrumb')
    <span>Portal admin</span>
    <span>/</span>
    <span class="text-[#1D1D1D] font-medium">Ringkasan</span>
@endsection

@section('admin_content')
<div class="max-w-6xl">
    <h1 class="text-3xl font-bold text-[#141414] mb-6">Ringkasan</h1>

    <!-- Welcome Card -->
    <div class="bg-[#E7ECE7] rounded-3xl p-8 mb-8 flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
        <div>
            <h2 class="text-2xl font-bold text-[#1F1F1F] mb-2">Selamat pagi, {{ explode(' ', Auth::user()->name)[0] }}.</h2>
            <p class="text-sm text-[#4A5D52] mb-3 leading-relaxed">
                Anda masuk sebagai admin. Ada {{ $draftCount }} draf yang menunggu untuk diselesaikan. Mari bagikan cerita baik dari sekolah hari ini.
            </p>
            <span class="text-xs text-[#6B7D72]">{{ now()->translatedFormat('l, d F Y') }}</span>
        </div>
        <a href="{{ route('admin.information.create') }}" class="px-6 py-3 bg-[#B84A29] hover:bg-[#A03D20] text-white text-sm font-semibold rounded-xl transition shadow-xs shrink-0">
            Tambah informasi
        </a>
    </div>

    <!-- Stats 4 Cards Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
        <!-- Total Informasi -->
        <div class="bg-white rounded-2xl p-6 border border-[#EBE4D8] shadow-xs">
            <span class="text-xs text-[#777] block mb-2 font-medium">Total informasi</span>
            <div class="text-4xl font-bold text-[#141414] mb-2">{{ $totalInformation }}</div>
            <p class="text-xs text-[#888]">Seluruh informasi dalam sistem</p>
        </div>

        <!-- Informasi Terbit -->
        <div class="bg-white rounded-2xl p-6 border border-[#EBE4D8] shadow-xs">
            <span class="text-xs text-[#777] block mb-2 font-medium">Informasi terbit</span>
            <div class="text-4xl font-bold text-[#141414] mb-2">{{ $publishedCount }}</div>
            <p class="text-xs text-[#888]">Dapat dibaca oleh pengguna</p>
        </div>

        <!-- Draf Tersimpan -->
        <div class="bg-white rounded-2xl p-6 border border-[#EBE4D8] shadow-xs">
            <span class="text-xs text-[#777] block mb-2 font-medium">Draf tersimpan</span>
            <div class="text-4xl font-bold text-[#141414] mb-2">{{ $draftCount }}</div>
            <p class="text-xs text-[#888]">Belum ditampilkan ke pengguna</p>
        </div>

        <!-- Kategori -->
        <div class="bg-white rounded-2xl p-6 border border-[#EBE4D8] shadow-xs">
            <span class="text-xs text-[#777] block mb-2 font-medium">Kategori</span>
            <div class="text-4xl font-bold text-[#141414] mb-2">{{ $totalCategoryTypes }}</div>
            <p class="text-xs text-[#888]">Kegiatan, Pengumuman, Artikel</p>
        </div>
    </div>

    <!-- Latest Information Table Card -->
    <div class="bg-white rounded-2xl border border-[#EBE4D8] overflow-hidden shadow-xs mb-8">
        <div class="p-6 border-b border-[#EBE4D8] flex justify-between items-center">
            <h3 class="text-lg font-bold text-[#141414]">Informasi terbaru</h3>
            <span class="text-xs text-[#888]">Diurutkan berdasarkan pembaruan terakhir</span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead class="bg-[#EFF2ED] text-[#637267] uppercase text-[10px] tracking-wider font-semibold">
                    <tr>
                        <th class="py-3.5 px-6">Judul Informasi</th>
                        <th class="py-3.5 px-6">Kategori</th>
                        <th class="py-3.5 px-6">Status</th>
                        <th class="py-3.5 px-6">Diperbarui</th>
                        <th class="py-3.5 px-6 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#F1EBE0]">
                    @forelse($latestInformation as $item)
                        <tr class="hover:bg-[#FAF8F3] transition">
                            <td class="py-4 px-6">
                                <div class="font-bold text-[#141414] text-sm mb-0.5">{{ $item->title }}</div>
                                <div class="text-[#888]">Oleh {{ $item->author->name ?? 'Administrator' }}</div>
                            </td>
                            <td class="py-4 px-6 text-[#555] font-medium">
                                {{ $item->category }}
                            </td>
                            <td class="py-4 px-6">
                                @if($item->status === 'Terbit')
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-[#E3EFE4] text-[#2F6139]">
                                        <span class="w-1.5 h-1.5 rounded-full bg-[#2F6139]"></span> Terbit
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-[#F6E7DE] text-[#B84A29]">
                                        <span class="w-1.5 h-1.5 rounded-full bg-[#B84A29]"></span> Draf
                                    </span>
                                @endif
                            </td>
                            <td class="py-4 px-6 text-[#777]">
                                {{ $item->updated_at->translatedFormat('d M Y') }}
                            </td>
                            <td class="py-4 px-6 text-right">
                                <a href="{{ route('admin.information.show', $item) }}" class="text-[#B84A29] font-semibold hover:underline">
                                    Detail
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-8 text-center text-[#888]">Belum ada informasi.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="p-4 bg-white border-t border-[#EBE4D8] flex justify-between items-center text-xs text-[#777]">
            <span>{{ count($latestInformation) }} informasi terbaru dari total {{ $totalInformation }}</span>
            <a href="{{ route('admin.information.index') }}" class="text-[#B84A29] font-semibold hover:underline inline-flex items-center gap-1">
                Lihat semua informasi →
            </a>
        </div>
    </div>

    <!-- Category Composition Stats Bar -->
    <div class="bg-white rounded-2xl p-6 border border-[#EBE4D8] shadow-xs flex flex-col md:flex-row items-center justify-between gap-6 text-xs">
        <div class="font-bold text-[#141414]">Komposisi informasi</div>
        <div class="flex flex-wrap items-center gap-8 w-full md:w-auto">
            <div class="flex items-center gap-2">
                <span class="text-[#666]">Kegiatan</span>
                <span class="font-bold text-[#141414]">{{ $categoriesCount['Kegiatan'] }}</span>
                <div class="w-24 h-1.5 bg-[#F0EBE1] rounded-full overflow-hidden">
                    <div class="h-full bg-[#B84A29]" style="width: {{ $totalInformation > 0 ? ($categoriesCount['Kegiatan'] / $totalInformation * 100) : 0 }}%"></div>
                </div>
            </div>
            <div class="flex items-center gap-2">
                <span class="text-[#666]">Pengumuman</span>
                <span class="font-bold text-[#141414]">{{ $categoriesCount['Pengumuman'] }}</span>
                <div class="w-24 h-1.5 bg-[#F0EBE1] rounded-full overflow-hidden">
                    <div class="h-full bg-[#B84A29]" style="width: {{ $totalInformation > 0 ? ($categoriesCount['Pengumuman'] / $totalInformation * 100) : 0 }}%"></div>
                </div>
            </div>
            <div class="flex items-center gap-2">
                <span class="text-[#666]">Artikel</span>
                <span class="font-bold text-[#141414]">{{ $categoriesCount['Artikel'] }}</span>
                <div class="w-24 h-1.5 bg-[#F0EBE1] rounded-full overflow-hidden">
                    <div class="h-full bg-[#B84A29]" style="width: {{ $totalInformation > 0 ? ($categoriesCount['Artikel'] / $totalInformation * 100) : 0 }}%"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
