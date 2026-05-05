<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="@yield('meta_description', 'STIT Mambaul Hikmah - Penerimaan Mahasiswa Baru. Wujudkan masa depan gemilang bersama kampus yang mengintegrasikan keilmuan akademik dan nilai-nilai keislaman.')">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'STIT Mambaul Hikmah') - PMB</title>

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@400;500;600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="text-body-md overflow-x-hidden">
    @yield('body')
    @stack('scripts')
</body>
</html>
