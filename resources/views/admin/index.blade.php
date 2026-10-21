<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Tempat Belajar - Admin StudySpot</title>
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

        /* Main Content Styling */
        .main-content { flex-grow: 1; padding: 40px; overflow-y: auto; background-color: #ffffff; }
        
        .header { display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 24px; }
        .header h1 { font-size: 24px; font-weight: 700; margin-bottom: 4px; }
        .header p { color: var(--text-muted); font-size: 14px; }
        
        .btn-add { background-color: var(--primary); color: white; padding: 10px 20px; border-radius: 20px; text-decoration: none; font-size: 14px; font-weight: 600; display: inline-flex; align-items: center; gap: 8px; }
        .btn-add:hover { background-color: #4338ca; }

        /* Search Bar */
        .search-container { position: relative; margin-bottom: 30px; max-width: 100%; }
        .search-icon { position: absolute; left: 16px; top: 50%; transform: translateY(-50%); color: var(--text-muted); }
        .search-input { width: 100%; padding: 12px 16px 12px 48px; border: 1px solid var(--border); border-radius: 8px; font-size: 14px; outline: none; transition: 0.2s; }
        .search-input:focus { border-color: var(--primary); box-shadow: 0 0 0 3px var(--primary-light); }

        /* Table Styling */
        table { width: 100%; border-collapse: collapse; margin-bottom: 40px; }
        th { text-align: left; padding: 16px; border-bottom: 1px solid var(--border); font-size: 13px; color: var(--text-main); font-weight: 700; }
        td { padding: 16px; border-bottom: 1px solid var(--border); font-size: 14px; color: var(--text-muted); }
        td strong { color: var(--text-main); font-weight: 600; }
        
        .action-icons { display: flex; gap: 16px; align-items: center; }
        .icon-btn { background: none; border: none; cursor: pointer; color: var(--text-muted); transition: 0.2s; display: inline-flex; }
        .icon-edit:hover { color: #f59e0b; }
        .icon-delete:hover { color: #ef4444; }

        .alert { padding: 12px 16px; background-color: #d1fae5; color: #065f46; border-radius: 8px; margin-bottom: 24px; font-size: 14px; }
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
        
        @if(session('success'))
            <div class="alert">{{ session('success') }}</div>
        @endif

        <div class="header">
            <div>
                <h1>Data Tempat Belajar</h1>
                <p>Kelola informasi tempat, fasilitas, dan ketersediaan</p>
            </div>
            <a href="{{ route('admin.places.create') }}" class="btn-add">
                + Tambah tempat
            </a>
        </div>

        <div class="search-container">
            <svg class="search-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
            <input type="text" class="search-input" placeholder="Cari tempat...">
        </div>

        <table>
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Kursi</th>
                    <th>Jam buka</th>
                    <th>Kebisingan</th>
                    <th>Wi-Fi</th>
                    <th>Fasilitas</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($places as $place)
                    <tr>
                        <td><strong>{{ $place->name }}</strong></td>
                        <td>{{ $place->available_seats }} / {{ $place->total_seats }}</td>
                        <td>{{ explode(' • ', $place->status_text)[0] ?? 'Buka' }}</td>
                        <td>{{ explode(' - ', $place->noise_level)[0] ?? 'Sedang' }}</td>
                        <td>{{ explode(' - ', $place->wifi_speed)[0] ?? '4,0' }}</td>
                        <td>{{ is_array($place->facilities) ? count($place->facilities) : 0 }}</td>
                        <td>
                            <div class="action-icons">
                                <!-- Tombol Edit -->
                                <a href="{{ route('admin.places.edit', $place->id) }}" class="icon-btn icon-edit" title="Edit">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                                </a>
                                <!-- Tombol Hapus -->
                                <form action="{{ route('admin.places.destroy', $place->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus {{ $place->name }}?')" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="icon-btn icon-delete" title="Hapus">
                                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" style="text-align: center;">Belum ada tempat belajar yang didaftarkan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

    </main>

</body>
</html>