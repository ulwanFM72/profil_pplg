<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Admin · {{ config('app.name') }}</title>
    @vite(['resources/css/admin.css', 'resources/js/admin.js'])
</head>
<body class="admin-body d-flex align-items-center" style="min-height:100vh">
    <main class="container" style="max-width:420px">
        <div class="card admin-shadow p-4 bg-white">
            <h1 class="h4 fw-bold mb-4 text-center">Login Administrator</h1>

            @if ($errors->any())
                <div class="alert alert-danger">{{ $errors->first() }}</div>
            @endif

            <form method="POST" action="{{ route('admin.login.store') }}" novalidate>
                @csrf
                <div class="mb-3">
                    <label for="username" class="form-label fw-bold">Username</label>
                    <input type="text" id="username" name="username" value="{{ old('username') }}" required autofocus autocomplete="username" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label fw-bold">Password</label>
                    <div class="input-group">
                        <input type="password" id="password" name="password" required autocomplete="current-password" class="form-control">
                        <button type="button" data-toggle-password="password" aria-label="Tampilkan password" aria-pressed="false" class="btn btn-outline-dark">👁</button>
                    </div>
                </div>
                <div class="form-check mb-3">
                    <input type="checkbox" id="remember" name="remember" class="form-check-input">
                    <label for="remember" class="form-check-label">Ingat saya</label>
                </div>
                <button class="btn btn-dark w-100">Masuk</button>
            </form>
        </div>
        <p class="text-center mt-3"><a href="{{ route('beranda') }}" class="text-dark">← Kembali ke situs</a></p>
    </main>
</body>
</html>.
