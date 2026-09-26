@props(['title', 'href' => null, 'link' => 'Lihat semua', 'bg' => 'bg-paper'])
<section class="border-b-[3px] border-ink {{ $bg }}">
    <div class="mx-auto max-w-6xl px-4 py-14">
        <div class="mb-8 flex flex-wrap items-end justify-between gap-4">
            <h2 class="text-3xl font-extrabold sm:text-4xl"><span class="bg-sun px-2">{{ $title }}</span></h2>
            @if ($href)<a href="{{ $href }}" class="nb-btn nb-btn-light">{{ $link }} →</a>@endif
        </div>
        {{ $slot }}
    </div>
</section>
