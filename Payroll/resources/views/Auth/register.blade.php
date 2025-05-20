<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }} - Registrasi Akun</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        body {
            background-color: #f0f2f5; /* Warna latar yang sedikit berbeda dari login */
        }
        .register-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px 0;
        }
        .card {
            border: none;
            border-radius: 0.75rem;
        }
        .form-control {
            border-radius: 0.5rem;
        }
        .btn-primary {
            border-radius: 0.5rem;
        }
        .password-toggle {
            cursor: pointer;
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            color: #6c757d;
        }
        .social-btn {
            border-radius: 0.5rem;
            font-size: 0.9rem;
            padding: 0.6rem 1rem;
        }
        .social-btn i {
            margin-right: 0.5rem;
        }
    </style>
</head>
<body>
    <div class="container register-container">
        <div class="col-md-7 col-lg-6">
            <div class="card shadow-lg">
                <div class="card-header bg-dark text-white text-center py-3">
                    <h4>Buat Akun Baru</h4>
                </div>
                <div class="card-body p-4 p-md-5">
                    @include('partials._alerts') {{-- Sertakan partials alert jika ada --}}

                    <form method="POST" action="{{ route('register.post') }}" id="registrationForm">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="first_name" class="form-label">Nama Depan <span class="text-danger">*</span></label>
                                <input type="text" name="first_name" id="first_name" class="form-control @error('first_name') is-invalid @enderror" value="{{ old('first_name') }}" required autofocus>
                                @error('first_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="last_name" class="form-label">Nama Belakang <span class="text-danger">*</span></label>
                                <input type="text" name="last_name" id="last_name" class="form-control @error('last_name') is-invalid @enderror" value="{{ old('last_name') }}" required>
                                @error('last_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Alamat Email <span class="text-danger">*</span></label>
                            <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required placeholder="cth: email@example.com">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3 position-relative">
                            <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                            <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" required aria-describedby="passwordHelpBlock">
                            <span class="password-toggle" onclick="togglePasswordVisibility('password', 'password-icon')">
                                <i class="bi bi-eye-slash" id="password-icon"></i>
                            </span>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @else
                                <div id="passwordHelpBlock" class="form-text">
                                    Password minimal 8 karakter, mengandung huruf besar, huruf kecil, angka, dan simbol.
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3 position-relative">
                            <label for="password_confirmation" class="form-label">Konfirmasi Password <span class="text-danger">*</span></label>
                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
                            <span class="password-toggle" onclick="togglePasswordVisibility('password_confirmation', 'password-confirm-icon')">
                                <i class="bi bi-eye-slash" id="password-confirm-icon"></i>
                            </span>
                        </div>

                        <div class="mb-3">
                            <label for="role" class="form-label">Daftar Sebagai <span class="text-danger">*</span></label>
                            <select name="role" id="role" class="form-select @error('role') is-invalid @enderror" required>
                                <option value="" disabled {{ old('role') ? '' : 'selected' }}>Pilih Peran...</option>
                                <option value="karyawan" {{ old('role') == 'karyawan' ? 'selected' : '' }}>Karyawan</option>
                                {{-- Logika untuk menampilkan role admin bisa diatur di controller atau config --}}
                                {{-- Contoh: Hanya jika tidak ada admin lain, atau user tertentu boleh mendaftar sbg admin --}}
                                @if(App\Models\User::where('role', 'admin')->count() == 0 || (Auth::check() && Auth::user()->isAdmin()))
                                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                                @endif
                            </select>
                            @error('role')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3 form-check">
                            <input type="checkbox" name="terms" id="terms" class="form-check-input @error('terms') is-invalid @enderror" value="1" {{ old('terms') ? 'checked' : '' }} required>
                            <label class="form-check-label" for="terms">
                                Saya setuju dengan <a href="/terms-and-conditions" target="_blank">Syarat dan Ketentuan</a> yang berlaku <span class="text-danger">*</span>
                            </label>
                            @error('terms')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid mb-3">
                            <button type="submit" class="btn btn-primary btn-lg">Daftar Akun</button>
                        </div>

                        <div class="text-center mb-3">
                            <small class="text-muted">Sudah punya akun? <a href="{{ route('login') }}">Login di sini</a></small>
                        </div>

                        <hr>

                        <p class="text-center text-muted mb-3">Atau daftar dengan:</p>
                        <div class="row g-2">
                            <div class="col">
                                <button type="button" class="btn btn-outline-danger w-100 social-btn">
                                    <i class="bi bi-google"></i> Google
                                </button>
                            </div>
                            <div class="col">
                                <button type="button" class="btn btn-outline-primary w-100 social-btn">
                                    <i class="bi bi-facebook"></i> Facebook
                                </button>
                            </div>
                            {{-- Tambah provider lain jika perlu --}}
                        </div>
                    </form>
                </div>
            </div>
            <div class="text-center mt-4">
                <small class="text-muted">{{ config('app.name', 'Sistem Absensi & Gaji') }} © {{ date('Y') }}</small>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function togglePasswordVisibility(fieldId, iconId) {
            const passwordField = document.getElementById(fieldId);
            const passwordIcon = document.getElementById(iconId);
            if (passwordField.type === "password") {
                passwordField.type = "text";
                passwordIcon.classList.remove("bi-eye-slash");
                passwordIcon.classList.add("bi-eye");
            } else {
                passwordField.type = "password";
                passwordIcon.classList.remove("bi-eye");
                passwordIcon.classList.add("bi-eye-slash");
            }
        }

        // Optional: Client-side password validation feedback (basic example)
        const passwordInput = document.getElementById('password');
        if (passwordInput) {
            passwordInput.addEventListener('input', function() {
                const password = this.value;
                const helpBlock = document.getElementById('passwordHelpBlock');
                let messages = [];

                if (password.length < 8) messages.push("Minimal 8 karakter.");
                if (!/[A-Z]/.test(password)) messages.push("Mengandung huruf besar.");
                if (!/[a-z]/.test(password)) messages.push("Mengandung huruf kecil.");
                if (!/\d/.test(password)) messages.push("Mengandung angka.");
                if (!/\W/.test(password)) messages.push("Mengandung simbol."); // \W matches non-alphanumeric

                if (messages.length > 0) {
                    helpBlock.innerHTML = "Password harus: " + messages.join(" ");
                    helpBlock.classList.remove('text-success');
                    helpBlock.classList.add('text-danger');
                } else {
                    helpBlock.innerHTML = "Kekuatan password baik.";
                    helpBlock.classList.remove('text-danger');
                    helpBlock.classList.add('text-success');
                }
            });
        }
    </script>
</body>
</html>