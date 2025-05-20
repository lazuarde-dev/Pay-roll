<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - @yield('title')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    @stack('styles') <!-- Untuk custom styles per halaman -->

</head>
<body class="font-sans antialiased">
    <div class="min-vh-100 bg-light">
        @include('partials._navbar')

        <!-- Page Heading -->
        @hasSection('header')
            <header class="bg-white shadow-sm">
                <div class="container py-3">
                    @yield('header')
                </div>
            </header>
        @endif

        <!-- Page Content -->
        <main class="container py-4">
            @include('partials._alerts')
            @yield('content')
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts') <!-- Untuk custom scripts per halaman -->
</body>
</html>