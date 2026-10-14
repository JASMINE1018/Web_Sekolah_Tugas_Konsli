@extends('layouts.base')

@section('title', 'Sekolah Inspirasi - Rasa ingin tahu hari ini. Inspirasi masa depan.')

@section('content')
<!-- Navigation Bar -->
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

        <!-- Desktop Menu -->
        <nav class="hidden md:flex items-center gap-8 text-sm font-medium text-[#4D4D4D]">
            <a href="#tentang" class="hover:text-[#B84A29] transition-colors">Tentang kami</a>
            <a href="#program" class="hover:text-[#B84A29] transition-colors">Program</a>
            <a href="#kehidupan" class="hover:text-[#B84A29] transition-colors">Kehidupan sekolah</a>
            <a href="{{ route('user.information.index') }}" class="hover:text-[#B84A29] transition-colors">Informasi</a>
        </nav>

        <!-- Right Action Button -->
        <div class="flex items-center gap-4">
            @auth
                @if(Auth::user()->role === 'admin')
                    <a href="{{ route('admin.dashboard') }}" class="px-5 py-2.5 bg-[#B84A29] hover:bg-[#A03D20] text-white text-sm font-medium rounded-full transition shadow-sm">
                        Dashboard Admin
                    </a>
                @else
                    <a href="{{ route('user.information.index') }}" class="px-5 py-2.5 bg-[#B84A29] hover:bg-[#A03D20] text-white text-sm font-medium rounded-full transition shadow-sm">
                        Portal Informasi
                    </a>
                @endif
            @else
                <a href="{{ route('login') }}" class="px-5 py-2.5 bg-white border border-[#DDD7CD] hover:border-[#B84A29] text-[#1F1F1F] text-sm font-medium rounded-full transition shadow-xs">
                    Masuk portal
                </a>
            @endauth
        </div>
    </div>
</header>

