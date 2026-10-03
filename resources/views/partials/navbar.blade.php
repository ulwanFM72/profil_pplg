@php
    $menu = [
        ['Beranda', 'beranda', 'beranda'],
        ['Profil', 'profil', 'profil'],
        ['Laboratorium', 'laboratorium.index', 'laboratorium.*'],
        ['Asset', 'asset', 'asset'],
        ['Galeri', 'galeri', 'galeri'],
    ];
@endphp
<header class="sticky top-0 z-40 border-b-[3px] border-ink bg-white">
    <nav class="mx-auto flex max-w-6xl items-center justify-between gap-4 px-4 py-3" aria-label="Navigasi utama">
        <a href="{{ route('beranda') }}" class="flex items-center gap-3 font-extrabold leading-tight">
            @if ($program?->logo)
                <img src="{{ asset('storage/'.$program->logo) }}" alt="Logo {{ $program->nama }}" class="size-10 object-contain">
            @else
                <span class="grid size-10 place-items-center border-[3px] border-ink bg-brand text-white shadow-nb-sm">{{ Str::upper(Str::substr($program?->nama ?? 'S', 0, 1)) }}</span>
            @endif
            <span class="max-w-44 text-sm sm:max-w-none sm:text-base">{{ $program?->nama }}</span>
        </a>

        <ul class="hidden items-center gap-2 md:flex">
            @foreach ($menu as [$label, $route, $pattern])
                <li><a href="{{ route($route) }}" @if (request()->routeIs($pattern)) aria-current="page" @endif
                       class="border-[3px] px-3 py-1.5 font-bold transition-colors {{ request()->routeIs($pattern) ? 'border-ink bg-sun shadow-nb-sm' : 'border-transparent hover:border-ink hover:bg-paper' }}">{{ $label }}</a></li>
            @endforeach
            <li><button type="button" data-open-login class="nb-btn py-1.5">Admin</button></li>
        </ul>

        <button id="menu-toggle" type="button" class="nb-btn nb-btn-light md:hidden" aria-expanded="false" aria-controls="mobile-menu">Menu</button>
    </nav>

    <ul id="mobile-menu" class="hidden border-t-[3px] border-ink bg-white p-4 md:hidden">
        @foreach ($menu as [$label, $route, $pattern])
            <li><a href="{{ route($route) }}" class="block border-b-2 border-ink/20 py-3 font-bold {{ request()->routeIs($pattern) ? 'text-brand' : '' }}">{{ $label }}</a></li>
        @endforeach
        <li><button type="button" data-open-login class="block w-full py-3 text-left font-bold">Login Admin</button></li>
    </ul>.
</header>
