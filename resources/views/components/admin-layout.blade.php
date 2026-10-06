<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }} · Admin {{ config('app.name') }}</title>
    @vite(['resources/css/admin.css', 'resources/js/admin.js'])
</head>.
<body class="admin-body">
    <div class="d-flex flex-column flex-md-row min-vh-100">
        @include('partials.admin-sidebar')

        <div class="flex-grow-1">
            <nav class="d-flex align-items-center justify-content-between border-bottom border-2 border-dark bg-white px-3 py-2">
                <form method="POST" action="{{ route('admin.logout') }}">
                    @csrf
                    <button class="btn btn-outline-dark btn-sm">Keluar ({{ auth()->user()->name }})</button>
                </form>
            </nav>

            <main class="p-3 p-md-4">
                <h1 class="h3 fw-bold mb-4">{{ $title }}</h1>

                @if (session('success'))
                    <div class="alert alert-success alert-auto-dismiss alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
                    </div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger" role="alert">
                        <p class="fw-bold mb-1">Periksa kembali isian Anda:</p>
                        <ul class="mb-0">@foreach ($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
                    </div>
                @endif

                {{ $slot }}
            </main>
        </div>
    </div>
</body>
</html>
