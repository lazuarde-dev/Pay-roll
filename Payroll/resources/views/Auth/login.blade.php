<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem Absensi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f5f7fa;
        }

        .login-container {
            background-image: url('https://images.unsplash.com/photo-1551434678-e076c223a692?q=80&w=2070&auto=format&fit=crop');
            background-size: cover;
            background-position: center;
        }

        .form-input:focus {
            border-color: #10b981;
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
        }

        .error-shake {
            animation: shake 0.82s cubic-bezier(.36, .07, .19, .97) both;
        }

        @keyframes shake {

            10%,
            90% {
                transform: translate3d(-1px, 0, 0);
            }

            20%,
            80% {
                transform: translate3d(2px, 0, 0);
            }

            30%,
            50%,
            70% {
                transform: translate3d(-4px, 0, 0);
            }

            40%,
            60% {
                transform: translate3d(4px, 0, 0);
            }
        }

        .pulse {
            animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }

        @keyframes pulse {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: 0.7;
            }
        }
    </style>
</head>

<body>
    <div class="flex min-h-screen">
        <!-- Left side - Image -->
        <div class="hidden lg:block lg:w-1/2 login-container relative">
            <div class="absolute inset-0 bg-emerald-900/80"></div>
            <div class="absolute inset-0 flex flex-col items-center justify-center text-white p-12">
                <div class="max-w-md">
                    <div class="flex items-center mb-6">
                        <div class="bg-white/20 p-3 rounded-full mr-4">
                            <i data-lucide="clock" class="h-8 w-8"></i>
                        </div>
                        <h1 class="text-4xl font-bold">Sistem Absensi</h1>
                    </div>
                    <p class="text-lg mb-8">Kelola kehadiran karyawan dengan mudah dan efisien menggunakan sistem
                        absensi digital kami.</p>
                    <div class="space-y-4">
                        <div class="flex items-center">
                            <div class="bg-white/20 p-2 rounded-full mr-4">
                                <i data-lucide="check-circle" class="h-5 w-5"></i>
                            </div>
                            <p>Pencatatan kehadiran otomatis dan akurat</p>
                        </div>
                        <div class="flex items-center">
                            <div class="bg-white/20 p-2 rounded-full mr-4">
                                <i data-lucide="calendar" class="h-5 w-5"></i>
                            </div>
                            <p>Laporan absensi real-time dan terpadu</p>
                        </div>
                        <div class="flex items-center">
                            <div class="bg-white/20 p-2 rounded-full mr-4">
                                <i data-lucide="bar-chart" class="h-5 w-5"></i>
                            </div>
                            <p>Analisis produktivitas dan kinerja karyawan</p>
                        </div>
                    </div>

                    <div class="mt-12 flex items-center">
                        <div class="flex -space-x-2 mr-4">
                            <img class="h-10 w-10 rounded-full border-2 border-white"
                                src="https://randomuser.me/api/portraits/women/32.jpg" alt="">
                            <img class="h-10 w-10 rounded-full border-2 border-white"
                                src="https://randomuser.me/api/portraits/men/45.jpg" alt="">
                            <img class="h-10 w-10 rounded-full border-2 border-white"
                                src="https://randomuser.me/api/portraits/women/53.jpg" alt="">
                        </div>
                        <p class="text-sm">Bergabung dengan <span class="font-semibold">1,000+ perusahaan</span> yang
                            telah menggunakan sistem kami</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right side - Login Form -->
        <div class="w-full lg:w-1/2 flex items-center justify-center p-6">
            <div class="w-full max-w-md">
                <div class="text-center mb-10">
                    <div class="inline-block p-4 bg-emerald-50 rounded-full mb-4">
                        <i data-lucide="fingerprint" class="h-10 w-10 text-emerald-600"></i>
                    </div>
                    <h2 class="text-3xl font-bold text-gray-800">Selamat Datang Kembali</h2>
                    <p class="text-gray-600 mt-2">Silakan masuk untuk melanjutkan ke sistem.</p>
                </div>

                <!-- Current Time Display -->
                <div class="mb-6 text-center">
                    <div class="text-sm text-gray-500">Waktu Server</div>
                    <div class="text-xl font-semibold text-gray-800" id="current-time">00:00:00</div>
                    <div class="text-sm text-gray-500" id="current-date">Loading...</div>
                </div>

                <!-- Error Message -->
                <div id="error-message"
                    class="mb-6 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg hidden">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <i data-lucide="alert-circle" class="h-5 w-5 text-red-500"></i>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium">Terjadi Kesalahan!</h3>
                            <div class="mt-2 text-sm">
                                <ul class="list-disc pl-5 space-y-1">
                                    <li>Email atau password yang Anda masukkan salah.</li>
                                </ul>
                            </div>
                        </div>
                        <div class="ml-auto pl-3">
                            <div class="-mx-1.5 -my-1.5">
                                <button type="button"
                                    class="inline-flex rounded-md p-1.5 text-red-500 hover:bg-red-100 focus:outline-none"
                                    onclick="document.getElementById('error-message').classList.add('hidden')">
                                    <i data-lucide="x" class="h-5 w-5"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>


                <form action="{{ route('login.post') }}" method="POST" class="space-y-6" id="login-form">
                    @csrf
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Alamat Email / ID
                            Karyawan</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i data-lucide="user" class="h-5 w-5 text-gray-400"></i>
                            </div>
                            <input id="email" name="email" type="text" autocomplete="email" required
                                class="form-input block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none"
                                placeholder="nama@perusahaan.com atau ID123">
                        </div>
                        <p id="email-error" class="mt-1 text-sm text-red-600 hidden">Email atau password yang Anda
                            masukkan salah.</p>
                    </div>

                    <div>
                        <div class="flex items-center justify-between mb-1">
                            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                            <a href="#" class="text-sm font-medium text-emerald-600 hover:text-emerald-500">Lupa
                                password?</a>
                        </div>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i data-lucide="lock" class="h-5 w-5 text-gray-400"></i>
                            </div>
                            <input id="password" name="password" type="password" autocomplete="current-password"
                                required
                                class="form-input block w-full pl-10 pr-10 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none"
                                placeholder="••••••••">
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                <button type="button" id="toggle-password"
                                    class="text-gray-400 hover:text-gray-500 focus:outline-none">
                                    <i data-lucide="eye" class="h-5 w-5"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center">
                        <input id="remember-me" name="remember-me" type="checkbox"
                            class="h-4 w-4 rounded border-gray-300 text-emerald-600 focus:ring-emerald-500">
                        <label for="remember-me" class="ml-2 block text-sm text-gray-700">Ingat Saya</label>
                    </div>

                    <div>
                        <button type="submit"
                            class="group relative w-full flex justify-center py-3 px-4 border border-transparent rounded-lg text-white bg-emerald-600 hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 shadow-sm transition-all duration-150">
                            <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                                <i data-lucide="log-in"
                                    class="h-5 w-5 text-emerald-500 group-hover:text-emerald-400"></i>
                            </span>
                            Masuk
                        </button>
                    </div>
                </form>

                <div class="mt-6">
                    <div class="relative">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-gray-300"></div>
                        </div>
                        <div class="relative flex justify-center text-sm">
                            <span class="px-2 bg-white text-gray-500">Atau</span>
                        </div>
                    </div>

                    <div class="mt-6">
                        <button type="button"
                            class="w-full inline-flex justify-center items-center py-2.5 px-4 border border-gray-300 rounded-lg shadow-sm bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 transition-all duration-150">
                            <i data-lucide="scan-face" class="h-5 w-5 mr-2 text-emerald-600"></i>
                            <span>Absen dengan Face Recognition</span>
                        </button>
                    </div>
                </div>

                <div class="mt-6 flex justify-center">
                    <div class="inline-flex items-center px-4 py-2 bg-emerald-50 rounded-full">
                        <div class="h-2 w-2 rounded-full bg-green-500 pulse mr-2"></div>
                        <span class="text-sm text-emerald-700">Sistem aktif dan berjalan normal</span>
                    </div>
                </div>

                <p class="mt-8 text-center text-sm text-gray-600">
                    Belum punya akun?
                    <a href="{{ route('register') }}" class="text-emerald-600 hover:underline">Daftar sekarang</a>

                </p>
            </div>
        </div>
    </div>


    <script>
        // Initialize Lucide icons
        lucide.createIcons();

        // Toggle password visibility
        document.getElementById('toggle-password').addEventListener('click', function() {
            const passwordInput = document.getElementById('password');
            const icon = this.querySelector('i');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.setAttribute('data-lucide', 'eye-off');
            } else {
                passwordInput.type = 'password';
                icon.setAttribute('data-lucide', 'eye');
            }

            lucide.createIcons();
        });

        // Form validation with error display
        document.getElementById('login-form').addEventListener('submit', function(event) {
            // For demo purposes, show error message
            // In a real app, this would be handled by server validation
            const showError = Math.random() > 0.7; // 30% chance to show error for demo

            if (showError) {
                event.preventDefault();
                const errorMessage = document.getElementById('error-message');
                errorMessage.classList.remove('hidden');
                errorMessage.classList.add('error-shake');

                // Remove shake animation after it completes
                setTimeout(() => {
                    errorMessage.classList.remove('error-shake');
                }, 1000);

                // Show field-specific error
                document.getElementById('email-error').classList.remove('hidden');
                document.getElementById('email').classList.add('border-red-500');
            }
        });

        // Live clock
        function updateClock() {
            const now = new Date();

            // Format time: HH:MM:SS
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            const seconds = String(now.getSeconds()).padStart(2, '0');
            const timeString = `${hours}:${minutes}:${seconds}`;

            // Format date: Day, DD Month YYYY
            const days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
            const months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September',
                'Oktober', 'November', 'Desember'
            ];

            const day = days[now.getDay()];
            const date = now.getDate();
            const month = months[now.getMonth()];
            const year = now.getFullYear();

            const dateString = `${day}, ${date} ${month} ${year}`;

            document.getElementById('current-time').textContent = timeString;
            document.getElementById('current-date').textContent = dateString;
        }

        // Update clock immediately and then every second
        updateClock();
        setInterval(updateClock, 1000);
    </script>
</body>

</html>
