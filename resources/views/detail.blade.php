<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $place->name }} - Detail Tempat Belajar | StudySpot</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: hsl(245, 75%, 60%);
            --primary-hover: hsl(245, 75%, 50%);
            --bg-body: hsl(0, 0%, 98%);
            --bg-card: hsl(0, 0%, 100%);
            --text-main: hsl(0, 0%, 12%);
            --text-muted: hsl(0, 0%, 48%);
            --border-light: hsl(0, 0%, 92%);
            
            --tag-green-bg: hsl(140, 60%, 94%);
            --tag-green-text: hsl(140, 60%, 30%);
            --tag-blue-bg: hsl(220, 80%, 95%);
            --tag-blue-text: hsl(220, 70%, 45%);
            --tag-purple-bg: hsl(245, 75%, 95%);
            --tag-purple-text: hsl(245, 75%, 55%);
            --tag-yellow-bg: hsl(40, 85%, 93%);
            --tag-yellow-text: hsl(40, 80%, 35%);
        }

        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Inter', sans-serif; }
        body { background-color: var(--bg-body); color: var(--text-main); min-height: 100vh; display: flex; flex-direction: column; }

        /* Navbar */
        .navbar { display: flex; justify-content: space-between; align-items: center; padding: 16px 5%; background-color: var(--bg-card); border-bottom: 1px solid var(--border-light); }
        .nav-left { display: flex; align-items: center; gap: 40px; }
        .logo { font-size: 20px; font-weight: 700; display: flex; align-items: center; gap: 8px; color: var(--text-main); text-decoration: none; }
        .logo-icon { background-color: var(--primary); color: white; width: 32px; height: 32px; border-radius: 8px; display: flex; justify-content: center; align-items: center; }
        .nav-links { display: flex; gap: 24px; }
        .nav-links a { text-decoration: none; color: var(--text-muted); font-size: 14px; font-weight: 500; }
        .nav-links a.active { color: var(--primary); border-bottom: 2px solid var(--primary); padding-bottom: 4px; }

        /* Container & Back Button */
        .container { padding: 30px 5%; flex-grow: 1; max-width: 1280px; margin: 0 auto; width: 100%; }
        .back-link { display: inline-flex; align-items: center; gap: 8px; color: var(--primary); text-decoration: none; font-size: 14px; font-weight: 500; margin-bottom: 20px; }
        .back-link:hover { text-decoration: underline; }

        /* Card Base */
        .card { background-color: var(--bg-card); border-radius: 16px; border: 1px solid var(--border-light); padding: 24px; box-shadow: 0 4px 15px rgba(0,0,0,0.02); }

        /* Hero Banner Card */
        .hero-card { display: grid; grid-template-columns: 1.1fr 1.2fr; gap: 24px; padding: 20px; margin-bottom: 24px; }
        @media (max-width: 900px) { .hero-card { grid-template-columns: 1fr; } }

        .hero-img-box { position: relative; border-radius: 12px; overflow: hidden; min-height: 280px; background-color: #eee; }
        .hero-img-box img { width: 100%; height: 100%; object-fit: cover; }
        
        .badge-overlay-top { position: absolute; top: 16px; left: 16px; background-color: rgba(255, 255, 255, 0.9); padding: 6px 14px; border-radius: 20px; font-size: 12px; font-weight: 600; color: var(--text-main); backdrop-filter: blur(4px); }
        .badge-overlay-bottom { position: absolute; bottom: 16px; left: 16px; background-color: rgba(0, 0, 0, 0.65); color: white; padding: 8px 14px; border-radius: 10px; font-size: 12px; backdrop-filter: blur(4px); }
        .badge-overlay-bottom small { display: block; font-size: 10px; opacity: 0.8; text-transform: uppercase; letter-spacing: 0.5px; }
        .badge-overlay-right { position: absolute; bottom: 16px; right: 16px; background-color: rgba(0, 0, 0, 0.6); color: white; padding: 4px 10px; border-radius: 6px; font-size: 11px; }

        .hero-info { display: flex; flex-direction: column; justify-content: center; padding: 10px 0; }
        .status-badge { display: inline-flex; align-items: center; gap: 6px; color: var(--tag-green-text); font-size: 13px; font-weight: 600; margin-bottom: 10px; }
        .status-dot { width: 8px; height: 8px; background-color: #2e7d32; border-radius: 50%; }

        .place-title { font-size: 28px; font-weight: 700; margin-bottom: 8px; }
        .place-location { color: var(--text-muted); font-size: 14px; margin-bottom: 16px; }
        .place-desc { color: var(--text-muted); font-size: 14px; line-height: 1.6; margin-bottom: 20px; }

        .pills-row { display: flex; flex-wrap: wrap; gap: 10px; margin-bottom: 20px; }
        .pill { padding: 6px 14px; border-radius: 8px; font-size: 12px; font-weight: 600; display: inline-flex; align-items: center; gap: 6px; }
        .pill-green { background-color: var(--tag-green-bg); color: var(--tag-green-text); }
        .pill-blue { background-color: var(--tag-blue-bg); color: var(--tag-blue-text); }
        .pill-purple { background-color: var(--tag-purple-bg); color: var(--tag-purple-text); }

        .update-note { font-size: 11px; color: var(--text-muted); }

        /* Detail Grid Layout (3 Columns) */
        .detail-grid { display: grid; grid-template-columns: 1fr 1fr 1.1fr; gap: 24px; align-items: start; }
        @media (max-width: 1024px) { .detail-grid { grid-template-columns: 1fr 1fr; } }
        @media (max-width: 768px) { .detail-grid { grid-template-columns: 1fr; } }

        .col-stacked { display: flex; flex-direction: column; gap: 24px; }

        /* Section Typography */
        .section-title { font-size: 16px; font-weight: 700; margin-bottom: 4px; }
        .section-sub { font-size: 12px; color: var(--text-muted); margin-bottom: 20px; }

        /* Summary 2x2 Grid */
        .summary-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
        .summary-item { display: flex; gap: 12px; align-items: flex-start; }
        .summary-icon { width: 36px; height: 36px; border-radius: 8px; background-color: var(--tag-purple-bg); color: var(--primary); display: flex; justify-content: center; align-items: center; font-size: 16px; flex-shrink: 0; }
        .summary-label { font-size: 11px; color: var(--text-muted); margin-bottom: 2px; }
        .summary-value { font-size: 13px; font-weight: 700; }

        /* Facilities Badges */
        .facility-list { display: grid; grid-template-columns: 1fr 1fr; gap: 10px; }
        .facility-item { padding: 10px 12px; background-color: var(--bg-body); border-radius: 8px; font-size: 12px; font-weight: 500; display: flex; align-items: center; gap: 8px; border: 1px solid var(--border-light); }

        /* Opening Hours */
        .hours-row { display: flex; justify-content: space-between; font-size: 13px; padding: 8px 0; border-bottom: 1px dashed var(--border-light); }
        .hours-row:last-child { border-bottom: none; }
        .hours-day { color: var(--text-muted); }
        .hours-time { font-weight: 600; }

        /* Student Note Card */
        .quote-box { background-color: var(--bg-body); padding: 16px; border-radius: 12px; font-size: 13px; color: var(--text-main); line-height: 1.5; font-style: italic; margin-bottom: 16px; border-left: 3px solid var(--primary); }
        .author-box { display: flex; align-items: center; gap: 12px; }
        .author-avatar { width: 36px; height: 36px; border-radius: 50%; background-color: var(--primary); color: white; display: flex; justify-content: center; align-items: center; font-size: 12px; font-weight: 700; }
        .author-name { font-size: 13px; font-weight: 600; }
        .author-role { font-size: 11px; color: var(--text-muted); }

        /* Right CTA Card */
        .plan-card-header { font-size: 11px; font-weight: 700; color: var(--primary); text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 6px; }
        .route-info-box { background-color: var(--bg-body); border-radius: 12px; padding: 14px; margin: 16px 0; border: 1px solid var(--border-light); display: flex; align-items: center; gap: 12px; }
        .route-icon { width: 32px; height: 32px; border-radius: 50%; background-color: var(--tag-purple-bg); color: var(--primary); display: flex; justify-content: center; align-items: center; font-size: 14px; flex-shrink: 0; }

        .btn-cta { width: 100%; padding: 14px; background-color: var(--primary); color: white; border: none; border-radius: 12px; font-size: 14px; font-weight: 600; cursor: pointer; transition: 0.2s; display: flex; justify-content: center; align-items: center; gap: 8px; text-decoration: none; }
        .btn-cta:hover { background-color: var(--primary-hover); }

        .btn-actions { display: flex; gap: 12px; margin: 16px 0 20px; }
        .btn-action { flex: 1; padding: 10px; background-color: var(--bg-card); border: 1px solid var(--border-light); border-radius: 8px; font-size: 12px; font-weight: 600; cursor: pointer; display: flex; justify-content: center; align-items: center; gap: 6px; color: var(--text-main); }
        .btn-action:hover { background-color: var(--bg-body); }

        .info-list { display: flex; flex-direction: column; gap: 12px; font-size: 12px; margin-bottom: 20px; }
        .info-row { display: flex; justify-content: space-between; }
        .info-label { color: var(--text-muted); }
        .info-val { font-weight: 600; }

        .alert-warning-box { background-color: var(--tag-yellow-bg); color: var(--tag-yellow-text); padding: 12px 14px; border-radius: 10px; font-size: 12px; font-weight: 500; display: flex; align-items: center; gap: 8px; }

        footer { text-align: center; padding: 30px; color: var(--text-muted); font-size: 12px; margin-top: auto; }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar">
        <div class="nav-left">
            <a href="{{ route('dashboard') }}" class="logo">
                <div class="logo-icon">🎓</div>
                StudySpot
            </a>
            <div class="nav-links">
                <a href="{{ route('dashboard') }}" class="active">Home</a>
                <a href="#">Rekomendasi</a>
                <a href="#">Filter</a>
            </div>
        </div>
        <div class="user-profile" style="width: 36px; height: 36px; border-radius: 50%; background: var(--border-light); display: flex; justify-content: center; align-items: center;">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
        </div>
    </nav>

    <!-- Main Container -->
    <main class="container">
        
        <!-- Link Kembali -->
        <a href="{{ route('dashboard') }}" class="back-link">
            ← Kembali ke daftar tempat
        </a>

        <!-- Hero Card (Foto + Ringkasan Utama) -->
        <div class="card hero-card">
            <div class="hero-img-box">
                @if($place->image_url)
                    <img src="{{ $place->image_url }}" alt="{{ $place->name }}">
                @else
                    <div style="width:100%; height:100%; background: linear-gradient(135deg, hsl(245, 75%, 65%), hsl(220, 80%, 70%));"></div>
                @endif
                <div class="badge-overlay-top">☕ {{ $place->category }} belajar</div>
                <div class="badge-overlay-bottom">
                    <small>Suasana Hari Ini</small>
                    Cukup tenang untuk sesi fokus sore
                </div>
                <div class="badge-overlay-right">📸 1 / 5 foto</div>
            </div>

            <div class="hero-info">
                <div class="status-badge">
                    <span class="status-dot"></span>
                    {{ $place->status_text ?? 'Buka sekarang • hingga 22.00' }}
                </div>
                
                <h1 class="place-title">{{ $place->name }}</h1>
                <div class="place-location">📍 {{ $place->address ?? $place->location }} • {{ $place->distance }}</div>
                
                <p class="place-desc">
                    {{ $place->description ?? 'Tempat belajar yang nyaman dan kondusif dengan fasilitas lengkap untuk mendukung produktivitas tugas Anda.' }}
                </p>

                <div class="pills-row">
                    <span class="pill pill-green">🪑 {{ $place->available_seats }} kursi tersedia</span>
                    <span class="pill pill-blue">📶 {{ $place->wifi_speed }}</span>
                    <span class="pill pill-purple">⭐ {{ $place->rating }} · {{ $place->total_reviews }} ulasan</span>
                    <span class="pill pill-green">🔊 {{ $place->noise_level }}</span>
                </div>

                <div class="update-note">
                    Ketersediaan diperbarui 5 menit lalu oleh pengunjung.
                </div>
            </div>
        </div>

        <!-- Detail Grid 3 Kolom -->
        <div class="detail-grid">
            
            <!-- Kolom 1 (Kiri): Ringkasan & Fasilitas -->
            <div class="col-stacked">
                <div class="card">
                    <h2 class="section-title">Ringkasan untuk belajar</h2>
                    <p class="section-sub">Kondisi utama sebelum kamu berangkat.</p>
                    
                    <div class="summary-grid">
                        <div class="summary-item">
                            <div class="summary-icon">🪑</div>
                            <div>
                                <div class="summary-label">Ketersediaan saat ini</div>
                                <div class="summary-value">{{ $place->available_seats }} dari {{ $place->total_seats }} kursi tersedia</div>
                            </div>
                        </div>

                        <div class="summary-item">
                            <div class="summary-icon">🔊</div>
                            <div>
                                <div class="summary-label">Tingkat kebisingan</div>
                                <div class="summary-value">{{ $place->noise_level }}</div>
                            </div>
                        </div>

                        <div class="summary-item">
                            <div class="summary-icon">📶</div>
                            <div>
                                <div class="summary-label">Koneksi internet</div>
                                <div class="summary-value">{{ $place->wifi_speed }}</div>
                            </div>
                        </div>

                        <div class="summary-item">
                            <div class="summary-icon">⭐</div>
                            <div>
                                <div class="summary-label">Penilaian mahasiswa</div>
                                <div class="summary-value">{{ $place->rating }} dari {{ $place->total_reviews }} ulasan</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <h2 class="section-title">Fasilitas yang berguna</h2>
                    <p class="section-sub">Disiapkan untuk sesi belajar yang lebih lancar.</p>
                    
                    <div class="facility-list">
                        @if(!empty($place->facilities))
                            @foreach($place->facilities as $fac)
                                <div class="facility-item">
                                    <span>⚡</span> {{ $fac }}
                                </div>
                            @endforeach
                        @else
                            <div class="facility-item">⚡ Banyak colokan</div>
                            <div class="facility-item">❄️ AC</div>
                            <div class="facility-item">📚 Rak bacaan</div>
                            <div class="facility-item">👥 Meja kelompok</div>
                            <div class="facility-item">🚲 Parkir sepeda</div>
                            <div class="facility-item">♿ Akses kursi roda</div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Kolom 2 (Tengah): Jam Buka & Catatan Mahasiswa -->
            <div class="col-stacked">
                <div class="card">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px;">
                        <h2 class="section-title" style="margin-bottom:0;">Jam buka</h2>
                        <span class="pill pill-green" style="font-size:11px;">Buka</span>
                    </div>
                    
                    <div style="margin-top: 16px;">
                        <div class="hours-row">
                            <span class="hours-day">• Hari ini • Rabu</span>
                            <span class="hours-time">08.00–22.00</span>
                        </div>
                        <div class="hours-row">
                            <span class="hours-day">Senin–Jumat</span>
                            <span class="hours-time">08.00–22.00</span>
                        </div>
                        <div class="hours-row">
                            <span class="hours-day">Sabtu–Minggu</span>
                            <span class="hours-time">09.00–23.00</span>
                        </div>
                    </div>

                    <p style="font-size: 11px; color: var(--text-muted); margin-top: 16px;">
                        Pesanan terakhir 30 menit sebelum tutup.
                    </p>
                </div>

                <div class="card">
                    <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 12px;">
                        <span style="color: var(--primary);">💡</span>
                        <h2 class="section-title" style="margin-bottom:0;">Catatan mahasiswa</h2>
                    </div>

                    <div class="quote-box">
                        "{{ $place->student_note ?? 'Datang sebelum pukul 16.00 kalau ingin meja dekat jendela. Area belakang lebih tenang untuk panggilan kelompok.' }}"
                    </div>

                    <div class="author-box">
                        <div class="author-avatar">
                            {{ strtoupper(substr($place->student_note_author ?? 'AN', 0, 2)) }}
                        </div>
                        <div>
                            <div class="author-name">{{ $place->student_note_author ?? 'Alya N.' }}</div>
                            <div class="author-role">Mahasiswa • 2 hari lalu</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Kolom 3 (Kanan): Rencana Kunjungan & Petunjuk Arah -->
            <div class="card" style="position: sticky; top: 20px;">
                <div class="plan-card-header">Rencana Kunjungan</div>
                <h2 class="section-title" style="font-size: 20px;">Siap belajar di sini?</h2>
                <p class="section-sub">Kondisinya cukup nyaman sekarang. Berangkat sekitar 7 menit dari kampus.</p>

                <div class="route-info-box">
                    <div class="route-icon">🛵</div>
                    <div style="font-size: 12px;">
                        <strong style="display:block; font-size: 13px; margin-bottom:2px;">Kampus Utama → {{ $place->location }}</strong>
                        <span style="color: var(--text-muted);">{{ $place->distance }} • 7 menit naik motor</span>
                    </div>
                </div>

                <a href="https://maps.google.com/?q={{ urlencode($place->name . ' ' . $place->location) }}" target="_blank" class="btn-cta">
                    📍 Buka petunjuk arah
                </a>

                <div class="btn-actions">
                    <button class="btn-action">🔖 Simpan</button>
                    <button class="btn-action">↗️ Bagikan</button>
                </div>

                <div class="info-list">
                    <div class="info-row">
                        <span class="info-label">🕐 Waktu terbaik datang</span>
                        <span class="info-val">{{ $place->best_time ?? 'Sebelum 16.00' }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">💳 Kisaran belanja</span>
                        <span class="info-val">{{ $place->price_range ?? 'Rp18-35 ribu' }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">🎯 Cocok untuk</span>
                        <span class="info-val">{{ $place->suitable_for ?? 'Fokus & diskusi ringan' }}</span>
                    </div>
                </div>

                <div class="alert-warning-box">
                    <span>⚠️</span> Kursi biasanya mulai penuh setelah pukul 17.30.
                </div>
            </div>

        </div>
    </main>

    <footer>
        © 2026 StudySpot. Tempat Belajar Terbaik untuk Anda.
    </footer>

</body>
</html>