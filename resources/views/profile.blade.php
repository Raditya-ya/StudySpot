@if(auth()->user()->role === 'admin')
    <!-- ========================================== -->
    <!-- TAMPILAN PROFIL KHUSUS ADMIN (DENGAN SIDEBAR) -->
    <!-- ========================================== -->
    <!DOCTYPE html>
    <html lang="id">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Profil & Akun Admin - StudySpot</title>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
        <style>
            :root {
                --primary: hsl(245, 75%, 60%);
                --primary-hover: hsl(245, 75%, 50%);
                --bg-body: hsl(0, 0%, 98%);
                --bg-card: hsl(0, 0%, 100%);
                --text-main: hsl(0, 0%, 10%);
                --text-muted: hsl(0, 0%, 45%);
                --border-light: hsl(0, 0%, 90%);
            }
            * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Inter', sans-serif; }
            body { background-color: var(--bg-body); color: var(--text-main); display: flex; min-height: 100vh; }
            
            /* Sidebar Admin */
            .sidebar { width: 250px; background-color: var(--bg-card); padding: 30px 20px; border-right: 1px solid var(--border-light); flex-shrink: 0; }
            .logo { margin-bottom: 40px; display: block; text-decoration: none; }
            .logo img { height: 45px; border-radius: 8px; object-fit: cover; }
            
            .menu-list { display: flex; flex-direction: column; gap: 8px; }
            .menu-item { padding: 12px 16px; text-decoration: none; color: var(--text-muted); font-weight: 500; font-size: 14px; border-radius: 8px; transition: 0.2s; display: block; }
            .menu-item:hover { background-color: var(--bg-body); color: var(--primary); }
            .menu-item.active { background-color: var(--primary); color: white; font-weight: 600; }
            
            /* Main Content Admin */
            .main-content { flex: 1; padding: 40px 50px; overflow-y: auto; }
            .header h1 { font-size: 24px; font-weight: 700; margin-bottom: 8px; }
            .header p { color: var(--text-muted); font-size: 14px; margin-bottom: 30px; }
            .alert { background-color: #d4edda; color: #155724; padding: 12px; border-radius: 8px; margin-bottom: 20px; font-size: 14px; border: 1px solid #c3e6cb;}
            .grid-container { display: grid; grid-template-columns: 1.5fr 1fr; gap: 24px; align-items: start; }
            .card { background-color: var(--bg-card); border-radius: 16px; padding: 24px; border: 1px solid var(--border-light); margin-bottom: 24px; box-shadow: 0 4px 15px rgba(0,0,0,0.03); }
            .profile-info { display: flex; align-items: center; gap: 20px; }
            .avatar-circle { width: 60px; height: 60px; background-color: var(--primary); color: white; border-radius: 50%; display: flex; justify-content: center; align-items: center; font-size: 20px; font-weight: 700; }
            .user-details h2 { font-size: 18px; margin-bottom: 4px; }
            .user-details p { color: var(--text-muted); font-size: 13px; margin-bottom: 8px; }
            .badge-admin { background-color: #e0e7ff; color: #3730a3; padding: 4px 10px; border-radius: 20px; font-size: 11px; font-weight: 600; display: inline-block; }
            .card-title { font-size: 16px; font-weight: 700; margin-bottom: 20px; }
            .form-row { display: flex; gap: 20px; margin-bottom: 16px; }
            .form-group { flex: 1; }
            .form-group label { display: block; font-size: 13px; font-weight: 500; color: var(--text-muted); margin-bottom: 8px; }
            .form-control { width: 100%; padding: 12px 16px; border: 1px solid var(--border-light); border-radius: 8px; font-size: 14px; outline: none; transition: 0.2s; }
            .form-control:focus { border-color: var(--primary); }
            .btn-container { display: flex; justify-content: flex-end; gap: 12px; margin-top: 24px; }
            .btn { padding: 10px 20px; border-radius: 8px; font-size: 14px; font-weight: 500; cursor: pointer; transition: 0.2s; border: none; }
            .btn-outline { background-color: transparent; border: 1px solid var(--border-light); color: var(--text-muted); }
            .btn-outline:hover { background-color: var(--bg-body); }
            .btn-primary { background-color: var(--primary); color: white; }
            .text-danger { color: #dc3545; font-size: 11px; margin-top: 4px; display: block; }
        </style>
    </head>
    <body>
        <aside class="sidebar">
            <a href="{{ route('dashboard') }}" class="logo">
                <img src="https://i.pinimg.com/736x/3e/b8/b0/3eb8b071563a9ad95f3357976ec32b46.jpg" alt="StudySpot Logo">
            </a>
            <nav class="menu-list">
                <a href="{{ route('dashboard') }}" class="menu-item">Dashboard</a>
                <a href="{{ route('admin.places.index') }}" class="menu-item">Data Tempat</a>
                <a href="{{ route('bookmarks.index') }}" class="menu-item">Tempat Tersimpan</a>
                <a href="#" class="menu-item">Laporan</a>
                <a href="{{ route('profile.edit') }}" class="menu-item active">Pengaturan / Profil</a>
                <form action="{{ route('logout') }}" method="POST" style="margin-top: 20px;">
                    @csrf
                    <button type="submit" class="menu-item" style="width: 100%; text-align: left; background: none; border: none; cursor: pointer; padding: 12px 16px;">Logout</button>
                </form>
            </nav>
        </aside>
        
        <main class="main-content">
            <div class="header">
                <h1>Profil & Akun</h1>
                <p>Kelola informasi pribadi dan keamanan akun Admin Anda.</p>
            </div>
            @if(session('success'))
                <div class="alert">{{ session('success') }}</div>
            @endif
            <div class="grid-container">
                <div class="left-column">
                    <div class="card">
                        <div class="profile-info">
                            <div class="avatar-circle">
                                {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                            </div>
                            <div class="user-details">
                                <h2>{{ Auth::user()->name }}</h2>
                                <p>{{ Auth::user()->email }}</p>
                                <span class="badge-admin">Admin</span>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <h3 class="card-title">Data diri</h3>
                        <form action="{{ route('profile.update') }}" method="POST">
                            @csrf
                            <div class="form-row">
                                <div class="form-group">
                                    <label>Nama lengkap</label>
                                    <input type="text" name="name" class="form-control" value="{{ old('name', Auth::user()->name) }}">
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" name="email" class="form-control" value="{{ old('email', Auth::user()->email) }}">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label>Nomor telepon</label>
                                    <input type="text" name="phone" class="form-control" value="{{ old('phone', Auth::user()->phone) }}">
                                </div>
                                <div class="form-group"></div>
                            </div>
                            <div class="btn-container">
                                <button type="submit" class="btn btn-primary">Simpan perubahan</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="right-column">
                    <div class="card">
                        <h3 class="card-title">Ubah kata sandi</h3>
                        <form action="{{ route('profile.password') }}" method="POST">
                            @csrf
                            <div class="form-group" style="margin-bottom: 16px;">
                                <label>Kata sandi baru</label>
                                <input type="password" name="password" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Konfirmasi</label>
                                <input type="password" name="password_confirmation" class="form-control" required>
                            </div>
                            <div class="btn-container" style="justify-content: flex-start;">
                                <button type="submit" class="btn btn-primary" style="width: 100%;">Perbarui</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </main>
    </body>
    </html>

@else
    <!-- ========================================== -->
    <!-- TAMPILAN PROFIL KHUSUS USER (FULL-WIDTH)   -->
    <!-- ========================================== -->
    <!DOCTYPE html>
    <html lang="id">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Profil Akun - StudySpot</title>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
        <style>
            :root {
                --primary: #4f46e5;
                --primary-light: #e0e7ff;
                --bg-body: #f9fafb;
                --bg-card: #ffffff;
                --text-main: #111827;
                --text-muted: #6b7280;
                --border-light: #e5e7eb;
                --success-bg: #dcfce7;
                --success-text: #166534;
            }
            * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Inter', sans-serif; }
            body { background-color: var(--bg-card); color: var(--text-main); min-height: 100vh; }
            
            /* Navbar User */
            .navbar { display: flex; justify-content: space-between; align-items: center; padding: 16px 5%; border-bottom: 1px solid var(--border-light); }
            .logo { text-decoration: none; display: flex; align-items: center; }
            .logo img { height: 40px; border-radius: 8px; object-fit: cover; }
            
            .nav-links { display: flex; gap: 24px; }
            .nav-links a { text-decoration: none; color: var(--text-muted); font-size: 14px; font-weight: 500; }
            .nav-links a:hover { color: var(--primary); }
            
            /* Container User */
            .container { max-width: 1100px; margin: 0 auto; padding: 40px 20px; }
            
            /* Section */
            .section { margin-bottom: 40px; padding-bottom: 30px; border-bottom: 1px solid var(--border-light); }
            .section:last-child { border-bottom: none; }
            .section-header-title { font-size: 16px; font-weight: 700; margin-bottom: 20px; display: flex; justify-content: space-between; align-items: center; }
            .link-muted { color: var(--text-muted); font-size: 13px; text-decoration: none; font-weight: 500; }
            
            /* Profile Header */
            .profile-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 40px; }
            .profile-info { display: flex; align-items: center; gap: 20px; }
            .avatar { width: 80px; height: 80px; background-color: #cbd5e1; border-radius: 50%; display: flex; justify-content: center; align-items: center; font-size: 24px; font-weight: 700; color: white; }
            .profile-name { font-size: 24px; font-weight: 700; }
            .header-actions { display: flex; gap: 12px; }
            
            /* Buttons */
            .btn { padding: 10px 20px; border-radius: 8px; font-size: 14px; font-weight: 600; cursor: pointer; text-decoration: none; display: inline-block; border: none; }
            .btn-light { background-color: var(--primary-light); color: var(--primary); }
            .btn-primary { background-color: var(--primary); color: white; }
            .btn-outline { background-color: transparent; border: 1px solid var(--border-light); color: var(--text-muted); }
            
            /* Bookmarks Grid */
            .grid-bookmarks { display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; }
            @media (max-width: 768px) { .grid-bookmarks { grid-template-columns: 1fr; } }
            .bookmark-card { border: 1px solid var(--border-light); border-radius: 12px; overflow: hidden; display: flex; flex-direction: column; }
            .thumb-box { height: 140px; background-color: #cbd5e1; }
            .thumb-box img { width: 100%; height: 100%; object-fit: cover; }
            .card-body { padding: 16px; }
            .place-name { font-size: 14px; font-weight: 700; margin-bottom: 4px; }
            .place-sub { font-size: 12px; color: var(--text-muted); margin-bottom: 16px; }
            .btn-full { width: 100%; text-align: center; padding: 10px; background-color: var(--primary-light); color: var(--primary); border-radius: 8px; font-size: 12px; font-weight: 600; text-decoration: none; display: block; }
            
            /* Login Sessions */
            .session-item { display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px; }
            .session-info h4 { font-size: 14px; font-weight: 600; margin-bottom: 4px; }
            .session-info p { font-size: 12px; color: var(--text-muted); }
            .badge-active { background-color: var(--success-bg); color: var(--success-text); padding: 4px 12px; border-radius: 20px; font-size: 12px; font-weight: 500; }
            .btn-text { background: none; border: none; color: var(--text-muted); font-size: 12px; font-weight: 500; cursor: pointer; }
            
            /* Form Data Diri */
            .form-row { display: flex; gap: 24px; margin-bottom: 20px; }
            .form-group { flex: 1; }
            .form-group label { display: block; font-size: 13px; color: var(--text-muted); margin-bottom: 8px; font-weight: 500; }
            .form-control { width: 100%; padding: 12px 16px; border: 1px solid var(--border-light); border-radius: 8px; font-size: 14px; outline: none; }
            .form-control:focus { border-color: var(--primary); }
            .form-actions { display: flex; justify-content: flex-end; gap: 12px; margin-top: 32px; }
            
            .alert { background-color: var(--success-bg); color: var(--success-text); padding: 12px; border-radius: 8px; margin-bottom: 24px; font-size: 14px; }
        </style>
    </head>
    <body>

        <!-- Navbar Minimalis User -->
        <nav class="navbar">
            <a href="{{ route('dashboard') }}" class="logo">
                <img src="https://i.pinimg.com/736x/3e/b8/b0/3eb8b071563a9ad95f3357976ec32b46.jpg" alt="StudySpot Logo">
            </a>
            <div class="nav-links">
                <a href="{{ route('dashboard') }}">Beranda</a>
                <a href="#">Rekomendasi</a>
                <a href="#">Riwayat</a>
            </div>
        </nav>

        <main class="container">
            @if(session('success'))
                <div class="alert">{{ session('success') }}</div>
            @endif

            <!-- Header Profil -->
            <div class="profile-header section">
                <div class="profile-info">
                    <div class="avatar">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                    <div class="profile-name">{{ Auth::user()->name }}</div>
                </div>
                <div class="header-actions">
                    <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" class="btn btn-primary">Keluar Akun</button>
                    </form>
                </div>
            </div>

            <!-- Tempat Tersimpan Favorit -->
            <div class="section">
                <div class="section-header-title">
                    <span>Tempat tersimpan favorit</span>
                    <a href="{{ route('bookmarks.index') }}" class="link-muted">Lihat semua</a>
                </div>

                @php
                    $recentBookmarks = auth()->user()->bookmarkedPlaces()->latest()->take(3)->get();
                @endphp

                <div class="grid-bookmarks">
                    @forelse($recentBookmarks as $place)
                        <div class="bookmark-card">
                            <div class="thumb-box">
                                @if($place->image_url)
                                    <img src="{{ $place->image_url }}" alt="{{ $place->name }}">
                                @endif
                            </div>
                            <div class="card-body">
                                <div class="place-name">{{ $place->name }}</div>
                                <div class="place-sub">{{ $place->location }} · {{ $place->rating ?? '4.5' }}</div>
                                <a href="{{ route('places.show', $place->id) }}" class="btn-full">Buka Rincian</a>
                            </div>
                        </div>
                    @empty
                        <div style="grid-column: 1 / -1; font-size: 14px; color: var(--text-muted);">
                            Belum ada tempat belajar yang disimpan.
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Sesi Login Terbaru -->
            <div class="section">
                <div class="section-header-title">Sesi login terbaru</div>
                <div class="session-item">
                    <div class="session-info">
                        <h4>Chrome · Windows</h4>
                        <p>Malang, ID</p>
                    </div>
                    <span class="badge-active">Sesi ini</span>
                </div>
                <div class="session-item">
                    <div class="session-info">
                        <h4>Chrome Mobile · Android</h4>
                        <p>Malang, ID</p>
                    </div>
                    <button class="btn-text">Keluar</button>
                </div>
            </div>

            <!-- Data Diri Form -->
            <div class="section" style="border-bottom: none;">
                <div class="section-header-title">Data diri</div>
                <form action="{{ route('profile.update') }}" method="POST">
                    @csrf
                    <div class="form-row">
                        <div class="form-group">
                            <label>Nama lengkap</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name', Auth::user()->name) }}">
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" value="{{ old('email', Auth::user()->email) }}">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group" style="flex: 0 0 calc(50% - 12px);">
                            <label>Nomor telepon</label>
                            <input type="text" name="phone" class="form-control" value="{{ old('phone', Auth::user()->phone) }}" placeholder="+62...">
                        </div>
                    </div>
                    <div class="form-actions">
                        <button type="button" class="btn btn-outline" onclick="window.location.reload();">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan perubahan</button>
                    </div>
                </form>
            </div>
        </main>
    </body>
    </html>
@endif