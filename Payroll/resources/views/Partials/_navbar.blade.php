<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
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
                    <li class="nav-item dropdown">
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
