<?php

namespace Database\Seeders;

use App\Models\Information;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Admin
        $admin = User::firstOrCreate(
            ['email' => 'admin@sekolahinspirasi.sch.id'],
            [
                'name' => 'Dina Pramesti',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ]
        );

        // Regular User
        $user = User::firstOrCreate(
            ['email' => 'ayu@sekolahinspirasi.sch.id'],
            [
                'name' => 'Olip',
                'password' => Hash::make('password'),
                'role' => 'user',
            ]
        );

        // Dummy data based on the UI reference
        $items = [
            [
                'title' => 'Belajar dari alam: cerita dari kebun sekolah',
                'summary' => 'Dari menanam benih hingga merawat kehidupan, siswa kelas 4 menemukan bahwa pelajaran terbaik juga tumbuh di luar ruang kelas.',
                'content' => "Pagi itu, kebun sekolah menjadi ruang kelas yang berbeda. Dengan sekop kecil, buku catatan, dan rasa ingin tahu yang besar, siswa kelas 4 memulai proyek \"Dari Benih ke Meja\". Mereka belajar mengenali tanah, memilih benih, dan memahami apa yang dibutuhkan tanaman untuk tumbuh.\n\n### Lebih dari sekadar menanam\n\nSelama empat minggu, setiap kelompok merawat satu petak kebun berisi bayam, kangkung, dan tomat. Anak-anak mengukur tinggi tanaman, mencatat perubahan daun, serta menyepakati jadwal menyiram. Matematika, sains, dan bahasa bertemu dalam pengalaman yang nyata.\n\nTidak semua benih tumbuh dengan cepat. Ada tanaman yang layu dan ada daun yang dimakan ulat. Bersama guru, anak-anak belajar mengamati penyebabnya, mencoba solusi baru, dan menerima bahwa proses belajar tidak selalu berjalan sesuai rencana.\n\n> \"Ketika anak merawat sesuatu, mereka juga belajar tentang tanggung jawab dan kepedulian.\"\n> — Nadia Rahma, Pendamping kelas 4\n\n### Dari kebun, untuk kehidupan\n\nSaat panen tiba, hasil kebun dibawa ke dapur belajar. Siswa menyiapkan salad sederhana dan berbagi cerita dengan teman-teman. Mereka menyadari bahwa makanan di meja melewati perjalanan panjang yang membutuhkan perhatian, kerja sama, dan kesabaran.\n\nKeluarga dapat melanjutkan pengalaman ini di rumah dengan menanam satu pot sayuran bersama anak. Beri mereka ruang untuk memilih, merawat, dan menceritakan perubahan yang mereka temukan. Karena rasa ingin tahu tumbuh ketika diberi kesempatan.",
                'category' => 'Kegiatan',
                'status' => 'Terbit',
                'created_by' => $admin->id,
                'created_at' => now()->subDays(6)->setTime(9, 0),
                'updated_at' => now()->subDays(6)->setTime(9, 0),
            ],
            [
                'title' => 'Penerimaan murid baru 2027/2028 dibuka',
                'summary' => 'Kenali program belajar kami dan temukan langkah awal menjadi bagian dari keluarga Sekolah Inspirasi.',
                'content' => "Sekolah Inspirasi kembali membuka pintu penerimaan murid baru untuk tahun ajaran 2027/2028 bagi jenjang Taman Kanak-kanak, Sekolah Dasar, dan Sekolah Menengah.\n\nKami mengundang para orang tua dan calon murid untuk hadir dalam rangkaian sesi observasi belajar terbuka, dialog kurikulum bersama para guru pendamping, serta tur lingkungan sekolah yang asri dan inklusif.\n\nInformasi pendaftaran lengkap, panduan seleksi observasi, dan jadwal beasiswa dapat diakses melalui portal admisi kami atau langsung menghubungi tim tata usaha sekolah.",
                'category' => 'Pengumuman',
                'status' => 'Terbit',
                'created_by' => $admin->id,
                'created_at' => now()->subDays(8)->setTime(8, 30),
                'updated_at' => now()->subDays(8)->setTime(8, 30),
            ],
            [
                'title' => 'Pekan karya: ide kecil, dampak besar',
                'summary' => 'Sebuah perayaan proses, kolaborasi, dan keberanian anak untuk membagikan ide kepada dunia.',
                'content' => "Pekan Karya Sekolah Inspirasi adalah puncak semester di mana setiap murid memamerkan hasil riset mini, karya seni interaktif, dan prototipe solusi sosial lingkungan yang telah mereka rancang.\n\nDi sini tidak ada kompetisi juara satu atau dua; setiap anak belajar mengomunikasikan gagasan mereka dengan bangga di hadapan teman, orang tua, dan warga sekitar.\n\nMari hadir dan beri apresiasi atas setiap proses belajar anak-anak hebat kita!",
                'category' => 'Kegiatan',
                'status' => 'Terbit',
                'created_by' => $admin->id,
                'created_at' => now()->subDays(11)->setTime(10, 15),
                'updated_at' => now()->subDays(11)->setTime(10, 15),
            ],
            [
                'title' => 'Membangun kebiasaan membaca di rumah',
                'summary' => 'Mulai dari sepuluh menit sehari: langkah sederhana untuk menumbuhkan kecintaan pada buku.',
                'content' => "Membaca bukan hanya tentang mengenali huruf, melainkan membangun imajinasi dan memperluas cakrawala berpikir anak.\n\nTips untuk orang tua:\n1. Sediakan pojok baca yang nyaman dan terang di rumah.\n2. Jadikan membaca sebelum tidur sebagai rutinitas yang menyenangkan, bukan kewajiban.\n3. Diskusikan karakter dan cerita, tanyakan perasaan anak tentang jalan ceritanya.\n\nKoleksi buku di perpustakaan sekolah juga terbuka untuk dipinjam oleh seluruh keluarga murid setiap hari Jumat.",
                'category' => 'Artikel',
                'status' => 'Terbit',
                'created_by' => $admin->id,
                'created_at' => now()->subDays(13)->setTime(13, 0),
                'updated_at' => now()->subDays(13)->setTime(13, 0),
            ],
            [
                'title' => 'Jadwal libur dan agenda tengah semester',
                'summary' => 'Catat tanggal penting dan agenda sekolah agar keluarga dapat merencanakan kegiatan bersama.',
                'content' => "Diberitahukan kepada seluruh orang tua dan wali murid mengenai kalender akademik bulan ini:\n\n- 15 - 19 Oktober: Penilaian Tengah Semester Terbuka\n- 20 - 24 Oktober: Jeda Tengah Semester (Libur Pembelajaran di Kelas)\n- 25 Oktober: Kegiatan Belajar Mengajar kembali efektif\n\nSelamat menikmati waktu berkualitas bersama keluarga di rumah.",
                'category' => 'Pengumuman',
                'status' => 'Terbit',
                'created_by' => $admin->id,
                'created_at' => now()->subDays(14)->setTime(14, 0),
                'updated_at' => now()->subDays(14)->setTime(14, 0),
            ],
            [
                'title' => 'Persiapan Open House November 2026',
                'summary' => 'Rencana kegiatan open house yang melibatkan paguyuban orang tua dan perwakilan siswa.',
                'content' => "Draf persiapan kegiatan Open House November 2026 sedang disempurnakan. Agenda ini dirancang untuk menyambut calon keluarga baru dan mempererat jejaring komunitas sekolah.\n\nDetail susunan panitia, rundown workshop interaktif, serta panduan pameran kelas akan segera dipublikasikan setelah disetujui dalam rapat pleno yayasan.",
                'category' => 'Kegiatan',
                'status' => 'Draf',
                'created_by' => $admin->id,
                'created_at' => now()->subDays(5)->setTime(15, 30),
                'updated_at' => now()->subDays(5)->setTime(15, 30),
            ],
        ];

        foreach ($items as $data) {
            Information::create($data);
        }
    }
}
