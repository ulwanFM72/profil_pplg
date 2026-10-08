<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ? $title.' · ' : '' }}{{ $program?->nama ?? config('app.name') }}</title>
    <meta name="description" content="{{ $description ?: $program?->tagline }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;700&display=swap" rel="stylesheet">
    @vite(['resources/css/public.css', 'resources/js/public.js'])
    @livewireStyles
</head>
<body class="bg-paper font-display text-ink antialiased">
    <a href="#main" class="sr-only focus:not-sr-only focus:fixed focus:left-2 focus:top-2 focus:z-50 focus:bg-sun focus:p-3">Lewati ke konten</a>
    @include('partials.navbar')
    <main id="main">{{ $slot }}</main>
    @include('partials.footer')
    <div id="lightbox-root"></div>
    @include('partials.login-modal')
    @livewireScripts
</body>
</html>.
