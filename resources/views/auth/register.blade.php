<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - StudySpot</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }

        body {
            /* Ganti URL di bawah dengan path gambar background cafe Anda */
            background-image: url('https://via.placeholder.com/1920x1080?text=Background+Cafe'); 
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .register-container {
            background-color: rgba(248, 249, 250, 0.95);
            padding: 35px 40px;
            border-radius: 20px;
            width: 100%;
            max-width: 420px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        }

        .header {
            text-align: center;
            margin-bottom: 25px;
        }

        .header h1 {
            font-size: 22px;
            color: #1a1a1a;
            font-weight: 700;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
        }

        .header p {
            font-size: 13px;
            color: #666;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: #333;
            margin-bottom: 6px;
        }

        .input-wrapper {
            position: relative;
            display: flex;
            align-items: center;
        }

        .form-group input {
            width: 100%;
            padding: 10px 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 13px;
            outline: none;
            transition: border-color 0.3s;
            background-color: #fff;
        }

        .form-group input:focus {
            border-color: #1fc77c; /* Warna fokus hijau menyesuaikan tombol */
        }

        .toggle-password {
            position: absolute;
            right: 15px;
            background: none;
            border: none;
            cursor: pointer;
            color: #999;
            display: flex;
            align-items: center;
        }

        .toggle-password:hover {
            color: #555;
        }

        .btn-submit {
            width: 100%;
            padding: 12px;
            background-color: #17c978; /* Warna hijau sesuai desain */
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s;
            margin-top: 15px;
        }

        .btn-submit:hover {
            background-color: #13a863;
        }

        .footer-text {
            text-align: center;
            margin-top: 20px;
            font-size: 12px;
            color: #666;
        }

        .footer-text a {
            color: #13a863;
            text-decoration: none;
            font-weight: 700;
        }

        .footer-text a:hover {
            text-decoration: underline;
        }

        .error-message {
            color: #dc3545;
            font-size: 11px;
            margin-top: 4px;
            display: block;
        }
    </style>
</head>
<body>

    <div class="register-container">
        <div class="header">
            <h1>Daftar StudySpot 🎓</h1>
            <p>Buat akun untuk kemudahan mencari tempat belajar.</p>
        </div>

        <!-- Form mengarah ke route register Laravel -->
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="form-group">
                <label for="name">Nama Lengkap</label>
                <div class="input-wrapper">
                    <input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="Masukkan nama lengkap" required autofocus>
                </div>
                @error('name')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <div class="input-wrapper">
                    <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="Masukkan email kamu" required>
                </div>
                @error('email')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Kata Sandi</label>
                <div class="input-wrapper">
                    <input type="password" id="password" name="password" placeholder="Minimal 6 karakter" required>
                    <button type="button" class="toggle-password" onclick="toggleVisibility('password', this)">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                            <circle cx="12" cy="12" r="3"></circle>
                        </svg>
                    </button>
                </div>
                @error('password')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password_confirmation">Konfirmasi Kata Sandi</label>
                <div class="input-wrapper">
                    <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Ulangi kata sandi" required>
                    <button type="button" class="toggle-password" onclick="toggleVisibility('password_confirmation', this)">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                            <circle cx="12" cy="12" r="3"></circle>
                        </svg>
                    </button>
                </div>
            </div>

        <!-- Pilihan Role (Letakkan di atas tombol daftar) -->
        <div style="margin-bottom: 16px;">
            <label for="role" style="display: block; font-size: 14px; font-weight: 500; margin-bottom: 8px;">Mendaftar sebagai:</label>
            <select name="role" id="role" required style="width: 100%; padding: 12px; border-radius: 8px; border: 1px solid #e5e7eb; font-size: 14px;">
                <option value="user">Pengguna Biasa (Mahasiswa)</option>
                <option value="admin">Admin StudySpot</option>
            </select>
        </div>
            <button type="submit" class="btn-submit">Daftar Akun</button>
        </form>

        <div class="footer-text">
            Sudah punya akun? <a href="{{ route('login') }}">Masuk di sini</a>
        </div>
    </div>

    <!-- Script interaktif untuk tombol hide/show password -->
    <script>
        function toggleVisibility(inputId, btn) {
            const input = document.getElementById(inputId);
            const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
            input.setAttribute('type', type);
            
            if (type === 'text') {
                btn.innerHTML = `<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path><line x1="1" y1="1" x2="23" y2="23"></line></svg>`;
            } else {
                btn.innerHTML = `<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>`;
            }
        }
    </script>
</body>
</html>