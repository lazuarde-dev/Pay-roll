<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Sistem Payroll') }} - @yield('title')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- CSS Frameworks -->
 
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    @stack('styles') <!-- Untuk custom styles per halaman -->

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8f9fa;
        }
        
        /* Custom Navigation Styles - Enhanced */
        .navbar-custom {
            background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%) !important;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
            padding: 1rem 0;
            border-bottom: 3px solid #10b981;
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            position: relative;
            padding-left: 3rem;
            color: #ffffff !important;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .navbar-brand:hover {
            color: #10b981 !important;
            transform: translateX(5px);
        }

        .navbar-brand::before {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 2rem;
            height: 2rem;
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            border-radius: 0.5rem;
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.4);
        }

        .navbar-brand::after {
            content: '';
            position: absolute;
            left: 0.375rem;
            top: 50%;
            transform: translateY(-50%);
            width: 1.25rem;
            height: 1.25rem;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='white' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='M20 6L9 17l-5-5'/%3E%3C/svg%3E");
            background-size: contain;
            background-repeat: no-repeat;
        }

        .nav-link {
            position: relative;
            padding: 0.75rem 1.25rem !important;
            font-weight: 500;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            color: #e2e8f0 !important;
            border-radius: 0.5rem;
            margin: 0 0.25rem;
        }

        .nav-link:hover {
            color: #10b981 !important;
            background-color: rgba(16, 185, 129, 0.1);
            transform: translateY(-2px);
        }

        .nav-link.active {
            color: #10b981 !important;
            font-weight: 600;
            background-color: rgba(16, 185, 129, 0.15);
            box-shadow: 0 0 0 1px rgba(16, 185, 129, 0.3);
        }

        .nav-link.active::after {
            content: '';
            position: absolute;
            bottom: -0.5rem;
            left: 50%;
            transform: translateX(-50%);
            width: 80%;
            height: 3px;
            background: linear-gradient(90deg, #10b981, #059669);
            border-radius: 2px;
        }

        .dropdown-menu {
            border: none;
            border-radius: 0.75rem;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
            padding: 0.75rem;
            margin-top: 0.75rem;
            background-color: #ffffff;
            min-width: 200px;
        }

        .dropdown-item {
            border-radius: 0.5rem;
            padding: 0.75rem 1rem;
            transition: all 0.2s ease;
            font-weight: 500;
            color: #374151;
        }

        .dropdown-item:hover {
            background-color: #f0fdf4;
            color: #10b981;
            transform: translateX(5px);
        }

        .dropdown-item:active {
            background-color: #10b981;
            color: white;
        }

        .navbar-toggler {
            border: 2px solid #10b981;
            padding: 0.5rem;
            border-radius: 0.5rem;
            transition: all 0.3s ease;
        }

        .navbar-toggler:focus {
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.25);
        }

        .navbar-toggler:hover {
            background-color: rgba(16, 185, 129, 0.1);
        }

        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%2310b981' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cline x1='3' y1='12' x2='21' y2='12'%3E%3C/line%3E%3Cline x1='3' y1='6' x2='21' y2='6'%3E%3C/line%3E%3Cline x1='3' y1='18' x2='21' y2='18'%3E%3C/line%3E%3C/svg%3E");
        }

        /* User dropdown styling */
        .user-dropdown .dropdown-toggle {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            background-color: rgba(16, 185, 129, 0.1);
            border: 1px solid rgba(16, 185, 129, 0.3);
            padding: 0.5rem 1rem;
            border-radius: 0.75rem;
            transition: all 0.3s ease;
        }

        .user-dropdown .dropdown-toggle:hover {
            background-color: rgba(16, 185, 129, 0.2);
            border-color: #10b981;
        }

        .user-dropdown .dropdown-toggle::after {
            margin-left: 0.5rem;
        }

        /* Page header styling */
        .page-header {
            background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
            border-bottom: 1px solid #e2e8f0;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            padding: 1.5rem 0;
        }

        .page-header h1 {
            color: #1f2937;
            font-weight: 700;
            font-size: 1.875rem;
            margin: 0;
        }

        /* Breadcrumb styling */
        .breadcrumb-nav {
            background: transparent;
            padding: 0;
            margin: 0;
        }

        .breadcrumb-nav .breadcrumb-item {
            color: #6b7280;
            font-weight: 500;
        }

        .breadcrumb-nav .breadcrumb-item.active {
            color: #10b981;
        }

        .breadcrumb-nav .breadcrumb-item + .breadcrumb-item::before {
            content: "›";
            color: #d1d5db;
            font-weight: bold;
        }

        /* Responsive adjustments */
        @media (max-width: 991.98px) {
            .navbar-collapse {
                background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
                border-radius: 0.75rem;
                padding: 1.5rem;
                margin-top: 1rem;
                box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
            }

            .nav-link.active::after {
                left: 0;
                right: 0;
                width: 100%;
                transform: none;
                bottom: -0.25rem;
            }

            .navbar-brand {
                font-size: 1.25rem;
                padding-left: 2.5rem;
            }

            .navbar-brand::before {
                width: 1.5rem;
                height: 1.5rem;
            }

            .navbar-brand::after {
                left: 0.25rem;
                width: 1rem;
                height: 1rem;
            }
        }

        /* Animation untuk loading */
        .fade-in {
            animation: fadeIn 0.5s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Status indicator */
        .status-indicator {
            display: inline-block;
            width: 8px;
            height: 8px;
            background-color: #10b981;
            border-radius: 50%;
            margin-right: 0.5rem;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% {
                box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.7);
            }
            70% {
                box-shadow: 0 0 0 10px rgba(16, 185, 129, 0);
            }
            100% {
                box-shadow: 0 0 0 0 rgba(16, 185, 129, 0);
            }
        }
    </style>