<main class="flex-1">
    <!-- Hero Section -->
    <section class="max-w-7xl mx-auto px-6 lg:px-12 pt-16 pb-20">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">
            <div class="lg:col-span-7">
                <p class="text-xs font-bold tracking-widest uppercase text-[#B84A29] mb-4">Sekolah untuk kehidupan</p>
                <h1 class="text-5xl lg:text-6xl font-bold tracking-tight text-[#141414] leading-[1.12] mb-6">
                    Rasa ingin tahu hari ini.<br>
                    Inspirasi masa depan.
                </h1>
            </div>
            <div class="lg:col-span-5 lg:pt-6">
                <p class="text-[#555] text-base leading-relaxed mb-6">
                    Ruang untuk bertanya, berani mencoba, dan tumbuh menjadi diri sendiri. Di sini, setiap anak punya cerita yang berarti.
                </p>
                <a href="#program" class="inline-block px-6 py-3 bg-[#B84A29] hover:bg-[#A03D20] text-white text-sm font-medium rounded-xl transition shadow-xs">
                    Kenali sekolah kami
                </a>
            </div>
        </div>

        <!-- Banner Card (Gradient background like UI) -->
        <div class="mt-16 rounded-3xl bg-gradient-to-r from-[#7B8B82] via-[#8B9890] to-[#55635C] p-10 md:p-14 text-white relative overflow-hidden flex flex-col md:flex-row justify-between items-center gap-8 shadow-sm">
            <div class="max-w-xl">
                <p class="text-xs font-semibold uppercase tracking-widest text-[#D3DDD7] mb-2">Belajar dengan hati, tumbuh dengan makna.</p>
                <h2 class="text-3xl md:text-4xl font-bold leading-snug">
                    Setiap pertanyaan adalah awal dari sebuah penemuan.
                </h2>
            </div>
            <div class="bg-white/95 text-[#1F1F1F] p-6 rounded-2xl w-full md:w-80 backdrop-blur-xs shrink-0 shadow-lg">
                <p class="text-xs uppercase font-bold text-[#888] tracking-wider mb-2">Tahun ajaran 2027/2028</p>
                <h3 class="text-xl font-bold mb-3 leading-snug">Pintu kami terbuka untuk cerita baru.</h3>
                <a href="{{ route('login') }}" class="inline-flex items-center gap-1.5 text-xs font-semibold text-[#B84A29] hover:underline">
                    Jelajahi penerimaan murid <span>↗</span>
                </a>
            </div>
        </div>
    </section>

    <!-- Stat & Value Proposition -->
    <section id="tentang" class="max-w-7xl mx-auto px-6 lg:px-12 py-16 border-t border-[#ECE6DB]">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-start mb-16">
            <div class="lg:col-span-6">
                <p class="text-xs font-bold tracking-widest uppercase text-[#B84A29] mb-2">Selamat datang di Sekolah Inspirasi</p>
                <h2 class="text-3xl lg:text-4xl font-bold tracking-tight text-[#1A1A1A] leading-tight">
                    Bukan sekadar sekolah.<br>Tempat menemukan kemungkinan.
                </h2>
            </div>
            <div class="lg:col-span-6">
                <p class="text-[#555] text-sm leading-relaxed mb-8">
                    Kami percaya pendidikan yang bermakna dimulai dari anak yang merasa didengar. Sejak 2012, Sekolah Inspirasi mendampingi anak belajar dengan pikiran terbuka, hati yang peduli, dan keberanian untuk berkarya.
                </p>
                <div class="grid grid-cols-3 gap-6 pt-4 border-t border-[#ECE6DB]">
                    <div>
                        <div class="text-3xl font-bold text-[#141414]">14</div>
                        <div class="text-xs text-[#777] mt-1">tahun bertumbuh</div>
                    </div>
                    <div>
                        <div class="text-3xl font-bold text-[#141414]">360+</div>
                        <div class="text-xs text-[#777] mt-1">cerita pembelajar</div>
                    </div>
                    <div>
                        <div class="text-3xl font-bold text-[#141414]">1:12</div>
                        <div class="text-xs text-[#777] mt-1">rasio guru & murid</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- 3 Core Values -->
        <div class="pt-8">
            <div class="flex justify-between items-center mb-8">
                <h3 class="text-2xl font-bold text-[#141414]">Nilai yang tumbuh bersama kami.</h3>
                <span class="text-xs font-semibold tracking-wider uppercase text-[#B84A29]">Dasar setiap pengalaman belajar</span>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="p-8 bg-[#F3EFE6] rounded-2xl">
                    <h4 class="text-lg font-bold text-[#141414] mb-3">Rasa ingin tahu</h4>
                    <p class="text-xs text-[#555] leading-relaxed">
                        Pertanyaan anak menjadi pintu menuju eksplorasi, bukan sekadar jawaban yang sudah tersedia.
                    </p>
                </div>
                <div class="p-8 bg-[#F3EFE6] rounded-2xl">
                    <h4 class="text-lg font-bold text-[#141414] mb-3">Empati & kepedulian</h4>
                    <p class="text-xs text-[#555] leading-relaxed">
                        Belajar memahami diri sendiri, menghargai perbedaan, dan merawat dunia di sekitar kita.
                    </p>
                </div>
                <div class="p-8 bg-[#F3EFE6] rounded-2xl">
                    <h4 class="text-lg font-bold text-[#141414] mb-3">Berani bertumbuh</h4>
                    <p class="text-xs text-[#555] leading-relaxed">
                        Memberi ruang untuk mencoba, membuat kesalahan, dan menemukan cara baru bersama.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Program Stages -->
    <section id="program" class="max-w-7xl mx-auto px-6 lg:px-12 py-16 border-t border-[#ECE6DB]">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-12">
            <div>
                <p class="text-xs font-bold tracking-widest uppercase text-[#B84A29] mb-2">Perjalanan belajar</p>
                <h2 class="text-3xl lg:text-4xl font-bold tracking-tight text-[#141414]">Bertumbuh di setiap tahap.</h2>
            </div>
            <p class="text-xs text-[#666] max-w-sm mt-3 md:mt-0">
                Pendekatan yang mengikuti kebutuhan anak, bukan sebaliknya.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-white rounded-3xl p-6 border border-[#E9E3D8] shadow-xs flex flex-col justify-between">
                <div>
                    <div class="h-44 bg-[#EBE7DF] rounded-2xl mb-6 flex items-center justify-center text-[#999] text-xs">
                        Foto Suasana TK
                    </div>
                    <span class="text-xs uppercase font-bold text-[#B84A29]">Usia 3-6 Tahun</span>
                    <h3 class="text-xl font-bold text-[#141414] mt-1 mb-2">Taman Kanak-kanak</h3>
                    <p class="text-xs text-[#666] leading-relaxed mb-6">
                        Bermain, bereksplorasi, dan membangun fondasi rasa percaya diri dalam suasana yang hangat.
                    </p>
                </div>
                <a href="{{ route('login') }}" class="text-xs font-semibold text-[#B84A29] hover:underline inline-flex items-center gap-1">
                    Jelajahi program ↗
                </a>
            </div>

            <div class="bg-white rounded-3xl p-6 border border-[#E9E3D8] shadow-xs flex flex-col justify-between">
                <div>
                    <div class="h-44 bg-[#EBE7DF] rounded-2xl mb-6 flex items-center justify-center text-[#999] text-xs">
                        Foto Proyek Siswa SD
                    </div>
                    <span class="text-xs uppercase font-bold text-[#B84A29]">Usia 6-12 Tahun</span>
                    <h3 class="text-xl font-bold text-[#141414] mt-1 mb-2">Sekolah Dasar</h3>
                    <p class="text-xs text-[#666] leading-relaxed mb-6">
                        Menghubungkan pengetahuan dengan kehidupan melalui proyek, kolaborasi, dan penemuan.
                    </p>
                </div>
                <a href="{{ route('login') }}" class="text-xs font-semibold text-[#B84A29] hover:underline inline-flex items-center gap-1">
                    Jelajahi program ↗
                </a>
            </div>

            <div class="bg-white rounded-3xl p-6 border border-[#E9E3D8] shadow-xs flex flex-col justify-between">
                <div>
                    <div class="h-44 bg-[#EBE7DF] rounded-2xl mb-6 flex items-center justify-center text-[#999] text-xs">
                        Foto Studio Karya SMP
                    </div>
                    <span class="text-xs uppercase font-bold text-[#B84A29]">Usia 12-15 Tahun</span>
                    <h3 class="text-xl font-bold text-[#141414] mt-1 mb-2">Sekolah Menengah</h3>
                    <p class="text-xs text-[#666] leading-relaxed mb-6">
                        Menemukan minat, melatih kemandirian, dan menciptakan karya yang berdampak bagi komunitas.
                    </p>
                </div>
                <a href="{{ route('login') }}" class="text-xs font-semibold text-[#B84A29] hover:underline inline-flex items-center gap-1">
                    Jelajahi program ↗
                </a>
            </div>
        </div>
    </section>

    <!-- Dark Banner: Ruang untuk Menemukan -->
    <section id="kehidupan" class="bg-[#2D3A32] text-white py-20">
        <div class="max-w-7xl mx-auto px-6 lg:px-12 flex flex-col lg:flex-row justify-end items-center">
            <div class="lg:w-6/12 ml-auto">
                <p class="text-xs font-bold uppercase tracking-widest text-[#B0C3B7] mb-3">Ruang untuk menemukan</p>
                <h2 class="text-4xl font-bold leading-tight mb-6">
                    Dunia adalah ruang kelas kita.
                </h2>
                <p class="text-[#D3DDD7] text-sm leading-relaxed mb-8">
                    Dari kebun sekolah hingga studio karya, setiap sudut mengundang anak untuk menyentuh, mencoba, dan memahami dunia dengan caranya sendiri.
                </p>
                <ul class="space-y-3 text-sm text-[#E1E8E4] mb-8">
                    <li class="flex items-center gap-2"><span>↗</span> Kelas terbuka yang hangat & inklusif</li>
                    <li class="flex items-center gap-2"><span>↗</span> Kebun belajar dan ruang eksplorasi</li>
                    <li class="flex items-center gap-2"><span>↗</span> Perpustakaan & studio kreativitas</li>
                </ul>
                <a href="{{ route('login') }}" class="inline-block px-6 py-3 bg-white text-[#2D3A32] text-xs font-semibold rounded-xl hover:bg-[#F3EFE6] transition">
                    Lihat kehidupan sekolah
                </a>
            </div>
        </div>
    </section>

    <!-- Catatan dari Sekolah / Informasi Terbaru -->
    <section class="max-w-7xl mx-auto px-6 lg:px-12 py-20">
        <div class="flex justify-between items-center mb-10">
            <h2 class="text-3xl font-bold text-[#141414]">Cerita kecil. Inspirasi besar.</h2>
            <a href="{{ route('user.information.index') }}" class="px-5 py-2.5 bg-white border border-[#DDD7CD] hover:border-[#B84A29] text-xs font-semibold rounded-full transition">
                Semua informasi
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @forelse($recentStories as $story)
                <div class="bg-white rounded-3xl p-6 border border-[#EBE5DA] shadow-xs flex flex-col justify-between">
                    <div>
                        <div class="h-44 bg-[#F2ECE1] rounded-2xl mb-6 overflow-hidden flex items-center justify-center">
                            @if($story->cover_image)
                                <img src="{{ asset('storage/' . $story->cover_image) }}" alt="{{ $story->title }}" class="w-full h-full object-cover">
                            @else
                                <span class="text-xs text-[#999]">{{ $story->category }}</span>
                            @endif
                        </div>
                        <div class="flex items-center gap-2 text-xs uppercase font-bold text-[#888] mb-2">
                            <span class="text-[#B84A29]">{{ $story->category }}</span>
                            <span>•</span>
                            <span>{{ $story->created_at->translatedFormat('d M Y') }}</span>
                        </div>
                        <h3 class="text-xl font-bold text-[#141414] mb-3 leading-snug">{{ $story->title }}</h3>
                        <p class="text-xs text-[#666] leading-relaxed mb-6">{{ Str::limit($story->summary ?? strip_tags($story->content), 120) }}</p>
                    </div>
                    <a href="{{ route('user.information.show', $story) }}" class="text-xs font-semibold text-[#B84A29] hover:underline inline-flex items-center gap-1">
                        Baca cerita ↗
                    </a>
                </div>
            @empty
                <p class="text-sm text-[#777]">Belum ada informasi yang terbit.</p>
            @endforelse
        </div>
    </section>

    <!-- Testimonial Quote -->
    <section class="bg-[#F3EFE6] py-16 border-y border-[#ECE6DB]">
        <div class="max-w-7xl mx-auto px-6 lg:px-12 grid grid-cols-1 md:grid-cols-3 gap-10">
            <div>
                <p class="text-xs font-bold tracking-widest uppercase text-[#B84A29] mb-2">Suara keluarga kami</p>
                <h3 class="text-2xl font-bold text-[#141414] leading-snug">
                    Tumbuh bersama, bukan sendirian.
                </h3>
                <p class="text-xs text-[#666] mt-3">Kepercayaan keluarga adalah bagian terpenting dari perjalanan kami.</p>
            </div>
            <div>
                <p class="text-base font-semibold text-[#1F1F1F] leading-snug mb-4">
                    “Anak saya tidak lagi takut salah. Ia pulang membawa pertanyaan, cerita, dan keinginan untuk mencoba lagi.”
                </p>
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-full bg-[#E5D6C8] flex items-center justify-center font-bold text-xs text-[#5D4037]">RW</div>
                    <div class="text-xs">
                        <span class="font-bold block text-[#1D1D1D]">Ratna Wulandari</span>
                        <span class="text-[#777]">Orang tua murid SD · Kelas 4</span>
                    </div>
                </div>
            </div>
            <div>
                <p class="text-base font-semibold text-[#1F1F1F] leading-snug mb-4">
                    “Di sini, anak kami benar-benar dikenal. Guru melihat potensinya, bukan hanya angka di rapornya.”
                </p>
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-full bg-[#D1E0D7] flex items-center justify-center font-bold text-xs text-[#2E5A36]">BP</div>
                    <div class="text-xs">
                        <span class="font-bold block text-[#1D1D1D]">Bima Prasetyo</span>
                        <span class="text-[#777]">Orang tua murid TK · Kelompok B</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Bottom CTA Banner -->
    <section class="max-w-7xl mx-auto px-6 lg:px-12 py-20">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center mb-16">
            <div class="lg:col-span-8">
                <p class="text-xs font-bold tracking-widest uppercase text-[#B84A29] mb-2">Penerimaan murid baru 2027/2028</p>
                <h2 class="text-4xl font-bold text-[#141414] leading-tight">
                    Mari mulai cerita belajar yang berarti.
                </h2>
                <p class="text-sm text-[#666] mt-4 max-w-xl">
                    Kenali lingkungan, temui guru kami, dan rasakan pengalaman belajar di Sekolah Inspirasi. Kami siap menyambut keluarga Anda.
                </p>
            </div>
            <div class="lg:col-span-4 flex flex-col sm:flex-row lg:flex-col gap-3">
                <a href="{{ route('login') }}" class="px-6 py-3.5 bg-[#B84A29] hover:bg-[#A03D20] text-white text-center text-sm font-medium rounded-xl transition shadow-xs">
                    Jadwalkan kunjungan
                </a>
                <a href="{{ route('login') }}" class="px-6 py-3.5 bg-white border border-[#DDD7CD] text-center text-[#333] text-sm font-medium rounded-xl hover:border-[#B84A29] transition">
                    Hubungi tim penerimaan
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 pt-10 border-t border-[#ECE6DB]">
            <div>
                <span class="text-2xl font-bold text-[#B84A29] block mb-2">01</span>
                <h4 class="text-base font-bold text-[#141414] mb-2">Berkenalan</h4>
                <p class="text-xs text-[#666] leading-relaxed">Jadwalkan tur sekolah dan ceritakan kebutuhan keluarga Anda.</p>
            </div>
            <div>
                <span class="text-2xl font-bold text-[#B84A29] block mb-2">02</span>
                <h4 class="text-base font-bold text-[#141414] mb-2">Mencoba & menemukan</h4>
                <p class="text-xs text-[#666] leading-relaxed">Ikuti kelas percobaan dan diskusi bersama pendamping belajar.</p>
            </div>
            <div>
                <span class="text-2xl font-bold text-[#B84A29] block mb-2">03</span>
                <h4 class="text-base font-bold text-[#141414] mb-2">Mulai bertumbuh</h4>
                <p class="text-xs text-[#666] leading-relaxed">Lengkapi pendaftaran dan sambut perjalanan baru bersama kami.</p>
            </div>
        </div>
    </section>
</main>

<!-- Footer -->
<footer class="bg-[#2D3A32] text-white pt-16 pb-8 border-t border-[#3A4A41]">
    <div class="max-w-7xl mx-auto px-6 lg:px-12 grid grid-cols-1 md:grid-cols-12 gap-10 pb-12 border-b border-[#3D4F44]">
        <div class="md:col-span-5">
            <div class="flex items-center gap-3 mb-4">
                <div class="w-7 h-7 rounded-full bg-white"></div>
                <div class="leading-tight font-bold text-sm">
                    Sekolah<br><span class="font-normal opacity-90">Inspirasi</span>
                </div>
            </div>
            <p class="text-xs text-[#B4C4BC] mb-6">Tumbuh bersama. Menginspirasi dunia.</p>
            <div class="flex gap-4 text-xs text-[#C6D5CD]">
                <a href="#" class="hover:text-white">Instagram ↗</a>
                <a href="#" class="hover:text-white">YouTube ↗</a>
            </div>
        </div>

        <div class="md:col-span-4 text-xs text-[#B4C4BC] space-y-2">
            <h5 class="text-white font-bold text-sm mb-3">Mari berkunjung</h5>
            <p>Jl. Taman Inspirasi No. 12, Dago, Bandung, Jawa Barat 40135</p>
            <p>Senin–Jumat · 08.00–16.00 WIB</p>
        </div>

        <div class="md:col-span-3 text-xs text-[#B4C4BC] space-y-2">
            <h5 class="text-white font-bold text-sm mb-3">Ada yang ingin ditanyakan?</h5>
            <p>halo@sekolahinspirasi.sch.id</p>
            <p>WhatsApp: +62 812 3456 7890</p>
            <div class="pt-2">
                <a href="{{ route('login') }}" class="text-white font-semibold hover:underline">Masuk portal sekolah ↗</a>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-6 lg:px-12 pt-6 flex flex-col md:flex-row justify-between items-center text-xs text-[#8FA598]">
        <div>© 2026 Sekolah Inspirasi. Seluruh hak cipta dilindungi.</div>
        <div class="mt-2 md:mt-0">
            <a href="#" class="hover:underline">Kebijakan privasi</a>
        </div>
    </div>
</footer>
@endsection
