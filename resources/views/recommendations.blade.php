<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekomendasi Tempat Belajar - StudySpot</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: hsl(245, 75%, 60%);
            --primary-hover: hsl(245, 75%, 50%);
            --primary-light: hsl(245, 75%, 96%);
            --bg-body: hsl(0, 0%, 98%);
            --bg-card: hsl(0, 0%, 100%);
            --text-main: hsl(0, 0%, 12%);
            --text-muted: hsl(0, 0%, 48%);
            --border-light: hsl(0, 0%, 90%);

            --tag-green-bg: hsl(142, 65%, 92%);
            --tag-green-text: hsl(142, 65%, 30%);
            --score-green: #16a34a;
            --score-orange: #d97706;
            --score-red: #dc2626;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Inter', sans-serif; }
        body { background-color: var(--bg-body); color: var(--text-main); min-height: 100vh; display: flex; flex-direction: column; }

        /* Navbar */
        .navbar { display: flex; justify-content: space-between; align-items: center; padding: 16px 5%; background-color: var(--bg-card); border-bottom: 1px solid var(--border-light); }
        .nav-left { display: flex; align-items: center; gap: 40px; }
        .logo { display: flex; align-items: center; text-decoration: none; }
        .nav-links { display: flex; gap: 24px; }
        .nav-links a { text-decoration: none; color: var(--text-muted); font-size: 14px; font-weight: 500; padding-bottom: 4px; transition: 0.2s; }
        .nav-links a:hover { color: var(--text-main); }
        .nav-links a.active { color: var(--primary); border-bottom: 2px solid var(--primary); font-weight: 600; }

        /* Main Container */
        .container { padding: 40px 5%; flex-grow: 1; max-width: 1200px; margin: 0 auto; width: 100%; }

        .header-section { margin-bottom: 20px; }
        .header-section h1 { font-size: 26px; font-weight: 700; margin-bottom: 6px; }
        .header-section p { color: var(--text-muted); font-size: 14px; }

        /* Criteria Filter Chips */
        .criteria-bar { display: flex; flex-wrap: wrap; align-items: center; gap: 10px; margin-bottom: 28px; position: relative; }

        .criteria-pill {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background-color: var(--primary);
            color: #ffffff;
            padding: 8px 14px;
            border-radius: 999px;
            font-size: 13px;
            font-weight: 500;
            text-decoration: none;
            transition: 0.2s;
        }
        .criteria-pill:hover { background-color: var(--primary-hover); }
        .criteria-remove { font-size: 14px; line-height: 1; opacity: 0.85; font-weight: 700; }

        .add-criteria-wrapper { position: relative; display: inline-block; }
        .btn-add-criteria {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background-color: var(--bg-card);
            color: var(--text-muted);
            border: 1px solid var(--border-light);
            padding: 8px 16px;
            border-radius: 999px;
            font-size: 13px;
            font-weight: 500;
            cursor: pointer;
            transition: 0.2s;
        }
        .btn-add-criteria:hover { border-color: var(--primary); color: var(--primary); }

        .criteria-dropdown {
            display: none;
            position: absolute;
            top: calc(100% + 8px);
            left: 0;
            background-color: var(--bg-card);
            border: 1px solid var(--border-light);
            border-radius: 14px;
            padding: 10px;
            min-width: 220px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.08);
            z-index: 50;
            flex-direction: column;
            gap: 4px;
        }
        .criteria-dropdown.show { display: flex; }

        .dropdown-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 8px 12px;
            border-radius: 8px;
            text-decoration: none;
            color: var(--text-main);
            font-size: 13px;
            font-weight: 500;
            transition: 0.15s;
        }
        .dropdown-item:hover { background-color: var(--primary-light); color: var(--primary); }

        .btn-reset-criteria {
            font-size: 12px;
            color: var(--primary);
            text-decoration: none;
            font-weight: 600;
            margin-left: 4px;
        }
        .btn-reset-criteria:hover { text-decoration: underline; }

        /* Recommendation List */
        .recommendation-list { display: flex; flex-direction: column; gap: 16px; }

        .rec-card {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            background-color: var(--bg-card);
            border: 1px solid var(--border-light);
            border-radius: 16px;
            padding: 18px 24px;
            text-decoration: none;
            color: inherit;
            box-shadow: 0 2px 10px rgba(0,0,0,0.02);
            transition: transform 0.2s, box-shadow 0.2s, border-color 0.2s;
        }
        .rec-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 22px rgba(0,0,0,0.06);
            border-color: var(--primary);
        }
        .rec-card.top-rank {
            border: 1.5px solid var(--primary);
            box-shadow: 0 4px 16px rgba(79, 70, 229, 0.08);
        }

        .rec-left { display: flex; align-items: center; gap: 18px; min-width: 0; flex-grow: 1; }

        .rank-badge {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background-color: var(--primary-light);
            color: var(--primary);
            font-size: 12px;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .rec-thumb {
            width: 68px;
            height: 68px;
            border-radius: 14px;
            background: linear-gradient(135deg, hsl(245, 75%, 65%), hsl(220, 80%, 70%));
            overflow: hidden;
            flex-shrink: 0;
        }
        .rec-thumb img { width: 100%; height: 100%; object-fit: cover; }

        .rec-info { display: flex; flex-direction: column; gap: 5px; min-width: 0; }
        .rec-title { font-size: 16px; font-weight: 700; color: var(--text-main); }
        .rec-meta { font-size: 12px; color: var(--text-muted); }

        .rec-badges { display: flex; flex-wrap: wrap; gap: 8px; margin-top: 4px; }
        .green-badge {
            background-color: var(--tag-green-bg);
            color: var(--tag-green-text);
            padding: 4px 10px;
            border-radius: 999px;
            font-size: 11px;
            font-weight: 600;
        }

        .rec-score {
            font-size: 24px;
            font-weight: 800;
            flex-shrink: 0;
            padding-left: 12px;
        }
        .score-high { color: var(--score-green); }
        .score-mid { color: var(--score-orange); }
        .score-low { color: var(--score-red); }

        @media (max-width: 640px) {
            .rec-card { padding: 16px; gap: 12px; }
            .rec-left { gap: 12px; }
            .rec-thumb { width: 54px; height: 54px; }
            .rec-score { font-size: 20px; }
        }

        footer { text-align: center; padding: 24px; color: var(--text-muted); font-size: 12px; margin-top: auto; }
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
                <a href="{{ route('dashboard') }}">Beranda</a>
                <a href="{{ route('recommendations.index') }}" class="active">Rekomendasi</a>
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

            <a href="{{ route('profile.edit') }}" style="text-decoration: none; background: none; border: 1px solid var(--primary); padding: 8px 12px; border-radius: 8px; font-size: 12px; font-weight: 600; color: var(--primary);">
                Profil
            </a>

            <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
                @csrf
                <button type="submit" style="background: none; border: 1px solid var(--border-light); padding: 8px 12px; border-radius: 8px; cursor: pointer; font-size: 12px; font-weight: 600; color: #dc3545;">
                    Keluar
                </button>
            </form>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="container">
        <div class="header-section">
            <h1>Rekomendasi untukmu</h1>
            <p>Berdasarkan kriteria yang kamu pilih</p>
        </div>

        <!-- Bar Kriteria Interaktif -->
        <div class="criteria-bar">
            @foreach($selectedCriteria as $key)
                @php
                    $remaining = array_values(array_diff($selectedCriteria, [$key]));
                    $removeUrl = count($remaining) > 0
                        ? route('recommendations.index', ['criteria' => $remaining])
                        : route('recommendations.index', ['empty' => 1]);
                @endphp
                <a href="{{ $removeUrl }}" class="criteria-pill" title="Hapus kriteria {{ $availableCriteria[$key] }}">
                    <span>{{ $availableCriteria[$key] }}</span>
                    <span class="criteria-remove">×</span>
                </a>
            @endforeach

            @php
                $unselectedCriteria = array_diff_key($availableCriteria, array_flip($selectedCriteria));
            @endphp

            @if(count($unselectedCriteria) > 0)
                <div class="add-criteria-wrapper">
                    <button type="button" class="btn-add-criteria" id="btnToggleCriteria">
                        + Tambah kriteria
                    </button>

                    <div class="criteria-dropdown" id="criteriaDropdown">
                        @foreach($unselectedCriteria as $key => $label)
                            @php
                                $added = array_merge($selectedCriteria, [$key]);
                            @endphp
                            <a href="{{ route('recommendations.index', ['criteria' => $added]) }}" class="dropdown-item">
                                <span>{{ $label }}</span>
                                <span style="color: var(--primary); font-weight: 700;">+</span>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif

            @if(count($selectedCriteria) === 0)
                <a href="{{ route('recommendations.index') }}" class="btn-reset-criteria">Reset kriteria default</a>
            @endif
        </div>

        <!-- Daftar Peringkat Tempat Belajar -->
        <div class="recommendation-list">
            @forelse($places as $index => $place)
                @php
                    $rank = $index + 1;
                    $scoreClass = 'score-low';
                    if ($place->match_percentage >= 80) {
                        $scoreClass = 'score-high';
                    } elseif ($place->match_percentage >= 50) {
                        $scoreClass = 'score-mid';
                    }

                    $facilities = is_array($place->facilities)
                        ? $place->facilities
                        : (json_decode($place->facilities ?? '[]', true) ?: []);
                @endphp

                <a href="{{ route('places.show', $place->id) }}" class="rec-card {{ $rank === 1 ? 'top-rank' : '' }}">
                    <div class="rec-left">
                        <div class="rank-badge">{{ $rank }}</div>

                        <div class="rec-thumb">
                            @if($place->image_url)
                                <img src="{{ $place->image_url }}" alt="{{ $place->name }}">
                            @endif
                        </div>

                        <div class="rec-info">
                            <h2 class="rec-title">{{ $place->name }}</h2>
                            <div class="rec-meta">
                                @if($place->total_criteria > 0)
                                    Cocok dengan {{ $place->matched_count }} dari {{ $place->total_criteria }} kriteria • {{ $place->distance }}
                                @else
                                    {{ $place->location }} • {{ $place->distance }}
                                @endif
                            </div>

                            <div class="rec-badges">
                                <span class="green-badge">{{ $place->available_seats ?? 0 }} Jumlah Kursi</span>

                                @if($place->wifi_speed)
                                    <span class="green-badge">Wi-Fi {{ $place->wifi_speed }}</span>
                                @endif

                                @if(in_array('Stop kontak', $facilities))
                                    <span class="green-badge">Stop Kontak</span>
                                @endif

                                @if($place->noise_level)
                                    <span class="green-badge">Kebisingan {{ $place->noise_level }}</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="rec-score {{ $scoreClass }}">
                        {{ $place->match_percentage }}%
                    </div>
                </a>
            @empty
                <div style="background: white; padding: 32px; border-radius: 16px; border: 1px solid var(--border-light); text-align: center; color: var(--text-muted);">
                    Belum ada data tempat belajar yang tersedia untuk direkomendasikan.
                </div>
            @endforelse
        </div>
    </main>

    <footer>
        © 2026 StudySpot. Tempat Belajar Terbaik untuk Anda.
    </footer>

    <script>
        const btnToggle = document.getElementById('btnToggleCriteria');
        const dropdown = document.getElementById('criteriaDropdown');

        if (btnToggle && dropdown) {
            btnToggle.addEventListener('click', function (e) {
                e.stopPropagation();
                dropdown.classList.toggle('show');
            });

            document.addEventListener('click', function (e) {
                if (!dropdown.contains(e.target) && e.target !== btnToggle) {
                    dropdown.classList.remove('show');
                }
            });
        }
    </script>

</body>
</html>