@extends('layouts.admin')

@section('title', 'Kelola Informasi - Portal Admin Sekolah Inspirasi')

@section('breadcrumb')
    <span>Portal admin</span>
    <span>/</span>
    <span class="text-[#1D1D1D] font-medium">Informasi</span>
@endsection

@section('admin_content')
<div class="max-w-6xl">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-6">
        <div>
            <h1 class="text-3xl font-bold text-[#141414] mb-1">Kelola informasi</h1>
            <p class="text-xs text-[#777]">Kelola cerita, agenda, dan pengumuman untuk komunitas sekolah.</p>
        </div>
        <a href="{{ route('admin.information.create') }}" class="px-6 py-3 bg-[#B84A29] hover:bg-[#A03D20] text-white text-xs font-semibold rounded-xl transition shadow-xs">
            Tambah informasi
        </a>
    </div>

    <!-- Status Tabs (Semua, Terbit, Draf) -->
    <div class="flex items-center gap-6 border-b border-[#E8E2D6] mb-6 text-xs font-semibold">
        <a href="{{ route('admin.information.index', array_merge(request()->query(), ['tab' => 'semua', 'page' => 1])) }}" 
           class="pb-3 border-b-2 transition {{ $tab === 'semua' ? 'border-[#B84A29] text-[#B84A29]' : 'border-transparent text-[#777] hover:text-[#222]' }}">
            Semua ({{ $allCount }})
        </a>
        <a href="{{ route('admin.information.index', array_merge(request()->query(), ['tab' => 'terbit', 'page' => 1])) }}" 
           class="pb-3 border-b-2 transition {{ $tab === 'terbit' ? 'border-[#B84A29] text-[#B84A29]' : 'border-transparent text-[#777] hover:text-[#222]' }}">
            Terbit ({{ $publishedCount }})
        </a>
        <a href="{{ route('admin.information.index', array_merge(request()->query(), ['tab' => 'draf', 'page' => 1])) }}" 
           class="pb-3 border-b-2 transition {{ $tab === 'draf' ? 'border-[#B84A29] text-[#B84A29]' : 'border-transparent text-[#777] hover:text-[#222]' }}">
            Draf ({{ $draftCount }})
        </a>
    </div>

    <!-- Search & Filters Toolbar -->
    <form action="{{ route('admin.information.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-12 gap-3 mb-6">
        <input type="hidden" name="tab" value="{{ $tab }}">

        <!-- Search Bar -->
        <div class="md:col-span-8">
            <div class="relative">
                <input 
                    type="text" 
                    name="search" 
                    value="{{ $search }}" 
                    placeholder="Cari judul informasi..." 
                    class="w-full pl-4 pr-10 py-2.5 bg-white border border-[#DDD7CD] rounded-xl text-xs focus:outline-none focus:ring-2 focus:ring-[#B84A29]"
                >
                @if($search)
                    <a href="{{ route('admin.information.index', ['tab' => $tab]) }}" class="absolute right-3 top-2.5 text-[#999] hover:text-[#333] text-sm">&times;</a>
                @endif
            </div>
        </div>

        <!-- Filter Category -->
        <div class="md:col-span-2">
            <select name="category" onchange="this.form.submit()" class="w-full px-3 py-2.5 bg-white border border-[#DDD7CD] rounded-xl text-xs text-[#444] focus:outline-none focus:ring-2 focus:ring-[#B84A29]">
                <option value="">Semua kategori</option>
                <option value="Kegiatan" {{ $category === 'Kegiatan' ? 'selected' : '' }}>Kegiatan</option>
                <option value="Pengumuman" {{ $category === 'Pengumuman' ? 'selected' : '' }}>Pengumuman</option>
                <option value="Artikel" {{ $category === 'Artikel' ? 'selected' : '' }}>Artikel</option>
            </select>
        </div>

        <!-- Sort Option -->
        <div class="md:col-span-2">
            <select name="sort" onchange="this.form.submit()" class="w-full px-3 py-2.5 bg-white border border-[#DDD7CD] rounded-xl text-xs text-[#444] focus:outline-none focus:ring-2 focus:ring-[#B84A29]">
                <option value="terbaru" {{ $sort === 'terbaru' ? 'selected' : '' }}>Terbaru</option>
                <option value="terlama" {{ $sort === 'terlama' ? 'selected' : '' }}>Terlama</option>
            </select>
        </div>
    </form>

    <!-- Information Table Card -->
    <div class="bg-white rounded-2xl border border-[#EBE4D8] overflow-hidden shadow-xs mb-6">
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
                    @forelse($informations as $item)
                        <tr class="hover:bg-[#FAF8F3] transition">
                            <td class="py-4 px-6">
                                <div class="font-bold text-[#141414] text-sm mb-0.5">{{ $item->title }}</div>
                                <div class="text-[#888]">Oleh {{ $item->author->name ?? 'Dina Pramesti' }}</div>
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
                            <td class="py-4 px-6 text-right space-x-3 font-semibold">
                                <a href="{{ route('admin.information.show', $item) }}" class="text-[#B84A29] hover:underline">
                                    Detail
                                </a>
                                <a href="{{ route('admin.information.edit', $item) }}" class="text-[#B84A29] hover:underline">
                                    Edit
                                </a>
                                <button 
                                    type="button" 
                                    onclick="openDeleteModal('{{ $item->id }}', '{{ addslashes($item->title) }}', '{{ $item->status }}')" 
                                    class="text-[#B84A29] hover:underline cursor-pointer"
                                >
                                    Hapus
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-12 text-center text-[#888]">
                                Tidak ada data informasi yang sesuai filter.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Table Footer / Pagination -->
        <div class="p-4 bg-white border-t border-[#EBE4D8] flex flex-col sm:flex-row justify-between items-center gap-4 text-xs text-[#777]">
            <div>
                Menampilkan {{ $informations->firstItem() ?? 0 }}–{{ $informations->lastItem() ?? 0 }} dari {{ $informations->total() }} informasi
            </div>
            <div>
                {{ $informations->links() }}
            </div>
        </div>
    </div>
</div>

<!-- Modal Konfirmasi Hapus (Admin - Konfirmasi hapus.png) -->
<div id="deleteModal" class="fixed inset-0 z-50 hidden bg-black/40 backdrop-blur-xs flex items-center justify-center p-4">
    <div class="bg-white rounded-3xl max-w-md w-full p-8 shadow-2xl relative animate-in fade-in zoom-in-95">
        <!-- Circular Soft Icon -->
        <div class="w-12 h-12 rounded-full bg-[#F7E7DE] flex items-center justify-center mb-6">
            <svg class="w-6 h-6 text-[#B84A29]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
            </svg>
        </div>

        <h3 class="text-2xl font-bold text-[#141414] mb-2">Hapus informasi ini?</h3>
        <p class="text-xs text-[#666] leading-relaxed mb-6">
            Informasi akan dihapus dari sistem dan tidak lagi dapat dibaca oleh pengguna. Tindakan ini tidak dapat dibatalkan.
        </p>

        <!-- Preview Card in Modal -->
        <div class="bg-[#F8F6F0] border border-[#E9E3D8] rounded-2xl p-4 mb-6 flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-white border border-[#E0D9CD] flex items-center justify-center text-xs text-[#888]">
                📄
            </div>
            <div>
                <div id="modalItemTitle" class="text-xs font-bold text-[#141414] line-clamp-1">Judul Informasi</div>
                <div class="mt-1">
                    <span id="modalItemStatus" class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-medium bg-[#E3EFE4] text-[#2F6139]">
                        • Terbit
                    </span>
                </div>
            </div>
        </div>

        <!-- Form & Buttons -->
        <form id="deleteForm" method="POST" action="" class="flex items-center justify-end gap-3">
            @csrf
            @method('DELETE')
            <button 
                type="button" 
                onclick="closeDeleteModal()" 
                class="px-5 py-2.5 border border-[#DDD7CD] hover:bg-[#F8F6F0] text-xs font-semibold text-[#444] rounded-xl transition"
            >
                Batal
            </button>
            <button 
                type="submit" 
                class="px-5 py-2.5 bg-[#B84A29] hover:bg-[#A03D20] text-xs font-semibold text-white rounded-xl transition shadow-xs"
            >
                Ya, hapus informasi
            </button>
        </form>
    </div>
</div>

<script>
    function openDeleteModal(id, title, status) {
        const modal = document.getElementById('deleteModal');
        const form = document.getElementById('deleteForm');
        const titleEl = document.getElementById('modalItemTitle');
        const statusEl = document.getElementById('modalItemStatus');

        form.action = `/admin/information/${id}`;
        titleEl.textContent = title;

        if (status === 'Terbit') {
            statusEl.className = 'inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-medium bg-[#E3EFE4] text-[#2F6139]';
            statusEl.innerHTML = '<span class="w-1.5 h-1.5 rounded-full bg-[#2F6139]"></span> Terbit';
        } else {
            statusEl.className = 'inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-medium bg-[#F6E7DE] text-[#B84A29]';
            statusEl.innerHTML = '<span class="w-1.5 h-1.5 rounded-full bg-[#B84A29]"></span> Draf';
        }

        modal.classList.remove('hidden');
    }

    function closeDeleteModal() {
        document.getElementById('deleteModal').classList.add('hidden');
    }
</script>
@endsection
