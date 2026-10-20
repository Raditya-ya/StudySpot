<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TempatBelajar;

class TempatBelajarSeeder extends Seeder
{
    public function run(): void
    {
        TempatBelajar::truncate();

        $data = [
            [
                'name' => 'Kopi Ruang Baca',
                'location' => 'Jl. Veteran',
                'distance' => '1,2 km dari kampus',
                'category' => 'Kafe',
                'tags' => ['8 kursi tersedia', 'Wi-Fi cepat', '⭐ 4,0 · 128 ulasan', 'Sedang'],
                'description' => 'Kafe baca yang nyaman untuk tugas individu maupun diskusi ringan, dengan meja luas, banyak colokan, dan pilihan kopi terjangkau mahasiswa.',
                'address' => 'Jl. Veteran No. 18',
                'image_url' => 'https://images.unsplash.com/photo-1554118811-1e0d58224f24?auto=format&fit=crop&w=1200&q=80',
                'status_text' => 'Buka sekarang • hingga 22.00',
                'available_seats' => 8,
                'total_seats' => 15,
                'noise_level' => 'Sedang - 52 dB',
                'wifi_speed' => 'Wi-Fi cepat - ±48 Mbps',
                'rating' => 4.0,
                'total_reviews' => 128,
                'facilities' => ['Banyak colokan', 'AC', 'Rak bacaan', 'Meja kelompok', 'Parkir sepeda', 'Akses ramah kursi roda'],
                'student_note' => 'Datang sebelum pukul 16.00 kalau ingin meja dekat jendela. Area belakang lebih tenang untuk panggilan kelompok.',
                'student_note_author' => 'Alya N. (Mahasiswa - 2 hari lalu)',
                'best_time' => 'Sebelum 16.00',
                'price_range' => 'Rp18-35 ribu',
                'suitable_for' => 'Fokus & diskusi ringan',
            ],
            [
                'name' => 'Perpustakaan Pusat',
                'location' => 'Kampus Utama',
                'distance' => '0,4 km dari kampus',
                'category' => 'Perpustakaan',
                'tags' => ['12 Jumlah Meja', 'Wi-Fi ⭐ 4.5', '22 Jumlah Kursi', 'Hening'],
                'description' => 'Perpustakaan utama kampus dengan pendingin ruangan, area tenang khusus tugas akhir, serta akses ke ribuan koleksi buku digital.',
                'address' => 'Gedung Rektorat Lt. 2, Kampus Utama',
                'image_url' => 'https://images.unsplash.com/photo-1521587760476-6c12a4b040da?auto=format&fit=crop&w=1200&q=80',
                'status_text' => 'Buka sekarang • hingga 20.00',
                'available_seats' => 12,
                'total_seats' => 50,
                'noise_level' => 'Sangat Hening - 35 dB',
                'wifi_speed' => 'Wi-Fi Kampus - ±100 Mbps',
                'rating' => 4.5,
                'total_reviews' => 210,
                'facilities' => ['Stop kontak di tiap meja', 'AC', 'Komputer riset', 'Area hening', 'Layanan cetak'],
                'student_note' => 'Ruang baca lantai 3 paling sepi. Bawa KTM untuk scan di pintu masuk.',
                'student_note_author' => 'Rizky P. (Mahasiswa - 1 hari lalu)',
                'best_time' => '09.00 - 11.00',
                'price_range' => 'Gratis',
                'suitable_for' => 'Fokus tinggi & Tugas Akhir',
            ],
            [
                'name' => 'Co-Work Sudut',
                'location' => 'Jl. Soekarno-Hatta',
                'distance' => '2 km dari kampus',
                'category' => 'Co-working',
                'tags' => ['14 Kursi kosong', 'Wi-Fi ⭐ 4.8', '22 Jumlah Kursi'],
                'description' => 'Ruang kerja bersama modern dengan fasilitas lengkap, free-flow minum, dan ruangan meeting tertutup untuk kolaborasi tim.',
                'address' => 'Jl. Soekarno-Hatta No. 45',
                'image_url' => 'https://images.unsplash.com/photo-1497366216548-37526070297c?auto=format&fit=crop&w=1200&q=80',
                'status_text' => 'Buka sekarang • hingga 23.00',
                'available_seats' => 14,
                'total_seats' => 30,
                'noise_level' => 'Kondusif - 45 dB',
                'wifi_speed' => 'Ultra Fast - ±150 Mbps',
                'rating' => 4.8,
                'total_reviews' => 85,
                'facilities' => ['Free Flow Coffee', 'AC Dedicated', 'Proyektor', 'Private Booth', 'Sewa Loker'],
                'student_note' => 'Sangat direkomendasikan kalau butuh koneksi super kencang buat upload/download file besar.',
                'student_note_author' => 'Bagas K. (Mahasiswa - 3 hari lalu)',
                'best_time' => '13.00 - 17.00',
                'price_range' => 'Rp25-50 ribu',
                'suitable_for' => 'Koding & Meeting Kelompok',
            ],
        ];

        foreach ($data as $item) {
            TempatBelajar::create($item);
        }
    }
}