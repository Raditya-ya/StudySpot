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
        .sidebar-brand { display: flex; align-items: center; gap: 12px; padding: 0 24px; margin-bottom: 40px; font-weight: 700; font-size: 18px; color: var(--text-main); }
        .brand-icon { background-color: var(--primary-light); color: var(--primary); width: 32px; height: 32px; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 16px; }
        
        .sidebar-menu { display: flex; flex-direction: column; gap: 8px; padding: 0 16px; }
        .menu-item { padding: 12px 16px; border-radius: 8px; text-decoration: none; color: var(--text-muted); font-size: 14px; font-weight: 500; display: flex; align-items: center; gap: 12px; transition: 0.2s; }
        .menu-item:hover { background-color: #f3f4f6; color: var(--text-main); }
        .menu-item.active { background-color: var(--primary-light); color: var(--primary); font-weight: 600; }

        /* Main Content */
        .main-content { flex-grow: 1; padding: 40px; overflow-y: auto; background-color: #ffffff; }
        
        .header { margin-bottom: 24px; }
        .header h1 { font-size: 24px; font-weight: 700; margin-bottom: 4px; }
        .header p { color: var(--text-muted); font-size: 14px; }

        .card-form { background: white; border: 1px solid var(--border); border-radius: 12px; padding: 24px; max-width: 800px; }
        
        .form-row { display: flex; gap: 16px; margin-bottom: 16px; }
        .form-group { flex: 1; display: flex; flex-direction: column; gap: 6px; }
        .form-group.full { width: 100%; margin-bottom: 16px; }
        
        label { font-size: 13px; font-weight: 600; color: var(--text-main); }
        input, select, textarea { width: 100%; padding: 10px 14px; border: 1px solid var(--border); border-radius: 8px; font-size: 14px; outline: none; transition: 0.2s; }
        input:focus, select:focus, textarea:focus { border-color: var(--primary); box-shadow: 0 0 0 3px var(--primary-light); }
        textarea { resize: vertical; min-height: 90px; }

        .btn-container { display: flex; justify-content: flex-end; gap: 12px; margin-top: 24px; }
        .btn { padding: 10px 20px; border-radius: 8px; font-size: 14px; font-weight: 600; cursor: pointer; text-decoration: none; border: none; display: inline-flex; align-items: center; justify-content: center; }
        .btn-secondary { background-color: #f3f4f6; color: var(--text-muted); }
        .btn-secondary:hover { background-color: #e5e7eb; }
        .btn-primary { background-color: var(--primary); color: white; }
        .btn-primary:hover { background-color: #4338ca; }

        .text-danger { color: #ef4444; font-size: 12px; margin-top: 4px; }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="sidebar-brand">
            <div class="brand-icon">📚</div>
            Admin
        </div>
        <nav class="sidebar-menu">
            <a href="{{ route('admin.places.index') }}" class="menu-item active">Data Tempat</a>
            <a href="#" class="menu-item">Laporan</a>
            <a href="{{ route('dashboard') }}" class="menu-item" style="margin-top: 20px;">← Kembali ke Web</a>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="main-content">
        <div class="header">
            <h1>Tambah Tempat Belajar</h1>
            <p>Isi formulir di bawah ini untuk menambahkan lokasi studi baru ke aplikasi</p>
        </div>

        <div class="card-form">
            <form action="{{ route('admin.places.store') }}" method="POST">
                @csrf

                <div class="form-row">
                    <div class="form-group">
                        <label for="name">Nama Tempat *</label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="Contoh: Kopi Ruang Baca" required>
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

                <div class="form-row">
                    <div class="form-group">
                        <label for="location">Lokasi / Area *</label>
                        <input type="text" id="location" name="location" value="{{ old('location') }}" placeholder="Contoh: Jl. Soekarno Hatta / Suhat" required>
                        @error('location') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="distance">Jarak dari Kampus *</label>
                        <input type="text" id="distance" name="distance" value="{{ old('distance') }}" placeholder="Contoh: 500m dari Veteran" required>
                        @error('distance') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="form-group full">
                    <label for="image_url">URL Foto Sampul (Gambar)</label>
                    <input type="url" id="image_url" name="image_url" value="{{ old('image_url') }}" placeholder="https://images.unsplash.com/photo-...">
                    @error('image_url') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="form-group full">
                    <label for="address">Alamat Lengkap</label>
                    <input type="text" id="address" name="address" value="{{ old('address') }}" placeholder="Jl. Terusan Soekarno Hatta No. 1">
                    @error('address') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="form-group full">
                    <label for="description">Deskripsi Singkat Tempat</label>
                    <textarea id="description" name="description" placeholder="Jelaskan suasana tempat, jumlah stopkontak, keheningan, dll...">{{ old('description') }}</textarea>
                    @error('description') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="btn-container">
                    <a href="{{ route('admin.places.index') }}" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-primary">Simpan Tempat</button>
                </div>
            </form>
        </div>
    </main>

</body>
</html>