@extends('layouts.admin')

@section('title', 'Edit Informasi - Portal Admin Sekolah Inspirasi')

@section('breadcrumb')
    <span>Portal admin</span>
    <span>/</span>
    <a href="{{ route('admin.information.index') }}" class="hover:underline">Informasi</a>
    <span>/</span>
    <span class="text-[#1D1D1D] font-medium">Edit</span>
@endsection

@section('admin_content')
<div class="max-w-6xl">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-6">
        <div>
            <h1 class="text-3xl font-bold text-[#141414] mb-1">Edit informasi</h1>
            <p class="text-xs text-[#777]">Perbarui isi informasi yang sudah terbit. Perubahan akan terlihat oleh pengguna setelah disimpan.</p>
        </div>
        <a href="{{ route('admin.information.index') }}" class="text-xs font-semibold text-[#B84A29] hover:underline flex items-center gap-1.5">
            ← Kembali ke daftar
        </a>
    </div>

    @if ($errors->any())
        <div class="mb-6 p-4 rounded-xl bg-red-50 border border-red-200 text-red-800 text-xs">
            <ul class="list-disc pl-4 space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form id="infoForm" action="{{ route('admin.information.update', $information) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <input type="hidden" name="status" id="statusInput" value="{{ old('status', $information->status) }}">

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 mb-8">
            <!-- Left Main Form (8 cols) -->
            <div class="lg:col-span-8 space-y-6">
                <div class="bg-white rounded-3xl p-8 border border-[#EBE4D8] shadow-xs space-y-6">
                    <h2 class="text-lg font-bold text-[#141414]">Isi informasi</h2>

                    <!-- Judul Informasi -->
                    <div>
                        <label for="title" class="block text-xs font-bold text-[#2D2D2D] mb-1.5">Judul informasi *</label>
                        <input 
                            type="text" 
                            name="title" 
                            id="title" 
                            value="{{ old('title', $information->title) }}" 
                            placeholder="Tuliskan judul yang singkat dan jelas" 
                            maxlength="120"
                            required
                            oninput="updateTitleCharCount(this)"
                            class="w-full px-4 py-3 bg-white border border-[#DDD7CD] rounded-xl text-xs focus:outline-none focus:ring-2 focus:ring-[#B84A29]"
                        >
                        <div class="flex justify-between items-center text-[10px] text-[#888] mt-1.5">
                            <span>Maksimal 120 karakter.</span>
                            <span id="titleCount">{{ strlen($information->title) }}/120 karakter</span>
                        </div>
                    </div>

                    <!-- Ringkasan -->
                    <div>
                        <label for="summary" class="block text-xs font-bold text-[#2D2D2D] mb-1.5">Ringkasan *</label>
                        <textarea 
                            name="summary" 
                            id="summary" 
                            rows="3" 
                            placeholder="Jelaskan inti informasi dalam 1–2 kalimat..."
                            class="w-full px-4 py-3 bg-white border border-[#DDD7CD] rounded-xl text-xs focus:outline-none focus:ring-2 focus:ring-[#B84A29]"
                        >{{ old('summary', $information->summary) }}</textarea>
                        <p class="text-[10px] text-[#888] mt-1">Ringkasan ditampilkan pada kartu informasi.</p>
                    </div>

                    <!-- Gambar Sampul -->
                    <div>
                        <label class="block text-xs font-bold text-[#2D2D2D] mb-1.5">Gambar sampul</label>
                        <div class="border border-[#DDD7CD] rounded-2xl p-4 bg-[#FAF8F5] flex items-center justify-between">
                            <div class="flex items-center gap-4">
                                <div class="w-16 h-16 rounded-xl bg-white border border-[#E5DFD4] overflow-hidden flex items-center justify-center">
                                    @if($information->cover_image)
                                        <img src="{{ asset('storage/' . $information->cover_image) }}" class="w-full h-full object-cover">
                                    @else
                                        <span class="text-xs text-[#999]">Foto</span>
                                    @endif
                                </div>
                                <div class="text-xs">
                                    <div class="font-bold text-[#141414]">{{ $information->cover_image ? basename($information->cover_image) : 'Belum ada gambar' }}</div>
                                    <div class="text-[10px] text-[#888]">JPG, PNG · Rasio 16:9 disarankan</div>
                                </div>
                            </div>
                            <label class="px-3.5 py-2 bg-white border border-[#DDD7CD] rounded-xl text-xs font-semibold text-[#B84A29] cursor-pointer hover:bg-[#F3EFE6]">
                                Ganti gambar
                                <input type="file" name="cover_image" accept="image/*" class="hidden" onchange="previewImage(this)">
                            </label>
                        </div>
                    </div>

                    <!-- Konten Informasi -->
                    <div>
                        <label for="content" class="block text-xs font-bold text-[#2D2D2D] mb-1.5">Konten informasi *</label>
                        <div class="border border-[#DDD7CD] rounded-2xl overflow-hidden focus-within:ring-2 focus-within:ring-[#B84A29]">
                            <div class="bg-[#F6F3EC] px-4 py-2 border-b border-[#DDD7CD] flex items-center gap-3 text-xs text-[#555]">
                                <span class="font-medium">Paragraf ▾</span>
                                <button type="button" onclick="formatDoc('bold')" class="font-bold hover:text-black">B</button>
                                <button type="button" onclick="formatDoc('italic')" class="italic hover:text-black">I</button>
                            </div>
                            <textarea 
                                name="content" 
                                id="content" 
                                rows="14" 
                                required
                                oninput="updateParagraphCount(this)"
                                class="w-full p-4 bg-white text-xs leading-relaxed focus:outline-none resize-y border-none"
                            >{{ old('content', $information->content) }}</textarea>
                            <div class="px-4 py-2 bg-[#FAF8F5] border-t border-[#EFE9DF] text-right text-[10px] text-[#888]" id="countDisplay">
                                5 paragraf
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Sidebar Panel (4 cols) -->
            <div class="lg:col-span-4 space-y-6">
                <!-- Pengaturan Publikasi -->
                <div class="bg-white rounded-3xl p-6 border border-[#EBE4D8] shadow-xs space-y-5">
                    <h3 class="text-base font-bold text-[#141414] pb-3 border-b border-[#EBE4D8]">Pengaturan publikasi</h3>

                    <div>
                        <label for="category" class="block text-xs font-bold text-[#2D2D2D] mb-1.5">Kategori *</label>
                        <select name="category" id="category" required class="w-full px-3 py-2.5 bg-white border border-[#DDD7CD] rounded-xl text-xs focus:outline-none focus:ring-2 focus:ring-[#B84A29]">
                            <option value="Kegiatan" {{ old('category', $information->category) === 'Kegiatan' ? 'selected' : '' }}>Kegiatan</option>
                            <option value="Pengumuman" {{ old('category', $information->category) === 'Pengumuman' ? 'selected' : '' }}>Pengumuman</option>
                            <option value="Artikel" {{ old('category', $information->category) === 'Artikel' ? 'selected' : '' }}>Artikel</option>
                        </select>
                        <p class="text-[10px] text-[#888] mt-1">Kegiatan, Pengumuman, atau Artikel</p>
                    </div>

                    <div>
                        <span class="block text-xs font-bold text-[#2D2D2D] mb-1.5">Status publikasi</span>
                        <div class="flex items-center gap-2">
                            <button type="button" onclick="setStatus('Terbit')" id="badgeTerbit" class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-medium {{ $information->status === 'Terbit' ? 'bg-[#E3EFE4] text-[#2F6139] border border-[#A7CEAB]' : 'bg-[#F2ECE1] text-[#777]' }}">
                                <span class="w-1.5 h-1.5 rounded-full bg-current"></span> Terbit
                            </button>
                            <button type="button" onclick="setStatus('Draf')" id="badgeDraf" class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-medium {{ $information->status === 'Draf' ? 'bg-[#F6E7DE] text-[#B84A29] border border-[#E5BFB1]' : 'bg-[#F2ECE1] text-[#777]' }}">
                                <span class="w-1.5 h-1.5 rounded-full bg-current"></span> Draf
                            </button>
                        </div>
                        <p class="text-[10px] text-[#888] mt-2 leading-relaxed">
                            Informasi ini dapat dibaca pengguna. Simpan perubahan untuk memperbaruinya.
                        </p>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-[#2D2D2D] mb-1.5">Penulis</label>
                        <input type="text" value="{{ $information->author->name ?? 'Dina Pramesti' }}" disabled class="w-full px-3 py-2.5 bg-[#F6F3EC] border border-[#DDD7CD] rounded-xl text-xs text-[#666]">
                    </div>

                    <div class="text-[10px] text-[#888]">
                        Diterbitkan {{ $information->created_at->translatedFormat('d F Y, H.i') }} WIB
                    </div>
                </div>

                <!-- Helper Tip Card -->
                <div class="bg-[#E7ECE7] rounded-3xl p-6 text-[#2D4537] space-y-2">
                    <h4 class="text-xs font-bold text-[#1D3326]">Cerita yang mudah dipahami</h4>
                    <p class="text-[11px] leading-relaxed text-[#435C4E]">
                        Gunakan judul yang jelas, informasi yang akurat, dan foto yang relevan. Periksa kembali tanggal sebelum menerbitkan.
                    </p>
                </div>
            </div>
        </div>

        <!-- Sticky / Bottom Actions Bar -->
        <div class="bg-white rounded-2xl p-4 border border-[#EBE4D8] shadow-xs flex flex-col sm:flex-row justify-between items-center gap-4 text-xs">
            <span class="text-[#888]">Terakhir diperbarui {{ $information->updated_at->translatedFormat('d F Y, H.i') }} WIB</span>
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.information.index') }}" class="px-5 py-2.5 border border-[#DDD7CD] hover:bg-[#F8F6F0] rounded-xl text-[#555] font-semibold transition">
                    Batal
                </a>
                <button type="submit" class="px-5 py-2.5 bg-[#B84A29] hover:bg-[#A03D20] text-white rounded-xl font-semibold transition shadow-xs">
                    Simpan perubahan
                </button>
            </div>
        </div>
    </form>
</div>

<script>
    function updateTitleCharCount(input) {
        document.getElementById('titleCount').textContent = `${input.value.length}/120 karakter`;
    }

    function setStatus(status) {
        document.getElementById('statusInput').value = status;
        const bTerbit = document.getElementById('badgeTerbit');
        const bDraf = document.getElementById('badgeDraf');
        if (status === 'Terbit') {
            bTerbit.className = 'inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-medium bg-[#E3EFE4] text-[#2F6139] border border-[#A7CEAB]';
            bDraf.className = 'inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-medium bg-[#F2ECE1] text-[#777]';
        } else {
            bDraf.className = 'inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-medium bg-[#F6E7DE] text-[#B84A29] border border-[#E5BFB1]';
            bTerbit.className = 'inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-medium bg-[#F2ECE1] text-[#777]';
        }
    }

    function formatDoc(cmd) {
        const textarea = document.getElementById('content');
        const start = textarea.selectionStart;
        const end = textarea.selectionEnd;
        const text = textarea.value;
        const selected = text.substring(start, end);

        if (cmd === 'bold') {
            textarea.value = text.substring(0, start) + '**' + selected + '**' + text.substring(end);
        } else if (cmd === 'italic') {
            textarea.value = text.substring(0, start) + '*' + selected + '*' + text.substring(end);
        }
    }
</script>
@endsection
