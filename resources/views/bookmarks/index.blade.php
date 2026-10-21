<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tempat Tersimpan - StudySpot</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: hsl(245, 75%, 60%);
            --primary-light: hsl(245, 75%, 95%);
            --bg-body: hsl(0, 0%, 98%);
            --bg-card: hsl(0, 0%, 100%);
            --text-main: hsl(0, 0%, 12%);
            --text-muted: hsl(0, 0%, 48%);
            --border-light: hsl(0, 0%, 92%);
        }

        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Inter', sans-serif; }
        body { background-color: var(--bg-body); color: var(--text-main); display: flex; min-height: 100vh; }

        /* Sidebar Styling */
        .sidebar { width: 250px; background-color: var(--bg-card); padding: 30px 20px; border-right: 1px solid var(--border-light); flex-shrink: 0; }
        .logo { font-size: 22px; font-weight: 700; color: var(--primary); margin-bottom: 40px; display: block; text-decoration: none; }
        .menu-list { display: flex; flex-direction: column; gap: 8px; }
        .menu-item { padding: 12px 16px; text-decoration: none; color: var(--text-muted); font-weight: 500; font-size: 14px; border-radius: 8px; transition: 0.2s; display: block; }
        .menu-item:hover { background-color: var(--bg-body); color: var(--primary); }
        .menu-item.active { background-color: var(--primary); color: white; font-weight: 600; }

        /* Main Content */
        .main-content { flex: 1; padding: 40px 50px; overflow-y: auto; }
        .card-wrapper { background: var(--bg-card); border-radius: 16px; padding: 24px; border: 1px solid var(--border-light); }
        
        .section-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
        .section-title { font-size: 16px; font-weight: 700; color: var(--text-main); }
        .see-all { font-size: 12px; color: var(--text-muted); text-decoration: none; }

        /* Bookmark Cards Grid */
        .grid-bookmarks { display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 20px; }
        .bookmark-card { background: white; border-radius: 12px; border: 1px solid var(--border-light); overflow: hidden; display: flex; flex-direction: column; }
        
        .thumb-box { width: 100%; height: 150px; background-color: #cbd5e1; }
        .thumb-box img { width: 100%; height: 100%; object-fit: cover; }
        
        .card-body { padding: 16px; flex-grow: 1; display: flex; flex-direction: column; justify-content: space-between; }
        .place-name { font-size: 14px; font-weight: 700; margin-bottom: 4px; color: var(--text-main); }
        .place-sub { font-size: 12px; color: var(--text-muted); margin-bottom: 16px; }

        .btn-detail { display: block; width: 100%; text-align: center; padding: 10px; background-color: var(--primary-light); color: var(--primary); font-size: 12px; font-weight: 600; border-radius: 8px; text-decoration: none; transition: 0.2s; }
        .btn-detail:hover { background-color: #e0e7ff; }
        .empty-state { text-align: center; color: var(--text-muted); padding: 40px; font-size: 14px; grid-column: 1 / -1; }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <aside class="sidebar">
        <a href="{{ route('dashboard') }}" class="logo">StudySpot</a>
        <nav class="menu-list">
            <a href="{{ route('dashboard') }}" class="menu-item">Dashboard</a>
            
            @if(auth()->user()->role === 'admin')
                <a href="{{ route('admin.places.index') }}" class="menu-item">Data Tempat</a>
                <a href="#" class="menu-item">Fasilitas</a>
            @endif

            <a href="{{ route('bookmarks.index') }}" class="menu-item active">Tempat Tersimpan</a>
            <a href="#" class="menu-item">Laporan</a>
            <a href="{{ route('profile.edit') }}" class="menu-item">Pengaturan / Profil</a>
            
            <form action="{{ route('logout') }}" method="POST" style="margin-top: 20px;">
                @csrf
                <button type="submit" class="menu-item" style="width: 100%; text-align: left; background: none; border: none; cursor: pointer; padding: 12px 16px;">Logout</button>
            </form>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="main-content">
        <div class="card-wrapper">
            <div class="section-header">
                <h1 class="section-title">Tempat tersimpan favorit</h1>
                <a href="#" class="see-all">Lihat semua</a>
            </div>

            <div class="grid-bookmarks">
                @forelse($places as $place)
                    <div class="bookmark-card">
                        <div class="thumb-box">
                            @if($place->image_url)
                                <img src="{{ $place->image_url }}" alt="{{ $place->name }}">
                            @endif
                        </div>
                        <div class="card-body">
                            <div>
                                <div class="place-name">{{ $place->name }}</div>
                                <div class="place-sub">{{ $place->location }} · {{ $place->rating ?? '4.5' }}</div>
                            </div>
                            <a href="{{ route('places.show', $place->id) }}" class="btn-detail">Buka Rincian</a>
                        </div>
                    </div>
                @empty
                    <div class="empty-state">
                        Belum ada tempat belajar favorit yang disimpan.
                    </div>
                @endforelse
            </div>
        </div>
    </main>

</body>
</html>