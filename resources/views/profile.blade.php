<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil & Akun - StudySpot</title>
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

        /* Sidebar */
        .sidebar { width: 250px; background-color: var(--bg-card); padding: 30px 20px; border-right: 1px solid var(--border-light); flex-shrink: 0; }
        .logo { font-size: 20px; font-weight: 700; color: var(--primary); margin-bottom: 40px; display: block; text-decoration: none; }
        .menu-list { display: flex; flex-direction: column; gap: 8px; }
        .menu-item { padding: 12px 16px; text-decoration: none; color: var(--text-muted); font-weight: 500; font-size: 14px; border-radius: 8px; transition: 0.2s; display: block; }
        .menu-item:hover { background-color: var(--bg-body); color: var(--primary); }
        .menu-item.active { background-color: var(--primary); color: white; font-weight: 600; }

        /* Main Content */
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
        .badge { background-color: #e8f5e9; color: #2e7d32; padding: 4px 10px; border-radius: 20px; font-size: 11px; font-weight: 600; display: inline-block; }
        .badge-admin { background-color: #e0e7ff; color: #3730a3; }

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
        .btn-primary:hover { background-color: var(--primary-hover); }
        .text-danger { color: #dc3545; font-size: 11px; margin-top: 4px; display: block; }
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

            <a href="{{ route('bookmarks.index') }}" class="menu-item">Tempat Tersimpan</a>
            <a href="#" class="menu-item">Laporan</a>
            <a href="{{ route('profile.edit') }}" class="menu-item active">Pengaturan / Profil</a>
            
            <form action="{{ route('logout') }}" method="POST" style="margin-top: 20px;">
                @csrf
                <button type="submit" class="menu-item" style="width: 100%; text-align: left; background: none; border: none; cursor: pointer; padding: 12px 16px;">Logout</button>
            </form>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="main-content">
        <div class="header">
            <h1>Profil & Akun</h1>
            <p>Kelola informasi pribadi dan keamanan akun Anda.</p>
        </div>

        @if(session('success'))
            <div class="alert">{{ session('success') }}</div>
        @endif

        <div class="grid-container">
            <!-- Kiri: Info & Data Diri -->
            <div class="left-column">
                <div class="card">
                    <div class="profile-info">
                        <div class="avatar-circle">
                            {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                        </div>
                        <div class="user-details">
                            <h2>{{ Auth::user()->name }}</h2>
                            <p>{{ Auth::user()->email }}</p>
                            <span class="badge {{ auth()->user()->role === 'admin' ? 'badge-admin' : '' }}">
                                {{ ucfirst(auth()->user()->role) }}
                            </span>
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
                                @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control" value="{{ old('email', Auth::user()->email) }}">
                                @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label>Nomor telepon</label>
                                <input type="text" name="phone" class="form-control" value="{{ old('phone', Auth::user()->phone) }}" placeholder="+62...">
                                @error('phone') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group"></div>
                        </div>
                        <div class="btn-container">
                            <button type="button" class="btn btn-outline" onclick="window.location.reload();">Batal</button>
                            <button type="submit" class="btn btn-primary">Simpan perubahan</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Kanan: Form Ubah Kata Sandi -->
            <div class="right-column">
                <div class="card">
                    <h3 class="card-title">Ubah kata sandi</h3>
                    <form action="{{ route('profile.password') }}" method="POST">
                        @csrf
                        <div class="form-group" style="margin-bottom: 16px;">
                            <label>Kata sandi baru</label>
                            <input type="password" name="password" class="form-control" required>
                            @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label>Konfirmasi</label>
                            <input type="password" name="password_confirmation" class="form-control" required placeholder="Ulangi kata sandi">
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