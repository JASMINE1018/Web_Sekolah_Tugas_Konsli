<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Sekolah Inspirasi - Ruang untuk Bertanya dan Tumbuh')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Plus Jakarta Sans', system-ui, -apple-system, sans-serif;
            background-color: #F8F6F0;
            color: #1A1A1A;
        }
        .bg-cream {
            background-color: #F8F6F0;
        }
        .bg-cream-card {
            background-color: #F3EFE6;
        }
        .bg-terracotta {
            background-color: #B84A29;
        }
        .hover-bg-terracotta:hover {
            background-color: #A03D20;
        }
        .text-terracotta {
            color: #B84A29;
        }
        .bg-moss {
            background-color: #2F3E35;
        }
        .bg-sage-badge {
            background-color: #E2ECE4;
            color: #2E5A36;
        }
        .bg-warm-badge {
            background-color: #F6E6DE;
            color: #B84A29;
        }
    </style>
</head>
<body class="min-h-screen flex flex-col bg-[#F8F6F0] text-[#1D1D1D] antialiased">

    @yield('content')

    @stack('scripts')
</body>
</html>
