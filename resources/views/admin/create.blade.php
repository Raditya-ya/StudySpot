<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Tempat Belajar - Admin StudySpot</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #4f46e5;
            --primary-light: #eef2ff;
            --text-main: #1f2937;
            --text-muted: #6b7280;
            --border: #e5e7eb;
            --bg-body: #f9fafb;
            --bg-sidebar: #ffffff;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Inter', sans-serif; }
        body { display: flex; min-height: 100vh; background-color: var(--bg-body); color: var(--text-main); }

        /* Sidebar Styling */
        .sidebar { width: 260px; background-color: var(--bg-sidebar); border-right: 1px solid var(--border); padding: 24px 0; display: flex; flex-direction: column; flex-shrink: 0; }
        .sidebar-brand { display: flex; align-items: center; gap: 12px; padding: 0 24px; margin-bottom: 40px; }
        .sidebar-brand img { height: 40px; border-radius: 8px; object-fit: cover; }
        
        .sidebar-menu { display: flex; flex-direction: column; gap: 8px; padding: 0 16px; }
        .menu-item { padding: 12px 16px; border-radius: 8px; text-decoration: none; color: var(--text-muted); font-size: 14px; font-weight: 500; display: flex; align-items: center; gap: 12px; transition: 0.2s; }
        .menu-item:hover { background-color: #f3f4f6; color: var(--text-main); }
        .menu-item.active { background-color: var(--primary-light); color: var(--primary); font-weight: 600; }

        /* Main Content */
        .main-content { flex-grow: 1; padding: 40px; overflow-y: auto; background-color: #ffffff; }
        
        .header { margin-bottom: 24px; }
        .header h1 { font-size: 24px; font-weight: 700; margin-bottom: 4px; }
        .header p { color: var(--text-muted); font-size: 14px; }

        .card-form { background: white; border: 1px solid var(--border); border-radius: 16px; padding: 32px; max-width: 920px; box-shadow: 0 4px 15px rgba(0,0,0,0.02); }
        
        .section-title { font-size: 15px; font-weight: 700; margin: 24px 0 16px; color: var(--text-main); border-bottom: 1px solid var(--border); padding-bottom: 8px; }
        .section-title:first-child { margin-top: 0; }

        .form-row { display: flex; gap: 16px; margin-bottom: 16px; }
        .form-grid-3 { display: grid; grid-template-columns: repeat(3, 1fr); gap: 16px; margin-bottom: 16px; }
        @media (max-width: 768px) { .form-grid-3 { grid-template-columns: 1fr; } .form-row { flex-direction: column; } }

        .form-group { flex: 1; display: flex; flex-direction: column; gap: 6px; }
        .form-group.full { width: 100%; margin-bottom: 16px; }
        
        label { font-size: 12px; font-weight: 600; color: #64748b; }
        input, select, textarea { width: 100%; padding: 10px 14px; border: 1px solid var(--border); border-radius: 8px; font-size: 14px; outline: none; transition: 0.2s; background-color: #f8fafc; }
        input:focus, select:focus, textarea:focus { border-color: var(--primary); box-shadow: 0 0 0 3px var(--primary-light); background-color: #fff; }
        textarea { resize: vertical; min-height: 90px; }

        /* Facilities Grid (3 Columns) */
        .facility-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 24px; margin-top: 12px; }
        @media (max-width: 768px) { .facility-grid { grid-template-columns: 1fr; } }

        .facility-col-title { font-size: 13px; font-weight: 700; margin-bottom: 12px; color: var(--text-main); }
        .checkbox-list { display: flex; flex-direction: column; gap: 10px; }
        .checkbox-item { display: flex; align-items: center; gap: 10px; font-size: 13px; color: #475569; cursor: pointer; user-select: none; }
        .checkbox-item input[type="checkbox"] { width: 18px; height: 18px; accent-color: var(--primary); cursor: pointer; border-radius: 4px; }

        .btn-container { display: flex; justify-content: flex-end; gap: 12px; margin-top: 32px; }
        .btn { padding: 10px 20px; border-radius: 8px; font-size: 14px; font-weight: 600; cursor: pointer; text-decoration: none; border: none; display: inline-flex; align-items: center; justify-content: center; transition: 0.2s; }
        .btn-secondary { background-color: #f3f4f6; color: var(--text-muted); }
        .btn-secondary:hover { background-color: #e5e7eb; }
        .btn-primary { background-color: var(--primary); color: white; border-radius: 20px; padding: 12px 28px; }
        .btn-primary:hover { background-color: #4338ca; }

        .text-danger { color: #ef4444; font-size: 12px; margin-top: 4px; }
    </style>
</head>
<body>

    <!-- Sidebar Admin -->
    <aside class="sidebar">
        <a href="{{ route('dashboard') }}" class="sidebar-brand">
            <img src="https://i.pinimg.com/736x/3e/b8/b0/3eb8b071563a9ad95f3357976ec32b46.jpg" alt="StudySpot Logo">
        </a>
        <nav class="sidebar-menu">
            <a href="{{ route('admin.places.index') }}" class="menu-item active">Data Tempat</a>
            <a href="#" class="menu-item">Laporan</a>
            <a href="{{ route('dashboard') }}" class="menu-item" style="margin-top: 20px;">← Kembali ke Web</a>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="main-content">
        <div class="header">
            <h1>Tambah Tempat Belajar Baru</h1>
            <p>Isi informasi detail operasional, lokasi, dan fasilitas tempat belajar baru</p>
        </div>

        <div class="card-form">
            <form action="{{ route('admin.places.store') }}" method="POST">
                @csrf

                <!-- Informasi Utama -->
                <div class="section-title">Informasi Utama</div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="name">Nama Tempat *</label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="Contoh: Perpustakaan Pusat" required>
                        @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="category">Kategori *</label>
                        <select id="category" name="category" required>
                            <option value="">-- Pilih Kategori --</option>
                            <option value="Kafe" {{ old('category') == 'Kafe' ? 'selected' : '' }}>Kafe</option>
                            <option value="Perpustakaan" {{ old('category') == 'Perpustakaan' ? 'selected' : '' }}>Perpustakaan</option>
                            <option value="Co-Working Space" {{ old('category') == 'Co-Working Space' ? 'selected' : '' }}>Co-Working Space</option>
                            <option value="Ruang Terbuka" {{ old('category') == 'Ruang Terbuka' ? 'selected' : '' }}>Ruang Terbuka</option>
                        </select>
                        @error('category') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- Kondisi & Operasional Tempat (Grid 3 Kolom) -->
                <div class="section-title">Kondisi & Operasional Tempat</div>

                <div class="form-grid-3">
                    <div class="form-group">
                        <label for="available_seats">Kursi tersedia</label>
                        <input type="number" id="available_seats" name="available_seats" value="{{ old('available_seats', 30) }}" placeholder="30">
                        @error('available_seats') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label for="noise_level">Tingkat kebisingan</label>
                        <select id="noise_level" name="noise_level">
                            <option value="Rendah" {{ old('noise_level') == 'Rendah' ? 'selected' : '' }}>Rendah</option>
                            <option value="Sedang" {{ old('noise_level') == 'Sedang' ? 'selected' : '' }}>Sedang</option>
                            <option value="Tinggi" {{ old('noise_level') == 'Tinggi' ? 'selected' : '' }}>Tinggi</option>
                        </select>
                        @error('noise_level') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label for="wifi_speed">Kualitas Wi-Fi</label>
                        <select id="wifi_speed" name="wifi_speed">
                            <option value="4,5" {{ old('wifi_speed') == '4,5' ? 'selected' : '' }}>4,5</option>
                            <option value="Cepat" {{ old('wifi_speed') == 'Cepat' ? 'selected' : '' }}>Cepat</option>
                            <option value="Sangat Cepat" {{ old('wifi_speed') == 'Sangat Cepat' ? 'selected' : '' }}>Sangat Cepat</option>
                        </select>
                        @error('wifi_speed') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="form-grid-3">
                    <div class="form-group">
                        <label for="opening_time">Jam buka</label>
                        <input type="text" id="opening_time" name="opening_time" value="{{ old('opening_time', '08.00') }}" placeholder="08.00">
                        @error('opening_time') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label for="closing_time">Jam tutup</label>
                        <input type="text" id="closing_time" name="closing_time" value="{{ old('closing_time', '22.00') }}" placeholder="22.00">
                        @error('closing_time') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label for="location">Lokasi / Area *</label>
                        <input type="text" id="location" name="location" value="{{ old('location') }}" placeholder="Contoh: Kampus Utama" required>
                        @error('location') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- Detail Lokasi Tambahan -->
                <div class="form-row">
                    <div class="form-group">
                        <label for="distance">Jarak dari Kampus *</label>
                        <input type="text" id="distance" name="distance" value="{{ old('distance') }}" placeholder="Contoh: 500m / 5 menit" required>
                        @error('distance') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="image_url">URL Foto Sampul (Gambar)</label>
                        <input type="url" id="image_url" name="image_url" value="{{ old('image_url') }}" placeholder="https://...">
                        @error('image_url') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="form-group full">
                    <label for="address">Alamat Lengkap</label>
                    <input type="text" id="address" name="address" value="{{ old('address') }}" placeholder="Jl. Veteran No. 1, Malang">
                    @error('address') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="form-group full">
                    <label for="description">Deskripsi Singkat Tempat</label>
                    <textarea id="description" name="description" placeholder="Jelaskan suasana dan keunggulan tempat belajar ini...">{{ old('description') }}</textarea>
                    @error('description') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <!-- Fasilitas Tempat (3 Kelompok Checkbox) -->
                @php
                    $selectedFacilities = old('facilities', []);
                @endphp

                <div class="section-title">Fasilitas tempat</div>

                <div class="facility-grid">
                    <!-- Kolom 1: Fasilitas Penunjang -->
                    <div>
                        <div class="facility-col-title">Fasilitas penunjang</div>
                        <div class="checkbox-list">
                            @foreach(['Wifi gratis', 'Stop kontak', 'Ruangan indoor', 'Ruangan outdoor', 'Kursi dan meja'] as $item)
                                <label class="checkbox-item">
                                    <input type="checkbox" name="facilities[]" value="{{ $item }}" {{ in_array($item, $selectedFacilities) ? 'checked' : '' }}>
                                    {{ $item }}
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <!-- Kolom 2: Fasilitas Umum -->
                    <div>
                        <div class="facility-col-title">Fasilitas umum</div>
                        <div class="checkbox-list">
                            @foreach(['Toilet', 'Mushola', 'Parkir'] as $item)
                                <label class="checkbox-item">
                                    <input type="checkbox" name="facilities[]" value="{{ $item }}" {{ in_array($item, $selectedFacilities) ? 'checked' : '' }}>
                                    {{ $item }}
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <!-- Kolom 3: Fasilitas Tambahan -->
                    <div>
                        <div class="facility-col-title">Fasilitas tambahan</div>
                        <div class="checkbox-list">
                            @foreach(['Smoking area indoor', 'Smoking area outdoor', 'Spot foto', 'Live musik'] as $item)
                                <label class="checkbox-item">
                                    <input type="checkbox" name="facilities[]" value="{{ $item }}" {{ in_array($item, $selectedFacilities) ? 'checked' : '' }}>
                                    {{ $item }}
                                </label>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="btn-container">
                    <a href="{{ route('admin.places.index') }}" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-primary">Tambah Tempat</button>
                </div>
            </form>
        </div>
    </main>

</body>
</html>