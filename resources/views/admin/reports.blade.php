<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Rating & Rekomendasi - Admin StudySpot</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #4f46e5;
            --primary-hover: #4338ca;
            --primary-light: #eef2ff;
            --text-main: #1f2937;
            --text-muted: #6b7280;
            --border: #e5e7eb;
            --bg-body: #f8fafc;
            --bg-sidebar: #ffffff;
            --star-active: #f59e0b;
            --star-empty: #d1d5db;
            --tag-green-bg: #dcfce7;
            --tag-green-text: #15803d;
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
        .main-content { flex-grow: 1; padding: 36px 40px; overflow-y: auto; }
        .page-wrapper { max-width: 1180px; margin: 0 auto; }

        .alert-success { background-color: #dcfce7; color: #166534; padding: 12px 16px; border-radius: 10px; font-size: 13px; font-weight: 500; margin-bottom: 24px; border: 1px solid #bbf7d0; }

        /* Section Header */
        .section-header { margin-bottom: 22px; }
        .section-header h1, .section-header h2 { font-size: 24px; font-weight: 700; color: var(--text-main); margin-bottom: 4px; }
        .section-header p { font-size: 14px; color: var(--text-muted); }

        /* =========================================================
           BAGIAN 1: STATISTIK RATA-RATA & MODERASI RATING (KHUSUS ADMIN)
           ========================================================= */
        .stats-row { display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 18px; margin-bottom: 22px; }

        .avg-card { background: #ffffff; border: 1px solid var(--border); border-radius: 16px; padding: 20px 24px; display: flex; align-items: center; gap: 18px; box-shadow: 0 2px 10px rgba(0,0,0,0.02); }
        .avg-number { font-size: 34px; font-weight: 800; color: var(--primary); line-height: 1; }
        .avg-label { font-size: 13px; color: var(--text-main); font-weight: 600; }
        .avg-sub { font-size: 12px; color: var(--text-muted); margin-top: 3px; }

        .reviews-list { display: flex; flex-direction: column; gap: 14px; margin-bottom: 40px; }

        .review-card { background: #ffffff; border: 1px solid var(--border); border-radius: 16px; padding: 20px 24px; box-shadow: 0 2px 10px rgba(0,0,0,0.02); }
        .review-top { display: flex; justify-content: space-between; align-items: flex-start; gap: 12px; margin-bottom: 12px; flex-wrap: wrap; }

        .reviewer-box { display: flex; align-items: center; gap: 12px; }
        .reviewer-avatar { width: 38px; height: 38px; border-radius: 50%; background-color: var(--primary-light); color: var(--primary); font-size: 12px; font-weight: 700; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
        .reviewer-name { font-size: 14px; font-weight: 700; color: var(--text-main); display: flex; align-items: center; gap: 8px; }
        .role-pill { font-size: 10px; font-weight: 600; padding: 2px 8px; border-radius: 999px; background-color: #f3f4f6; color: var(--text-muted); }
        .review-place { font-size: 12px; color: var(--text-muted); margin-top: 2px; }
        .review-place strong { color: var(--primary); font-weight: 600; }

        .review-stars { color: var(--star-active); font-size: 16px; letter-spacing: 1px; white-space: nowrap; display: flex; align-items: center; gap: 4px; }
        .review-stars .empty { color: var(--star-empty); }
        .review-comment { font-size: 13px; color: #374151; line-height: 1.55; background-color: #f9fafb; padding: 12px 14px; border-radius: 10px; border-left: 3px solid var(--primary); }

        .review-footer { display: flex; justify-content: space-between; align-items: center; margin-top: 12px; padding-top: 10px; border-top: 1px dashed var(--border); font-size: 12px; color: var(--text-muted); }
        .btn-del-review { background-color: #fef2f2; border: 1px solid #fecaca; color: #dc2626; padding: 6px 12px; border-radius: 8px; font-size: 12px; font-weight: 600; cursor: pointer; transition: 0.2s; }
        .btn-del-review:hover { background-color: #dc2626; color: #ffffff; border-color: #dc2626; }

        .divider { border: 0; border-top: 1px solid var(--border); margin: 36px 0; }

        /* =========================================================
           BAGIAN 2: REKOMENDASI & PERINGKAT KRITERIA
           ========================================================= */
        .criteria-bar { display: flex; flex-wrap: wrap; align-items: center; gap: 10px; margin-bottom: 24px; position: relative; }
        .criteria-pill { display: inline-flex; align-items: center; gap: 8px; background-color: var(--primary); color: #ffffff; padding: 8px 14px; border-radius: 999px; font-size: 13px; font-weight: 500; text-decoration: none; transition: 0.2s; }
        .criteria-pill:hover { background-color: var(--primary-hover); }

        .add-criteria-wrapper { position: relative; display: inline-block; }
        .btn-add-criteria { display: inline-flex; align-items: center; gap: 6px; background-color: #ffffff; color: var(--text-muted); border: 1px solid var(--border); padding: 8px 16px; border-radius: 999px; font-size: 13px; font-weight: 500; cursor: pointer; transition: 0.2s; }
        .btn-add-criteria:hover { border-color: var(--primary); color: var(--primary); }

        .criteria-dropdown { display: none; position: absolute; top: calc(100% + 8px); left: 0; background-color: #ffffff; border: 1px solid var(--border); border-radius: 14px; padding: 8px; min-width: 210px; box-shadow: 0 10px 25px rgba(0,0,0,0.08); z-index: 50; flex-direction: column; gap: 4px; }
        .criteria-dropdown.show { display: flex; }
        .dropdown-item { display: flex; align-items: center; justify-content: space-between; padding: 8px 12px; border-radius: 8px; text-decoration: none; color: var(--text-main); font-size: 13px; font-weight: 500; }
        .dropdown-item:hover { background-color: var(--primary-light); color: var(--primary); }

        .recommendation-list { display: flex; flex-direction: column; gap: 14px; }
        .rec-card { display: flex; align-items: center; justify-content: space-between; gap: 20px; background-color: #ffffff; border: 1px solid var(--border); border-radius: 16px; padding: 18px 24px; text-decoration: none; color: inherit; transition: 0.2s; }
        .rec-card:hover { transform: translateY(-2px); box-shadow: 0 8px 20px rgba(0,0,0,0.05); border-color: var(--primary); }
        .rec-card.top-rank { border: 1.5px solid var(--primary); box-shadow: 0 4px 14px rgba(79, 70, 229, 0.08); }

        .rec-left { display: flex; align-items: center; gap: 16px; min-width: 0; flex-grow: 1; }
        .rank-badge { width: 30px; height: 30px; border-radius: 50%; background-color: var(--primary-light); color: var(--primary); font-size: 12px; font-weight: 700; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
        .rec-thumb { width: 62px; height: 62px; border-radius: 12px; background: linear-gradient(135deg, #6366f1, #60a5fa); overflow: hidden; flex-shrink: 0; }
        .rec-thumb img { width: 100%; height: 100%; object-fit: cover; }

        .rec-info { display: flex; flex-direction: column; gap: 4px; }
        .rec-title { font-size: 16px; font-weight: 700; color: var(--text-main); }
        .rec-meta { font-size: 12px; color: var(--text-muted); }

        .rec-badges { display: flex; flex-wrap: wrap; gap: 8px; margin-top: 4px; }
        .green-badge { background-color: var(--tag-green-bg); color: var(--tag-green-text); padding: 4px 10px; border-radius: 999px; font-size: 11px; font-weight: 600; }

        .rec-score { font-size: 24px; font-weight: 800; flex-shrink: 0; }
        .score-high { color: #16a34a; }
        .score-mid { color: #d97706; }
        .score-low { color: #dc2626; }
    </style>
</head>
<body>

    <!-- Sidebar Admin -->
    <aside class="sidebar">
        <a href="{{ route('dashboard') }}" class="sidebar-brand">
            <img src="https://i.pinimg.com/736x/3e/b8/b0/3eb8b071563a9ad95f3357976ec32b46.jpg" alt="StudySpot Logo">
        </a>
        <nav class="sidebar-menu">
            <a href="{{ route('admin.places.index') }}" class="menu-item">Data Tempat</a>
            <a href="{{ route('admin.reports.index') }}" class="menu-item active">Laporan</a>
            <a href="{{ route('dashboard') }}" class="menu-item" style="margin-top: 20px;">← Kembali ke Web</a>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="main-content">
        <div class="page-wrapper">

            @if(session('success'))
                <div class="alert-success">{{ session('success') }}</div>
            @endif

            <!-- =========================================================
                 BAGIAN 1: LAPORAN RATING & MODERASI ULASAN (KHUSUS ADMIN)
                 ========================================================= -->
            <div class="section-header">
                <h1>Laporan Rating & Ulasan</h1>
                <p>Pantau rata-rata penilaian, daftar pemberi rating dari mahasiswa maupun admin, serta kelola moderasi ulasan.</p>
            </div>

            <!-- Kartu Statistik Rata-rata Rating -->
            <div class="stats-row">
                <div class="avg-card">
                    <div class="avg-number">{{ $averageRating }}</div>
                    <div>
                        <div class="avg-label">Rata-rata dari semua tempat belajar</div>
                        <div class="avg-sub">Total {{ $reviews->count() }} ulasan & rating masuk</div>
                    </div>
                </div>

                <div class="avg-card">
                    <div class="avg-number" style="color: #16a34a;">{{ $reviewedPlacesCount }}</div>
                    <div>
                        <div class="avg-label">Tempat belajar telah dinilai</div>
                        <div class="avg-sub">Dari {{ $allPlaces->count() }} total tempat terdaftar</div>
                    </div>
                </div>
            </div>

            <!-- Daftar Pemberi Rating & Tombol Hapus Rating -->
            <div class="reviews-list">
                @forelse($reviews as $rev)
                    <div class="review-card">
                        <div class="review-top">
                            <div class="reviewer-box">
                                <div class="reviewer-avatar">
                                    {{ strtoupper(substr($rev->user->name ?? 'US', 0, 2)) }}
                                </div>
                                <div>
                                    <div class="reviewer-name">
                                        <span>{{ $rev->user->name ?? 'Pengguna' }}</span>
                                        <span class="role-pill">{{ ($rev->user->role ?? 'user') === 'admin' ? 'Admin' : 'Mahasiswa' }}</span>
                                    </div>
                                    <div class="review-place">
                                        {{ $rev->user->email ?? '-' }} • Menilai <strong>{{ $rev->tempatBelajar->name ?? 'Tempat Belajar' }}</strong>
                                    </div>
                                </div>
                            </div>

                            <div class="review-stars" title="Rating {{ $rev->rating }}/5">
                                @for($s = 1; $s <= 5; $s++)
                                    @if($s <= $rev->rating)
                                        <span>★</span>
                                    @else
                                        <span class="empty">☆</span>
                                    @endif
                                @endfor
                                <span style="font-size: 12px; color: var(--text-muted); font-weight: 700; margin-left: 4px;">({{ $rev->rating }}/5)</span>
                            </div>
                        </div>

                        <p class="review-comment">{{ $rev->comment }}</p>

                        <div class="review-footer">
                            <span>Dikirim {{ $rev->created_at->diffForHumans() }} ({{ $rev->created_at->format('d M Y, H:i') }})</span>
                                <form action="{{ route('admin.reports.reviews.destroy', $rev->id) }}" method="POST" data-user="{{ $rev->user->name ?? 'pengguna ini' }}" onsubmit="return confirm('Hapus rating dan ulasan dari ' + this.dataset.user + '?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-del-review">🗑️ Hapus Rating</button>
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="review-card" style="text-align: center; color: var(--text-muted); font-size: 13px; padding: 32px;">
                        Belum ada rating atau catatan yang dikirimkan oleh mahasiswa maupun admin pada halaman detail tempat.
                    </div>
                @endforelse
            </div>

            <hr class="divider">

            <!-- =========================================================
                 BAGIAN 2: REKOMENDASI UNTUKMU (PERINGKAT KRITERIA)
                 ========================================================= -->
            <div class="section-header">
                <h2>Rekomendasi untukmu</h2>
                <p>Berdasarkan kriteria yang dipilih ({{ count($selectedCriteria) }} kriteria aktif)</p>
            </div>

            <!-- Bar Kriteria Interaktif -->
            <div class="criteria-bar">
                @foreach($selectedCriteria as $key)
                    @php
                        $remaining = array_values(array_diff($selectedCriteria, [$key]));
                        $removeUrl = count($remaining) > 0
                            ? route('admin.reports.index', ['criteria' => $remaining])
                            : route('admin.reports.index', ['empty' => 1]);
                    @endphp
                    <a href="{{ $removeUrl }}" class="criteria-pill" title="Hapus kriteria {{ $availableCriteria[$key] }}">
                        <span>{{ $availableCriteria[$key] }}</span>
                        <span style="font-weight: 700;">×</span>
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
                                <a href="{{ route('admin.reports.index', ['criteria' => $added]) }}" class="dropdown-item">
                                    <span>{{ $label }}</span>
                                    <span style="color: var(--primary); font-weight: 700;">+</span>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if(count($selectedCriteria) === 0)
                    <a href="{{ route('admin.reports.index') }}" style="font-size: 12px; color: var(--primary); font-weight: 600; text-decoration: none;">
                        Reset kriteria default
                    </a>
                @endif
            </div>

            <!-- Daftar Peringkat Tempat Belajar -->
            <div class="recommendation-list">
                @forelse($rankedPlaces as $index => $place)
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
                                <div class="rec-title">{{ $place->name }}</div>
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
                    <div style="background: white; padding: 24px; border-radius: 16px; border: 1px solid var(--border); text-align: center; color: var(--text-muted); font-size: 13px;">
                        Belum ada data tempat belajar yang terdaftar.
                    </div>
                @endforelse
            </div>

        </div>
    </main>

    <script>
        const btnToggle = document.getElementById('btnToggleCriteria');
        const dropdown = document.getElementById('criteriaDropdown');

        if (btnToggle && dropdown) {
            btnToggle.addEventListener('click', (e) => {
                e.stopPropagation();
                dropdown.classList.toggle('show');
            });

            document.addEventListener('click', (e) => {
                if (!dropdown.contains(e.target) && e.target !== btnToggle) {
                    dropdown.classList.remove('show');
                }
            });
        }
    </script>

</body>
</html>