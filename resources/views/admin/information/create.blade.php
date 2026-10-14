@extends('layouts.admin')

@section('title', 'Tambah Informasi - Portal Admin Sekolah Inspirasi')

@section('breadcrumb')
    <span>Portal admin</span>
    <span>/</span>
    <a href="{{ route('admin.information.index') }}" class="hover:underline">Informasi</a>
    <span>/</span>
    <span class="text-[#1D1D1D] font-medium">Tambah</span>
@endsection

@section('admin_content')
<div class="max-w-6xl">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-6">
        <div>
            <h1 class="text-3xl font-bold text-[#141414] mb-1">Tambah informasi</h1>
            <p class="text-xs text-[#777]">Bagikan kabar baru untuk komunitas sekolah. Kolom bertanda * wajib diisi.</p>
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

    <form id="infoForm" action="{{ route('admin.information.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="status" id="statusInput" value="Terbit">

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
                            value="{{ old('title') }}" 
                            placeholder="Tuliskan judul yang singkat dan jelas" 
                            maxlength="120"
                            required
                            oninput="updateTitleCharCount(this)"
                            class="w-full px-4 py-3 bg-white border border-[#DDD7CD] rounded-xl text-xs focus:outline-none focus:ring-2 focus:ring-[#B84A29]"
                        >
                        <div class="flex justify-between items-center text-[10px] text-[#888] mt-1.5">
                            <span>Maksimal 120 karakter.</span>
                            <span id="titleCount">0/120 karakter</span>
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
                        >{{ old('summary') }}</textarea>
                        <p class="text-[10px] text-[#888] mt-1">Ringkasan ditampilkan pada kartu informasi.</p>
                    </div>

                    <!-- Gambar Sampul -->
                    <div>
                        <label class="block text-xs font-bold text-[#2D2D2D] mb-1.5">Gambar sampul</label>
                        <label class="block border-2 border-dashed border-[#DDD7CD] rounded-2xl p-8 text-center cursor-pointer hover:border-[#B84A29] transition bg-[#FAF8F5]">
                            <input type="file" name="cover_image" accept="image/*" class="hidden" onchange="previewImage(this)">
                            <div id="uploadPrompt">
                                <p class="text-xs font-semibold text-[#B84A29] mb-1">Pilih gambar atau tarik ke sini</p>
                                <p class="text-[10px] text-[#888]">JPG atau PNG · Maks. 5 MB · Rasio 16:9 disarankan</p>
                            </div>
                            <div id="imagePreviewContainer" class="hidden">
                                <img id="imagePreview" src="#" alt="Preview" class="h-32 mx-auto rounded-xl object-cover mb-2">
                                <p class="text-xs text-[#555] font-medium" id="fileNameDisplay"></p>
                            </div>
                        </label>
                    </div>

                    <!-- Konten Informasi -->
                    <div>
                        <label for="content" class="block text-xs font-bold text-[#2D2D2D] mb-1.5">Konten informasi *</label>
                        <div class="border border-[#DDD7CD] rounded-2xl overflow-hidden focus-within:ring-2 focus-within:ring-[#B84A29]">
                            <!-- Simple Rich-text Toolbar -->
                            <div class="bg-[#F6F3EC] px-4 py-2 border-b border-[#DDD7CD] flex items-center gap-3 text-xs text-[#555]">
                                <span class="font-medium">Paragraf ▾</span>
                                <button type="button" onclick="formatDoc('bold')" class="font-bold hover:text-black">B</button>
                                <button type="button" onclick="formatDoc('italic')" class="italic hover:text-black">I</button>
                            </div>
                            <textarea 
                                name="content" 
                                id="content" 
                                rows="12" 
                                placeholder="Mulai menulis cerita, pengumuman, atau artikel Anda di sini..."
                                required
                                oninput="updateWordCount(this)"
                                class="w-full p-4 bg-white text-xs leading-relaxed focus:outline-none resize-y border-none"
                            >{{ old('content') }}</textarea>
                            <div class="px-4 py-2 bg-[#FAF8F5] border-t border-[#EFE9DF] text-right text-[10px] text-[#888]" id="wordCountDisplay">
                                0 kata
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
                            <option value="Kegiatan" {{ old('category') === 'Kegiatan' ? 'selected' : '' }}>Kegiatan</option>
                            <option value="Pengumuman" {{ old('category') === 'Pengumuman' ? 'selected' : '' }}>Pengumuman</option>
                            <option value="Artikel" {{ old('category') === 'Artikel' ? 'selected' : '' }}>Artikel</option>
                        </select>
                        <p class="text-[10px] text-[#888] mt-1">Kegiatan, Pengumuman, atau Artikel</p>
                    </div>

                    <div>
                        <span class="block text-xs font-bold text-[#2D2D2D] mb-1.5">Status publikasi</span>
                        <div class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-[#F6E7DE] text-[#B84A29]">
                            <span class="w-1.5 h-1.5 rounded-full bg-[#B84A29]"></span> Draf
                        </div>
                        <p class="text-[10px] text-[#888] mt-2 leading-relaxed">Informasi baru belum terlihat oleh pengguna sampai Anda menerbitkannya.</p>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-[#2D2D2D] mb-1.5">Penulis</label>
                        <input type="text" value="{{ Auth::user()->name ?? 'Dina Pramesti' }}" disabled class="w-full px-3 py-2.5 bg-[#F6F3EC] border border-[#DDD7CD] rounded-xl text-xs text-[#666]">
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
            <span class="text-[#888]">Draf hanya dapat dilihat oleh admin.</span>
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.information.index') }}" class="px-5 py-2.5 border border-[#DDD7CD] hover:bg-[#F8F6F0] rounded-xl text-[#555] font-semibold transition">
                    Batal
                </a>
                <button type="button" onclick="submitAs('Draf')" class="px-5 py-2.5 border border-[#DDD7CD] hover:bg-[#F8F6F0] rounded-xl text-[#333] font-semibold transition">
                    Simpan draf
                </button>
                <button type="button" onclick="submitAs('Terbit')" class="px-5 py-2.5 bg-[#B84A29] hover:bg-[#A03D20] text-white rounded-xl font-semibold transition shadow-xs">
                    Terbitkan informasi
                </button>
            </div>
        </div>
    </form>
</div>

<script>
    function updateTitleCharCount(input) {
        document.getElementById('titleCount').textContent = `${input.value.length}/120 karakter`;
    }

    function updateWordCount(textarea) {
        const text = textarea.value.trim();
        const words = text ? text.split(/\s+/).length : 0;
        document.getElementById('wordCountDisplay').textContent = `${words} kata`;
    }

    function previewImage(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('imagePreview').src = e.target.result;
                document.getElementById('fileNameDisplay').textContent = input.files[0].name;
                document.getElementById('uploadPrompt').classList.add('hidden');
                document.getElementById('imagePreviewContainer').classList.remove('hidden');
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    function submitAs(status) {
        document.getElementById('statusInput').value = status;
        document.getElementById('infoForm').submit();
    }

    function formatDoc(cmd) {
        // Simple textarea text formatting helper
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
        updateWordCount(textarea);
    }
</script>
@endsection
