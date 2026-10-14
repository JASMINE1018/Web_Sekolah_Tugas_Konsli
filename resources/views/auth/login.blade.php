@extends('layouts.base')

@section('title', 'Masuk Portal Sekolah - Sekolah Inspirasi')

@section('content')
<div class="min-h-screen flex flex-col md:flex-row">
    <!-- Left Hero Banner -->
    <div class="md:w-5/12 bg-gradient-to-b from-[#6A7B72] to-[#3E4F47] text-white p-8 md:p-14 flex flex-col justify-between relative overflow-hidden">
        <!-- Logo -->
        <div class="flex items-center gap-3 relative z-10">
            <div class="w-7 h-7 rounded-full bg-[#E5E9E4]/90"></div>
            <span class="font-bold text-lg leading-tight tracking-tight">Sekolah<br><span class="font-normal opacity-90">Inspirasi</span></span>
        </div>

        <!-- Middle Quote / Headline -->
        <div class="my-16 md:my-auto relative z-10 max-w-md">
            <p class="text-xs uppercase tracking-widest text-[#B4C4BC] font-semibold mb-4">Terhubung, lalu bertumbuh.</p>
            <h1 class="text-4xl md:text-5xl font-bold leading-tight mb-6">
                Satu tempat untuk kabar yang berarti.
            </h1>
            <p class="text-[#D3DDD7] text-base leading-relaxed">
                Ikuti cerita belajar, agenda, dan pengumuman terbaru dari keluarga Sekolah Inspirasi.
            </p>
        </div>

        <!-- Footer Note -->
        <div class="text-xs text-[#A8BBB2] relative z-10">
            Sekolah Inspirasi · Bandung
        </div>
    </div>

    <!-- Right Login Form Section -->
    <div class="md:w-7/12 flex flex-col justify-between p-8 md:p-16 bg-[#F8F6F0]">
        <!-- Top Back Link -->
        <div class="flex justify-between items-center mb-10">
            <a href="{{ route('home') }}" class="inline-flex items-center gap-2 text-sm text-[#4A4A4A] hover:text-[#B84A29] transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Kembali ke beranda sekolah
            </a>
        </div>

        <!-- Main Form Container -->
        <div class="max-w-md w-full mx-auto my-auto">
            <p class="text-xs uppercase tracking-wider text-[#B84A29] font-bold mb-2">Portal Sekolah Inspirasi</p>
            <h2 class="text-3xl md:text-4xl font-bold text-[#1F1F1F] mb-2 tracking-tight">Selamat datang kembali.</h2>
            <p class="text-sm text-[#666666] mb-8">Masuk dengan akun sekolah Anda untuk melanjutkan.</p>

            @if ($errors->any())
                <div class="mb-6 p-4 rounded-xl bg-red-50 border border-red-200 text-red-800 text-sm">
                    {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ route('login.post') }}" method="POST" class="space-y-5">
                @csrf

                <div>
                    <label for="email" class="block text-sm font-semibold text-[#2D2D2D] mb-1.5">Alamat email *</label>
                    <input 
                        type="email" 
                        id="email" 
                        name="email" 
                        value="{{ old('email', 'admin@sekolahinspirasi.sch.id') }}" 
                        placeholder="nama@contoh.com"
                        required 
                        class="w-full px-4 py-3 bg-white border border-[#DDD7CD] rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#B84A29] focus:border-transparent transition"
                    >
                </div>

                <div>
                    <label for="password" class="block text-sm font-semibold text-[#2D2D2D] mb-1.5">Kata sandi *</label>
                    <input 
                        type="password" 
                        id="password" 
                        name="password" 
                        value="password"
                        placeholder="Masukkan kata sandi"
                        required 
                        class="w-full px-4 py-3 bg-white border border-[#DDD7CD] rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#B84A29] focus:border-transparent transition"
                    >
                </div>

                <div class="flex items-center justify-between text-sm">
                    <label class="flex items-center gap-2 cursor-pointer text-[#4D4D4D]">
                        <input type="checkbox" name="remember" class="w-4 h-4 rounded text-[#B84A29] border-[#DDD7CD] focus:ring-[#B84A29]">
                        <span>Ingat saya</span>
                    </label>
                    <a href="javascript:void(0)" onclick="alert('Silakan hubungi tim tata usaha sekolah untuk bantuan reset kata sandi.')" class="text-[#B84A29] font-medium hover:underline">
                        Lupa kata sandi?
                    </a>
                </div>

                <button 
                    type="submit" 
                    class="w-full py-3.5 px-4 bg-[#B84A29] hover:bg-[#A03D20] text-white font-medium text-sm rounded-xl transition shadow-sm"
                >
                    Masuk
                </button>
            </form>

            <!-- Hint box matching UI design -->
            <div class="mt-6 p-4 rounded-xl bg-[#E8EFE9] text-[#2F4A39] text-xs leading-relaxed">
                Akses mengikuti akun Anda. Admin diarahkan ke ringkasan pengelolaan; pengguna ke informasi sekolah. Tidak perlu memilih peran.
            </div>

            <!-- Demo account quick selector -->
            <div class="mt-4 p-3 bg-white border border-[#E3DDD4] rounded-xl text-xs text-[#555] space-y-1">
                <span class="font-semibold block text-[#333]">Akun Demo Bawaan:</span>
                <div class="flex gap-2">
                    <button type="button" onclick="setDemo('admin@sekolahinspirasi.sch.id', 'password')" class="px-2.5 py-1 bg-[#F4EFE6] rounded-md hover:bg-[#EAE2D5] font-medium text-[#222]">
                        Masuk sbg Admin
                    </button>
                    <button type="button" onclick="setDemo('ayu@sekolahinspirasi.sch.id', 'password')" class="px-2.5 py-1 bg-[#F4EFE6] rounded-md hover:bg-[#EAE2D5] font-medium text-[#222]">
                        Masuk sbg User
                    </button>
                </div>
            </div>

            <p class="mt-6 text-xs text-center text-[#7A7A7A]">
                Belum memiliki akun? Hubungi tata usaha melalui <a href="mailto:halo@sekolahinspirasi.sch.id" class="text-[#333] underline">halo@sekolahinspirasi.sch.id</a>.
            </p>
        </div>

        <!-- Footer Copyright -->
        <div class="mt-12 text-center md:text-left text-xs text-[#8A8A8A]">
            © 2026 Sekolah Inspirasi · Privasi akun Anda terlindungi.
        </div>
    </div>
</div>

<script>
    function setDemo(email, pass) {
        document.getElementById('email').value = email;
        document.getElementById('password').value = pass;
    }
</script>
@endsection