</head>
<body class="min-vh-100 bg-light">
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom">
        <div class="container">
            <a class="navbar-brand fade-in" 
               href="{{ Auth::check() && Auth::user()->role === 'admin' ? route('admin.dashboard') : (Auth::check() && Auth::user()->role === 'karyawan' ? route('karyawan.dashboard') : route('login')) }}">
                <span class="status-indicator"></span>
                {{ config('app.name', 'Sistem Payroll & Absensi') }}
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav ms-auto">
                    @guest
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('login') ? 'active' : '' }}"
                                href="{{ route('login') }}">
                                <i class="bi bi-box-arrow-in-right me-2"></i>Login
                            </a>
                        </li>
                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('register') ? 'active' : '' }}"
                                href="{{ route('register') }}">
                                <i class="bi bi-person-plus me-2"></i>Register
                            </a>
                        </li>
                        @endif
                    @else
                        @if (Auth::user()->role === 'admin')
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
                                    href="{{ route('admin.dashboard') }}">
                                    <i class="bi bi-speedometer2 me-2"></i>Dashboard
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('admin.karyawan.*') ? 'active' : '' }}"
                                    href="{{ route('admin.karyawan.index') }}">
                                    <i class="bi bi-people me-2"></i>Kelola Karyawan
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('admin.absensi.rekap') ? 'active' : '' }}"
                                    href="{{ route('admin.absensi.rekap') }}">
                                    <i class="bi bi-calendar-check me-2"></i>Rekap Absensi
                                </a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle {{ request()->routeIs('admin.gaji.*') ? 'active' : '' }}"
                                    href="#" id="gajiDropdownAdmin" role="button" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <i class="bi bi-cash-coin me-2"></i>Penggajian
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="gajiDropdownAdmin">
                                    <li>
                                        <a class="dropdown-item" href="{{ route('admin.gaji.form_hitung') }}">
                                            <i class="bi bi-calculator me-2"></i>Hitung Gaji
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('admin.gaji.rekap') }}">
                                            <i class="bi bi-file-earmark-spreadsheet me-2"></i>Rekap Gaji
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @elseif(Auth::user()->role === 'karyawan')
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('karyawan.dashboard') ? 'active' : '' }}"
                                    href="{{ route('karyawan.dashboard') }}">
                                    <i class="bi bi-house me-2"></i>Dashboard
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('karyawan.absensi.riwayat') ? 'active' : '' }}"
                                    href="{{ route('karyawan.absensi.riwayat') }}">
                                    <i class="bi bi-clock-history me-2"></i>Riwayat Absensi
                                </a>
                            </li>
                        @endif
                        
                        <li class="nav-item dropdown user-dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownUser" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-person-circle me-2"></i>
                                {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownUser">
                                <li>
                                    <h6 class="dropdown-header">
                                        <i class="bi bi-person-badge me-2"></i>
                                        {{ ucfirst(Auth::user()->role) }}
                                    </h6>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <a class="dropdown-item" href="#">
                                        <i class="bi bi-gear me-2"></i>Pengaturan
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="#">
                                        <i class="bi bi-person me-2"></i>Profile
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item">
                                            <i class="bi bi-box-arrow-right me-2"></i>Logout
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <!-- Page Header -->
    @hasSection('header')
        <header class="page-header">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        @yield('header')
                        
                        <!-- Breadcrumb -->
                        @if(isset($breadcrumbs) || View::hasSection('breadcrumb'))
                            <nav aria-label="breadcrumb" class="mt-2">
                                <ol class="breadcrumb breadcrumb-nav">
                                    @yield('breadcrumb')
                                    @if(isset($breadcrumbs))
                                        @foreach($breadcrumbs as $breadcrumb)
                                            @if($loop->last)
                                                <li class="breadcrumb-item active" aria-current="page">{{ $breadcrumb['title'] }}</li>
                                            @else
                                                <li class="breadcrumb-item">
                                                    <a href="{{ $breadcrumb['url'] }}">{{ $breadcrumb['title'] }}</a>
                                                </li>
                                            @endif
                                        @endforeach
                                    @endif
                                </ol>
                            </nav>
                        @endif
                    </div>
                    <div class="col-md-4 text-end">
                        @yield('header-actions')
                    </div>
                </div>
            </div>
        </header>
    @endif

    <!-- Page Content -->
    <main class="container py-4">
        @include('partials._alerts')
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-light border-top mt-5 py-4">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <p class="mb-0 text-muted">
                        &copy; {{ date('Y') }} {{ config('app.name', 'Sistem Payroll') }}. 
                        Semua hak cipta dilindungi.
                    </p>
                </div>
                <div class="col-md-6 text-end">
                    <small class="text-muted">
                        <i class="bi bi-clock me-1"></i>
                        Terakhir diupdate: {{ now()->format('d M Y, H:i') }}
                    </small>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Initialize Lucide icons
        lucide.createIcons();
        
        // Auto-hide alerts after 5 seconds
        document.addEventListener('DOMContentLoaded', function() {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(function(alert) {
                setTimeout(function() {
                    if (alert.classList.contains('show')) {
                        const closeBtn = alert.querySelector('.btn-close');
                        if (closeBtn) {
                            closeBtn.click();
                        }
                    }
                }, 5000);
            });
        });

        // Add active state to current navigation
        document.addEventListener('DOMContentLoaded', function() {
            const currentPath = window.location.pathname;
            const navLinks = document.querySelectorAll('.nav-link');
            
            navLinks.forEach(function(link) {
                const href = link.getAttribute('href');
                if (href && currentPath.includes(href.split('/').pop())) {
                    link.classList.add('active');
                }
            });
        });

        // Dropdown auto-close on mobile
        document.addEventListener('DOMContentLoaded', function() {
            const navbarToggler = document.querySelector('.navbar-toggler');
            const navbarCollapse = document.querySelector('.navbar-collapse');
            const navLinks = document.querySelectorAll('.nav-link');

            navLinks.forEach(function(link) {
                link.addEventListener('click', function() {
                    if (window.innerWidth < 992) {
                        const bsCollapse = new bootstrap.Collapse(navbarCollapse, {
                            toggle: false
                        });
                        bsCollapse.hide();
                    }
                });
            });
        });
    </script>
    
    @stack('scripts') <!-- Untuk custom scripts per halaman -->
</body>
</html>