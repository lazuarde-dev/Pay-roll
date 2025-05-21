<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - E-Library Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f5f7fa;
        }
        .login-container {
            background-image: url('https://images.unsplash.com/photo-1507842217343-583bb7270b66?q=80&w=2940&auto=format&fit=crop');
            background-size: cover;
            background-position: center;
        }
        .form-input:focus {
            border-color: #10b981;
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
        }
        .error-shake {
            animation: shake 0.82s cubic-bezier(.36,.07,.19,.97) both;
        }
        @keyframes shake {
            10%, 90% { transform: translate3d(-1px, 0, 0); }
            20%, 80% { transform: translate3d(2px, 0, 0); }
            30%, 50%, 70% { transform: translate3d(-4px, 0, 0); }
            40%, 60% { transform: translate3d(4px, 0, 0); }
        }
    </style>
</head>
<body>
    <div class="flex min-h-screen">
        <!-- Left side - Image -->
        <div class="hidden lg:block lg:w-1/2 login-container relative">
            <div class="absolute inset-0 bg-emerald-900/70"></div>
            <div class="absolute inset-0 flex flex-col items-center justify-center text-white p-12">
                <div class="max-w-md">
                    <h1 class="text-4xl font-bold mb-6">E-Library Admin Portal</h1>
                    <p class="text-lg mb-8">Manage your library collection efficiently with our comprehensive admin dashboard.</p>
                    <div class="space-y-4">
                        <div class="flex items-center">
                            <div class="bg-white/20 p-2 rounded-full mr-4">
                                <i data-lucide="check" class="h-5 w-5"></i>
                            </div>
                            <p>Comprehensive book management system</p>
                        </div>
                        <div class="flex items-center">
                            <div class="bg-white/20 p-2 rounded-full mr-4">
                                <i data-lucide="check" class="h-5 w-5"></i>
                            </div>
                            <p>Track borrowing history and availability</p>
                        </div>
                        <div class="flex items-center">
                            <div class="bg-white/20 p-2 rounded-full mr-4">
                                <i data-lucide="check" class="h-5 w-5"></i>
                            </div>
                            <p>Generate detailed reports and analytics</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right side - Login Form -->
        <div class="w-full lg:w-1/2 flex items-center justify-center p-6">
            <div class="w-full max-w-md">
                <div class="text-center mb-10">
                    <div class="inline-block p-4 bg-emerald-50 rounded-full mb-4">
                        <i data-lucide="book-open" class="h-10 w-10 text-emerald-600"></i>
                    </div>
                    <h2 class="text-3xl font-bold text-gray-800">Selamat Datang Kembali</h2>
                    <p class="text-gray-600 mt-2">Silakan masuk untuk melanjutkan ke sistem.</p>
                </div>

                <!-- Error Message -->
                <div id="error-message" class="mb-6 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg hidden">
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
                                <button type="button" class="inline-flex rounded-md p-1.5 text-red-500 hover:bg-red-100 focus:outline-none" onclick="document.getElementById('error-message').classList.add('hidden')">
                                    <i data-lucide="x" class="h-5 w-5"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <form action="dashboard.html" method="GET" class="space-y-6" id="login-form">
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Alamat Email</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i data-lucide="mail" class="h-5 w-5 text-gray-400"></i>
                            </div>
                            <input id="email" name="email" type="email" autocomplete="email" required 
                                class="form-input block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none"
                                placeholder="nama@perusahaan.com">
                        </div>
                        <p id="email-error" class="mt-1 text-sm text-red-600 hidden">Email atau password yang Anda masukkan salah.</p>
                    </div>

                    <div>
                        <div class="flex items-center justify-between mb-1">
                            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                            <a href="#" class="text-sm font-medium text-emerald-600 hover:text-emerald-500">Lupa password?</a>
                        </div>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i data-lucide="lock" class="h-5 w-5 text-gray-400"></i>
                            </div>
                            <input id="password" name="password" type="password" autocomplete="current-password" required 
                                class="form-input block w-full pl-10 pr-10 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none"
                                placeholder="••••••••">
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                <button type="button" id="toggle-password" class="text-gray-400 hover:text-gray-500 focus:outline-none">
                                    <i data-lucide="eye" class="h-5 w-5"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center">
                        <input id="remember-me" name="remember-me" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-emerald-600 focus:ring-emerald-500">
                        <label for="remember-me" class="ml-2 block text-sm text-gray-700">Ingat Saya</label>
                    </div>

                    <div>
                        <button type="submit" class="group relative w-full flex justify-center py-3 px-4 border border-transparent rounded-lg text-white bg-emerald-600 hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 shadow-sm transition-all duration-150">
                            <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                                <i data-lucide="log-in" class="h-5 w-5 text-emerald-500 group-hover:text-emerald-400"></i>
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
                            <span class="px-2 bg-white text-gray-500">Atau masuk dengan</span>
                        </div>
                    </div>

                    <div class="mt-6 grid grid-cols-2 gap-3">
                        <button type="button" class="inline-flex justify-center items-center py-2.5 px-4 border border-gray-300 rounded-lg shadow-sm bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 transition-all duration-150">
                            <svg class="h-5 w-5 mr-2" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M22.56 12.25C22.56 11.47 22.49 10.72 22.36 10H12V14.26H17.92C17.66 15.63 16.88 16.79 15.71 17.57V20.34H19.28C21.36 18.42 22.56 15.6 22.56 12.25Z" fill="#4285F4"/>
                                <path d="M12 23C14.97 23 17.46 22.02 19.28 20.34L15.71 17.57C14.73 18.23 13.48 18.63 12 18.63C9.13 18.63 6.72 16.69 5.82 14.09H2.12V16.95C3.94 20.53 7.8 23 12 23Z" fill="#34A853"/>
                                <path d="M5.82 14.09C5.6 13.43 5.48 12.73 5.48 12C5.48 11.27 5.6 10.57 5.82 9.91V7.05H2.12C1.41 8.57 1 10.24 1 12C1 13.76 1.41 15.43 2.12 16.95L5.82 14.09Z" fill="#FBBC05"/>
                                <path d="M12 5.37C13.62 5.37 15.06 5.94 16.21 7.02L19.36 3.87C17.45 2.09 14.97 1 12 1C7.8 1 3.94 3.47 2.12 7.05L5.82 9.91C6.72 7.31 9.13 5.37 12 5.37Z" fill="#EA4335"/>
                            </svg>
                            <span>Google</span>
                        </button>
                        <button type="button" class="inline-flex justify-center items-center py-2.5 px-4 border border-gray-300 rounded-lg shadow-sm bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 transition-all duration-150">
                            <svg class="h-5 w-5 mr-2" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M12 0C5.37 0 0 5.37 0 12C0 17.31 3.435 21.795 8.205 23.385C8.805 23.49 9.03 23.13 9.03 22.815C9.03 22.53 9.015 21.585 9.015 20.58C6 21.135 5.22 19.845 4.98 19.17C4.845 18.825 4.26 17.76 3.75 17.475C3.33 17.25 2.73 16.695 3.735 16.68C4.68 16.665 5.355 17.55 5.58 17.91C6.66 19.725 8.385 19.215 9.075 18.9C9.18 18.12 9.495 17.595 9.84 17.295C7.17 16.995 4.38 15.96 4.38 11.37C4.38 10.065 4.845 8.985 5.61 8.145C5.49 7.845 5.07 6.615 5.73 4.965C5.73 4.965 6.735 4.65 9.03 6.195C9.99 5.925 11.01 5.79 12.03 5.79C13.05 5.79 14.07 5.925 15.03 6.195C17.325 4.635 18.33 4.965 18.33 4.965C18.99 6.615 18.57 7.845 18.45 8.145C19.215 8.985 19.68 10.05 19.68 11.37C19.68 15.975 16.875 16.995 14.205 17.295C14.64 17.67 15.015 18.39 15.015 19.515C15.015 21.12 15 22.41 15 22.815C15 23.13 15.225 23.505 15.825 23.385C18.2072 22.5807 20.2772 21.0497 21.7437 19.0074C23.2101 16.965 23.9993 14.5143 24 12C24 5.37 18.63 0 12 0Z" fill="currentColor"/>
                            </svg>
                            <span>GitHub</span>
                        </button>
                    </div>
                </div>

                <p class="mt-8 text-center text-sm text-gray-600">
                    Belum punya akun?
                    <a class="nav-link {{ request()->routeIs('Auth.register.*') ? 'active' : '' }}"
                        href="{{ route('Auth.register') }}"></a>
                </p>
            </div>
        </div>
    </div>

    <footer class="absolute bottom-0 w-full py-4 text-center text-gray-500 text-sm">
        <p>E-Library Admin © 2025. All rights reserved.</p>
    </footer>

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
    </script>
</body>
</html>
