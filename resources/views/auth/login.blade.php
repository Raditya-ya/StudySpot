<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk - StudySpot</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #4f46e5;
            --primary-hover: #4338ca;
            --primary-ring: rgba(79, 70, 229, 0.15);
            --text-main: #111827;
            --text-muted: #6b7280;
            --border-color: #e5e7eb;
            --bg-input: #f9fafb;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }

        body {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 24px;
            background-image:
                linear-gradient(135deg, rgba(15, 23, 42, 0.75), rgba(49, 46, 129, 0.68)),
                url('https://asset.kompas.com/crops/RYjJsmoAuuXjqBsezSeRurgaFDI=/0x0:780x520/1200x800/data/photo/2021/12/01/61a72dbab526d.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }

        .auth-wrapper {
            width: 100%;
            max-width: 900px;
            display: grid;
            grid-template-columns: 1fr 1.05fr;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.45);
            border: 1px solid rgba(255, 255, 255, 0.18);
        }

        /* Panel Kiri: Showcase StudySpot */
        .brand-panel {
            background: rgba(17, 24, 39, 0.62);
            backdrop-filter: blur(18px);
            -webkit-backdrop-filter: blur(18px);
            color: #ffffff;
            padding: 44px 38px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .brand-top {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .brand-top img {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            object-fit: cover;
            border: 2px solid rgba(255, 255, 255, 0.25);
        }

        .brand-top span {
            font-size: 20px;
            font-weight: 800;
            letter-spacing: -0.3px;
        }

        .brand-copy {
            margin: 32px 0;
        }

        .brand-badge {
            display: inline-block;
            background: rgba(99, 102, 241, 0.28);
            border: 1px solid rgba(165, 180, 252, 0.35);
            color: #c7d2fe;
            font-size: 11px;
            font-weight: 600;
            padding: 5px 12px;
            border-radius: 999px;
            margin-bottom: 16px;
        }

        .brand-copy h2 {
            font-size: 26px;
            font-weight: 700;
            line-height: 1.3;
            margin-bottom: 12px;
        }

        .brand-copy p {
            font-size: 13.5px;
            color: #d1d5db;
            line-height: 1.6;
        }

        .feature-pills {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .feature-item {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 12.5px;
            color: #e5e7eb;
            background: rgba(255, 255, 255, 0.08);
            padding: 10px 14px;
            border-radius: 12px;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .feature-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background-color: #34d399;
            flex-shrink: 0;
        }

        /* Panel Kanan: Form Login */
        .form-panel {
            background-color: #ffffff;
            padding: 44px 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .mobile-logo {
            display: none;
            align-items: center;
            gap: 10px;
            margin-bottom: 18px;
        }

        .mobile-logo img {
            width: 38px;
            height: 38px;
            border-radius: 10px;
            object-fit: cover;
        }

        .mobile-logo span {
            font-size: 18px;
            font-weight: 800;
            color: var(--text-main);
        }

        .form-header {
            margin-bottom: 26px;
        }

        .form-header h1 {
            font-size: 24px;
            font-weight: 700;
            color: var(--text-main);
            margin-bottom: 6px;
        }

        .form-header p {
            font-size: 13.5px;
            color: var(--text-muted);
        }

        .alert-box {
            padding: 10px 14px;
            border-radius: 10px;
            font-size: 12.5px;
            font-weight: 500;
            margin-bottom: 18px;
        }

        .alert-error {
            background-color: #fef2f2;
            color: #dc2626;
            border: 1px solid #fecaca;
        }

        .alert-success {
            background-color: #dcfce7;
            color: #15803d;
            border: 1px solid #bbf7d0;
        }

        .form-group {
            margin-bottom: 18px;
        }

        .form-group label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: #374151;
            margin-bottom: 7px;
        }

        .input-wrapper {
            position: relative;
            display: flex;
            align-items: center;
        }

        .input-icon {
            position: absolute;
            left: 14px;
            color: #9ca3af;
            display: flex;
            align-items: center;
            pointer-events: none;
            transition: color 0.2s;
        }

        .form-group input {
            width: 100%;
            padding: 12px 42px 12px 42px;
            border: 1.5px solid var(--border-color);
            border-radius: 12px;
            font-size: 14px;
            color: var(--text-main);
            background-color: var(--bg-input);
            outline: none;
            transition: all 0.2s ease;
        }

        .form-group input:focus {
            border-color: var(--primary);
            background-color: #ffffff;
            box-shadow: 0 0 0 4px var(--primary-ring);
        }

        .input-wrapper:focus-within .input-icon {
            color: var(--primary);
        }

        .toggle-password {
            position: absolute;
            right: 14px;
            background: none;
            border: none;
            cursor: pointer;
            color: #9ca3af;
            display: flex;
            align-items: center;
            padding: 4px;
            transition: color 0.2s;
        }

        .toggle-password:hover {
            color: var(--primary);
        }

        .btn-submit {
            width: 100%;
            padding: 13px;
            background: linear-gradient(135deg, #4f46e5, #6366f1);
            color: #ffffff;
            border: none;
            border-radius: 12px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: transform 0.15s ease, box-shadow 0.2s ease;
            margin-top: 6px;
            box-shadow: 0 6px 18px rgba(79, 70, 229, 0.28);
        }

        .btn-submit:hover {
            background: linear-gradient(135deg, #4338ca, #4f46e5);
            transform: translateY(-1px);
            box-shadow: 0 8px 22px rgba(79, 70, 229, 0.36);
        }

        .btn-submit:active {
            transform: translateY(0);
        }

        .footer-text {
            text-align: center;
            margin-top: 24px;
            padding-top: 20px;
            border-top: 1px solid #f3f4f6;
            font-size: 13px;
            color: var(--text-muted);
        }

        .footer-text a {
            color: var(--primary);
            text-decoration: none;
            font-weight: 600;
        }

        .footer-text a:hover {
            text-decoration: underline;
        }

        .error-message {
            color: #dc2626;
            font-size: 12px;
            margin-top: 6px;
            display: block;
        }

        @media (max-width: 820px) {
            .auth-wrapper {
                grid-template-columns: 1fr;
                max-width: 440px;
            }
            .brand-panel {
                display: none;
            }
            .mobile-logo {
                display: flex;
            }
            .form-panel {
                padding: 36px 28px;
            }
        }
    </style>
</head>
<body>

    <div class="auth-wrapper">
        <!-- Panel Kiri -->
        <div class="brand-panel">
            <div class="brand-top">
                <img src="https://i.pinimg.com/736x/3e/b8/b0/3eb8b071563a9ad95f3357976ec32b46.jpg" alt="StudySpot Logo">
                <span>StudySpot</span>
            </div>

            <div class="brand-copy">
                <span class="brand-badge">Teman Belajar Mahasiswa</span>
                <h2>Temukan ruang fokus terbaik di sekitarmu.</h2>
                <p>Cek ketersediaan kursi, kecepatan Wi-Fi, tingkat kebisingan, hingga catatan pengalaman langsung dari mahasiswa lain.</p>
            </div>

            <div class="feature-pills">
                <div class="feature-item">
                    <span class="feature-dot"></span>
                    <span>Informasi kursi kosong & jam buka terkini</span>
                </div>
                <div class="feature-item">
                    <span class="feature-dot"></span>
                    <span>Filter rekomendasi sesuai kriteria belajarmu</span>
                </div>
                <div class="feature-item">
                    <span class="feature-dot"></span>
                    <span>Simpan tempat favorit & bagikan ulasan</span>
                </div>
            </div>
        </div>

        <!-- Panel Kanan: Form Login -->
        <div class="form-panel">
            <div class="mobile-logo">
                <img src="https://i.pinimg.com/736x/3e/b8/b0/3eb8b071563a9ad95f3357976ec32b46.jpg" alt="StudySpot Logo">
                <span>StudySpot</span>
            </div>

            <div class="form-header">
                <h1>Selamat Datang 👋</h1>
                <p>Masuk untuk mencari tempat belajar favoritmu.</p>
            </div>

            @if(session('status'))
                <div class="alert-box alert-success">{{ session('status') }}</div>
            @endif

            @if(session('error'))
                <div class="alert-box alert-error">{{ session('error') }}</div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-group">
                    <label for="email">Email</label>
                    <div class="input-wrapper">
                        <span class="input-icon">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                        </span>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="Masukkan email kamu" required autofocus>
                    </div>
                    @error('email')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password">Kata Sandi</label>
                    <div class="input-wrapper">
                        <span class="input-icon">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                        </span>
                        <input type="password" id="password" name="password" placeholder="Masukkan kata sandi" required>
                        <button type="button" class="toggle-password" id="toggleBtn" title="Tampilkan/Sembunyikan Sandi">
                            <svg width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                <circle cx="12" cy="12" r="3"></circle>
                            </svg>
                        </button>
                    </div>
                    @error('password')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit" class="btn-submit">Masuk ke StudySpot</button>
            </form>

            <div class="footer-text">
                Belum punya akun? <a href="{{ route('register') }}">Daftar di sini</a>
            </div>
        </div>
    </div>

    <script>
        const toggleBtn = document.getElementById('toggleBtn');
        const passwordInput = document.getElementById('password');

        toggleBtn.addEventListener('click', function () {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);

            if (type === 'text') {
                this.innerHTML = `<svg width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path><line x1="1" y1="1" x2="23" y2="23"></line></svg>`;
            } else {
                this.innerHTML = `<svg width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>`;
            }
        });
    </script>
</body>
</html>