@php
    $links = [
        ['admin.dashboard', 'Dashboard', 'dashboard'],
        ['admin.profil.edit', 'Profil', 'profil'],
        ['admin.sejarah.edit', 'Sejarah', 'sejarah'],
        ['admin.timeline.index', 'Timeline', 'timeline'],
        ['admin.laboratorium.index', 'Laboratorium', 'laboratorium'],
        ['admin.asset.index', 'Asset', 'asset'],
        ['admin.galeri.index', 'Galeri', 'galeri'],
        ['admin.angkatan.index', 'Angkatan', 'angkatan'],
        ['admin.statistik.index', 'Statistik', 'statistik'],
        ['admin.keunggulan.index', 'Keunggulan', 'keunggulan'],
    ];
@endphp
<aside class="admin-sidebar p-3">
    <ul class="nav nav-pills flex-md-column gap-1">
        @foreach ($links as [$route, $label, $key])
            <li class="nav-item">
                <a href="{{ route($route) }}" class="nav-link {{ request()->routeIs('admin.'.$key.'.*') || request()->routeIs('admin.'.$key) ? 'active' : '' }}">{{ $label }}</a>
            </li>
        @endforeach
    </ul>
</aside>
