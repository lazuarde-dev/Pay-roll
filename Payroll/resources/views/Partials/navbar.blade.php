<style>
    /* Custom Navigation Styles */
    .navbar-custom {
        background: linear-gradient(to right, #1e293b, #0f172a) !important;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        padding: 0.75rem 1rem;
    }

    .navbar-brand {
        font-weight: 600;
        position: relative;
        padding-left: 2rem;
    }

    .navbar-brand::before {
        content: '';
        position: absolute;
        left: 0;
        top: 50%;
        transform: translateY(-50%);
        width: 1.5rem;
        height: 1.5rem;
        background-color: #10b981;
        border-radius: 0.375rem;
        opacity: 0.8;
    }

    .navbar-brand::after {
        content: '';
        position: absolute;
        left: 0.25rem;
        top: 50%;
        transform: translateY(-50%);
        width: 1rem;
        height: 1rem;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='white' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Ccircle cx='12' cy='12' r='10'%3E%3C/circle%3E%3Cpolyline points='12 6 12 12 16 14'%3E%3C/polyline%3E%3C/svg%3E");
        background-size: contain;
        background-repeat: no-repeat;
    }

    .nav-link {
        position: relative;
        padding: 0.75rem 1rem;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .nav-link:hover {
        color: #10b981 !important;
    }

    .nav-link.active {
        color: #10b981 !important;
        font-weight: 600;
    }

    .nav-link.active::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0.5rem;
        right: 0.5rem;
        height: 2px;
        background-color: #10b981;
        border-radius: 1px;
    }

    .dropdown-menu {
        border: none;
        border-radius: 0.5rem;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        padding: 0.5rem;
        margin-top: 0.5rem;
    }

    .dropdown-item {
        border-radius: 0.375rem;
        padding: 0.5rem 1rem;
        transition: all 0.2s ease;
    }

    .dropdown-item:hover {
        background-color: #f0fdf4;
        color: #10b981;
    }

    .dropdown-item:active {
        background-color: #10b981;
        color: white;
    }

    .navbar-toggler {
        border: none;
        padding: 0.5rem;
    }

    .navbar-toggler:focus {
        box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.25);
    }

    .navbar-toggler-icon {
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='white' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cline x1='3' y1='12' x2='21' y2='12'%3E%3C/line%3E%3Cline x1='3' y1='6' x2='21' y2='6'%3E%3C/line%3E%3Cline x1='3' y1='18' x2='21' y2='18'%3E%3C/line%3E%3C/svg%3E");
    }

    /* User dropdown styling */
    .user-dropdown .dropdown-toggle {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .user-dropdown .dropdown-toggle::after {
        margin-left: 0.5rem;
    }

    /* Responsive adjustments */
    @media (max-width: 991.98px) {
        .navbar-collapse {
            background-color: #1a2234;
            border-radius: 0.5rem;
            padding: 1rem;
            margin-top: 0.5rem;
        }

        .nav-link.active::after {
            left: 0;
            right: 0;
        }
    }
</style>

<nav class="navbar navbar-expand-lg navbar-dark navbar-custom">
    <div class="container">
        <a class="navbar-brand"
            href="{{ Auth::check() && Auth::user()->isAdmin() ? route('admin.dashboard') : (Auth::check() && Auth::user()->isKaryawan() ? route('karyawan.dashboard') : route('login')) }}">
            {{ config('app.name', 'Sistem Absensi & Gaji') }}
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
                            href="{{ route('login') }}">Login</a>
                    </li>
                @else
                    @if (Auth::user()->isAdmin())
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
                                href="{{ route('admin.dashboard') }}">Dashboard Admin</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.karyawan.*') ? 'active' : '' }}"
                                href="{{ route('admin.karyawan.index') }}">Kelola Karyawan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.absensi.rekap') ? 'active' : '' }}"
                                href="{{ route('admin.absensi.rekap') }}">Rekap Absensi</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle {{ request()->routeIs('admin.gaji.*') ? 'active' : '' }}"
                                href="#" id="gajiDropdownAdmin" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                Penggajian
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="gajiDropdownAdmin">
                                <li><a class="dropdown-item" href="{{ route('admin.gaji.form_hitung') }}">Hitung Gaji</a>
                                </li>
                                <li><a class="dropdown-item" href="{{ route('admin.gaji.rekap') }}">Rekap Gaji</a></li>
                            </ul>
                        </li>
                    @elseif(Auth::user()->isKaryawan())
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('karyawan.dashboard') ? 'active' : '' }}"
                                href="{{ route('karyawan.dashboard') }}">Dashboard Karyawan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('karyawan.absensi.riwayat') ? 'active' : '' }}"
                                href="{{ route('karyawan.absensi.riwayat') }}">Riwayat Absensi</a>
                        </li>
                    @endif
                    <li class="nav-item dropdown user-dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownUser" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownUser">
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
