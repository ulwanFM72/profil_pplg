<!DOCTYPE html>
<html lang="id">
<head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1"><title>Situs Belum Dikonfigurasi</title></head>
<body style="font-family:sans-serif;max-width:36rem;margin:4rem auto;padding:0 1rem;text-align:center">
    <h1 style="font-size:1.5rem">Situs Belum Dikonfigurasi</h1>
    <p>{{ $exception->getMessage() ?: 'Silakan hubungi administrator.' }}</p>
    <p><a href="{{ route('admin.login') }}">Masuk sebagai admin</a></p>
</body>
</html>
