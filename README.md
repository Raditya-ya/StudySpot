<p align="center">
  <h1 align="center">🎓 StudySpot</h1>
  <p align="center">
    <strong>Platform Pencarian & Review Tempat Belajar Kondusif untuk Mahasiswa</strong>
  </p>
</p>

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-12.70.0-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel">
  <img src="https://img.shields.io/badge/PHP-8.2.12-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="PHP">
  <img src="https://img.shields.io/badge/MariaDB-003545?style=for-the-badge&logo=mariadb&logoColor=white" alt="MariaDB">
  <img src="https://img.shields.io/badge/Status-Progress%201%20Completed-success?style=for-the-badge" alt="Status">
</p>

---

## 📌 Tentang StudySpot

**StudySpot** adalah aplikasi berbasis web yang dirancang untuk membantu mahasiswa menemukan, memfilter, dan meninjau lokasi belajar terbaik di sekitar kampus. Sistem ini menyediakan informasi *real-time* mengenai ketersediaan kursi, kualitas Wi-Fi, tingkat kebisingan, jam operasional, rincian fasilitas, serta catatan pengalaman dari mahasiswa lain.

---

## ✨ Fitur Utama

### 👤 Pengguna & Mahasiswa
- **Autentikasi Multi-Role:** Sistem Login, Registrasi, dan pengelolaan Profil terpisah untuk peran *Mahasiswa (User)* dan *Admin*.
- **Eksplorasi & Filter Tempat:** Pencarian tempat belajar berdasarkan nama atau lokasi, dilengkapi filter kategori (*Perpustakaan*, *Kafe*, *Co-working*, dan *Buka sekarang*).
- **Detail Tempat Belajar Dinamis:** Menampilkan status jam buka/tutup, jumlah kursi tersedia, kualitas Wi-Fi, tingkat kebisingan, daftar fasilitas lengkap beserta ikon, serta integrasi rute langsung ke Google Maps.
- **💡 Catatan Mahasiswa Real-Time:** Mahasiswa dapat menulis, membaca, dan menghapus catatan atau tips tempat belajar (seperti posisi stop kontak dan suasana ruangan) secara langsung pada halaman detail.
- **🔖 Simpan Tempat Favorit (Bookmark):** Pengguna dapat menyimpan atau menghapus tempat belajar favorit secara *toggle* dan mengakses daftar simpanannya di halaman khusus.

### 🛡️ Panel Administrator
- **Dashboard Manajemen Tempat:** Mengelola seluruh data tempat belajar secara penuh (*Create, Read, Update, Delete*) beserta pintasan edit langsung dari halaman detail.
- **Form Kondisi & Operasional Terstruktur:** Pengaturan kapasitas kursi tersedia, tingkat kebisingan, kualitas Wi-Fi, serta jam buka dan jam tutup (`opening_time` & `closing_time`).
- **Pengelompokan Fasilitas 3 Kategori:** Pemilihan fasilitas dinamis yang terbagi menjadi *Fasilitas Penunjang*, *Fasilitas Umum*, dan *Fasilitas Tambahan*.

---

## 🛠️ Teknologi & Tools

| Komponen | Teknologi |
| :--- | :--- |
| **Framework Backend** | Laravel 12.70.0 |
| **Bahasa Pemrograman** | PHP 8.2.12 |
| **Database** | MariaDB / MySQL |
| **Frontend UI** | Blade Template Engine, CSS Custom, Google Fonts (Inter) |
| **Version Control** | Git & GitHub |

---

## 🗄️ Struktur Tabel Database

| Tabel | Fungsi Utama |
| :--- | :--- |
| `users` | Menyimpan data akun pengguna serta pembagian hak akses (`user` / `admin`). |
| `tempat_belajars` | Menyimpan profil lokasi, jam operasional, kapasitas kursi, Wi-Fi, kebisingan, dan array fasilitas. |
| `student_notes` | Menyimpan catatan dan ulasan mahasiswa yang berelasi dengan `users` dan `tempat_belajars`. |
| `bookmarks` | Menyimpan relasi tempat belajar favorit yang ditandai oleh masing-masing pengguna. |

---

## 🚀 Langkah Instalasi & Menjalankan Proyek

Ikuti panduan berikut untuk menjalankan proyek ini secara lokal di komputer kamu:

1. **Kloning Repositori**
   ```bash
   git clone [https://github.com/username-kamu/StudySpot.git](https://github.com/username-kamu/StudySpot.git)
   cd StudySpot
