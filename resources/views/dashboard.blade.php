<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - StudySpot</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            /* HSL Color Palette */
            --primary: hsl(245, 75%, 60%);
            --primary-hover: hsl(245, 75%, 50%);
            --bg-body: hsl(0, 0%, 98%);
            --bg-card: hsl(0, 0%, 100%);
            --text-main: hsl(0, 0%, 10%);
            --text-muted: hsl(0, 0%, 45%);
            --border-light: hsl(0, 0%, 90%);
            
            /* Tag Colors */
            --tag-green-bg: hsl(140, 60%, 92%);
            --tag-green-text: hsl(140, 60%, 35%);
            --tag-blue-bg: hsl(220, 80%, 94%);
            --tag-blue-text: hsl(220, 70%, 45%);
            --tag-yellow-bg: hsl(40, 80%, 90%);
            --tag-yellow-text: hsl(40, 80%, 35%);
            --tag-red-bg: hsl(0, 80%, 94%);
            --tag-red-text: hsl(0, 70%, 45%);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }

        body {
            background-color: var(--bg-body);
            color: var(--text-main);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* --- Navbar --- */
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 16px 5%;
            background-color: var(--bg-card);
            border-bottom: 1px solid var(--border-light);
        }

        .nav-left {
            display: flex;
            align-items: center;
            gap: 40px;
        }

        .logo {
            display: flex;
            align-items: center;
            text-decoration: none;
        }

        .nav-links {
            display: flex;
            gap: 24px;
        }

        .nav-links a {
            text-decoration: none;
            color: var(--text-muted);
            font-size: 14px;
            font-weight: 500;
            padding-bottom: 4px;
        }

        .nav-links a.active {
            color: var(--primary);
            border-bottom: 2px solid var(--primary);
        }

        /* --- Main Content --- */
        .container {
            padding: 40px 5%;
            flex-grow: 1;
        }

        /* --- Header & Search --- */
        .header-section h1 {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .header-section p {
            color: var(--text-muted);
            font-size: 15px;
            margin-bottom: 24px;
        }

        .search-container {
            position: relative;
            max-width: 600px;
            margin-bottom: 24px;
        }

        .search-input {
            width: 100%;
            padding: 14px 20px 14px 45px;
            border: 1px solid var(--border-light);
            border-radius: 50px;
            font-size: 14px;
            outline: none;
            box-shadow: 0 2px 10px rgba(0,0,0,0.02);
        }

        .search-icon {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-muted);
        }

        .btn-search {
            position: absolute;
            right: 6px;
            top: 6px;
            bottom: 6px;
            background-color: var(--primary);
            color: white;
            border: none;
            border-radius: 40px;
            padding: 0 24px;
            font-weight: 500;
            cursor: pointer;
            transition: 0.3s;
        }

        .btn-search:hover {
            background-color: var(--primary-hover);
        }

        /* --- Filter Pills --- */
        .filters {
            display: flex;
            gap: 12px;
            margin-bottom: 32px;
            flex-wrap: wrap;
        }

        .filter-pill {
            padding: 8px 20px;
            background-color: var(--bg-card);
            border: 1px solid var(--border-light);
            border-radius: 40px;
            font-size: 13px;
            font-weight: 500;
            color: var(--text-muted);
            cursor: pointer;
            transition: 0.2s;
            text-decoration: none;
            display: inline-block;
        }

        .filter-pill:hover {
            border-color: var(--text-muted);
        }

        .filter-pill.active {
            background-color: var(--primary);
            color: white;
            border-color: var(--primary);
        }

        /* --- Cards Grid --- */
        .places-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 24px;
        }

        .card {
            background-color: var(--bg-card);
            border-radius: 16px;
            overflow: hidden;
            border: 1px solid var(--border-light);
            box-shadow: 0 4px 15px rgba(0,0,0,0.03);
            transition: transform 0.2s, box-shadow 0.2s;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.08);
        }

        .card-img-placeholder {
            height: 170px;
            background: linear-gradient(135deg, hsl(245, 75%, 65%), hsl(220, 80%, 70%));
            position: relative;
        }

        .card-img-inner-circle {
            width: 40px;
            height: 12px;
            background-color: rgba(255,255,255,0.2);
            border-radius: 50%;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .badge-category {
            position: absolute;
            top: 12px;
            left: 12px;
            background-color: rgba(255, 255, 255, 0.92);
            color: var(--primary);
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 700;
            backdrop-filter: blur(4px);
        }

        .badge-hours {
            position: absolute;
            bottom: 12px;
            right: 12px;
            background-color: rgba(17, 24, 39, 0.78);
            color: #ffffff;
            padding: 4px 10px;
            border-radius: 8px;
            font-size: 11px;
            font-weight: 500;
        }

        .card-content {
            padding: 20px;
            display: flex;
            flex-direction: column;
            flex-grow: 1;
        }

        .card-title {
            font-size: 16px;
            font-weight: 700;
            margin-bottom: 6px;
        }

        .card-location {
            font-size: 12px;
            color: var(--text-muted);
            margin-bottom: 14px;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .tags-container {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-bottom: 14px;
        }

        .tag {
            padding: 4px 10px;
            border-radius: 6px;
            font-size: 11px;
            font-weight: 600;
        }

        .tag-green { background-color: var(--tag-green-bg); color: var(--tag-green-text); }
        .tag-blue { background-color: var(--tag-blue-bg); color: var(--tag-blue-text); }
        .tag-yellow { background-color: var(--tag-yellow-bg); color: var(--tag-yellow-text); }
        .tag-red { background-color: var(--tag-red-bg); color: var(--tag-red-text); }

        .facilities-preview {
            margin-top: auto;
            padding-top: 12px;
            border-top: 1px dashed var(--border-light);
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
            align-items: center;
        }

        .facility-chip {
            font-size: 11px;
            color: var(--text-muted);
            background-color: #f3f4f6;
            padding: 3px 8px;
            border-radius: 4px;
        }

        /* --- Footer --- */
        footer {
            text-align: center;
            padding: 24px;
            color: var(--text-muted);
            font-size: 12px;
            margin-top: auto;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar">
        <div class="nav-left">
            <a href="{{ route('dashboard') }}" class="logo">
                <img src="https://i.pinimg.com/736x/3e/b8/b0/3eb8b071563a9ad95f3357976ec32b46.jpg" alt="StudySpot Logo" style="height: 45px; border-radius: 8px; object-fit: cover;">
            </a>
            <div class="nav-links">
                <a href="{{ route('dashboard') }}" class="active">Beranda</a>
                <a href="{{ route('recommendations.index') }}">Rekomendasi</a>
                <a href="{{ route('bookmarks.index') }}">Tersimpan</a>
            </div>
        </div>
        <div class="nav-right" style="display: flex; align-items: center; gap: 12px;">
            <span style="font-size: 14px; font-weight: 600; color: var(--text-main);">
                Halo, {{ Auth::user()->name }}
            </span>

            @if(Auth::user()->role === 'admin')
                <a href="{{ route('admin.places.index') }}" style="text-decoration: none; background-color: var(--primary); padding: 8px 12px; border-radius: 8px; font-size: 12px; font-weight: 600; color: white;">
                    Panel Admin
                </a>
            @endif
            
            <!-- Tombol menuju halaman Edit Profil -->
            <a href="{{ route('profile.edit') }}" style="text-decoration: none; background: none; border: 1px solid var(--primary); padding: 8px 12px; border-radius: 8px; font-size: 12px; font-weight: 600; color: var(--primary); transition: 0.2s;" onmouseover="this.style.backgroundColor='var(--primary)'; this.style.color='white';" onmouseout="this.style.backgroundColor='transparent'; this.style.color='var(--primary)';">
                Profil
            </a>

            <!-- Tombol Keluar (Logout) -->
            <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
                @csrf
                <button type="submit" style="background: none; border: 1px solid var(--border-light); padding: 8px 12px; border-radius: 8px; cursor: pointer; font-size: 12px; font-weight: 600; color: #dc3545; transition: 0.2s;" onmouseover="this.style.backgroundColor='#dc3545'; this.style.color='white';" onmouseout="this.style.backgroundColor='transparent'; this.style.color='#dc3545';">
                    Keluar
                </button>
            </form>
        </div>      
    </nav>

    <!-- Main Content -->
    <main class="container">
        <!-- Header & Pencarian Dinamis -->
        <div class="header-section">
            <h1>Cari tempat belajar</h1>
            <p>Temukan tempat yang pas untuk belajar hari ini</p>
            
            <!-- Form Pencarian -->
            <form action="{{ route('dashboard') }}" method="GET" class="search-container">
                @if(request('category'))
                    <input type="hidden" name="category" value="{{ request('category') }}">
                @endif
                <svg class="search-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                <input type="text" name="search" class="search-input" value="{{ request('search') }}" placeholder="Cari nama tempat atau lokasi...">
                <button type="submit" class="btn-search">Cari</button>
            </form>

            <!-- Tombol Filter Kategori -->
            <div class="filters">
                @php
                    $currentCategory = request('category', 'Semua');
                    $categories = ['Semua', 'Perpustakaan', 'Kafe', 'Co-working', 'Buka sekarang'];
                @endphp

                @foreach($categories as $cat)
                    <a href="{{ route('dashboard', ['category' => $cat, 'search' => request('search')]) }}" 
                       class="filter-pill {{ $currentCategory == $cat ? 'active' : '' }}">
                        {{ $cat }}
                    </a>
                @endforeach
            </div>
        </div>

        <!-- Grid Tempat Belajar -->
        <div class="places-grid">
            @forelse ($places as $place)
                <a href="{{ route('places.show', $place->id) }}" style="text-decoration: none; color: inherit; display: block;">
                    <div class="card">
                        <div class="card-img-placeholder">
                            @if($place->image_url)
                                <img src="{{ $place->image_url }}" alt="{{ $place->name }}" style="width: 100%; height: 100%; object-fit: cover;">
                            @else
                                <div class="card-img-inner-circle"></div>
                            @endif

                            <!-- Badge Kategori -->
                            @if($place->category)
                                <span class="badge-category">{{ $place->category }}</span>
                            @endif

                            <!-- Badge Jam Operasional Dinamis -->
                            @if($place->opening_time && $place->closing_time)
                                <span class="badge-hours">🕒 {{ $place->opening_time }} - {{ $place->closing_time }}</span>
                            @elseif($place->status_text)
                                <span class="badge-hours">🕒 {{ $place->status_text }}</span>
                            @endif
                        </div>

                        <div class="card-content">
                            <h3 class="card-title">{{ $place->name }}</h3>
                            <div class="card-location">📍 {{ $place->location }} • {{ $place->distance }}</div>

                            <!-- Indikator Kondisi Operasional (Kursi, Wi-Fi, Kebisingan) -->
                            <div class="tags-container">
                                @if($place->available_seats !== null || $place->wifi_speed || $place->noise_level)
                                    @if($place->available_seats !== null)
                                        <span class="tag tag-green">🪑 {{ $place->available_seats }} Kursi</span>
                                    @endif

                                    @if($place->wifi_speed)
                                        <span class="tag tag-blue">📶 Wi-Fi {{ $place->wifi_speed }}</span>
                                    @endif

                                    @if($place->noise_level)
                                        @php
                                            $noiseClass = 'tag-green';
                                            if ($place->noise_level === 'Sedang') {
                                                $noiseClass = 'tag-yellow';
                                            } elseif ($place->noise_level === 'Tinggi') {
                                                $noiseClass = 'tag-red';
                                            }
                                        @endphp
                                        <span class="tag {{ $noiseClass }}">🔊 Kebisingan {{ $place->noise_level }}</span>
                                    @endif
                                @elseif(!empty($place->tags))
                                    <!-- Fallback untuk data lama yang masih memakai tags -->
                                    @foreach($place->tags as $tag)
                                        @php
                                            $tagClass = 'tag-green';
                                            if (str_contains($tag, 'Wi-Fi') || str_contains($tag, 'AC') || str_contains($tag, 'Hening') || str_contains($tag, '24 Jam')) {
                                                $tagClass = 'tag-blue';
                                            } elseif (str_contains($tag, 'Lesehan') || str_contains($tag, 'Sedang')) {
                                                $tagClass = 'tag-yellow';
                                            }
                                        @endphp
                                        <span class="tag {{ $tagClass }}">{{ $tag }}</span>
                                    @endforeach
                                @endif
                            </div>

                            <!-- Preview Fasilitas yang Dicentang di Form Admin -->
                            @php
                                $facilities = is_array($place->facilities) ? $place->facilities : [];
                            @endphp
                            @if(count($facilities) > 0)
                                <div class="facilities-preview">
                                    @foreach(array_slice($facilities, 0, 3) as $facility)
                                        <span class="facility-chip">✓ {{ $facility }}</span>
                                    @endforeach
                                    @if(count($facilities) > 3)
                                        <span class="facility-chip" style="font-weight: 600;">+{{ count($facilities) - 3 }} lainnya</span>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>
                </a>
            @empty
                <p style="color: var(--text-muted); grid-column: 1 / -1;">Belum ada tempat belajar yang terdaftar.</p>
            @endforelse
        </div>
    </main>

    <!-- Footer -->
    <footer>
        © 2026 StudySpot. Tempat Belajar Terbaik untuk Anda.
    </footer>

</body>
</html>