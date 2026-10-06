@php
    $lightboxData = $items->map(fn ($g) => [
        'src' => $g->image_url, 'judul' => $g->judul, 'deskripsi' => $g->deskripsi,
        'kategori' => $g->kategori, 'tahun' => $g->tahun,
    ])->values();
@endphp
<div class="columns-1 gap-5 sm:columns-2 lg:columns-3" data-lightbox-group="{{ $lightboxData->toJson() }}">
    @forelse ($items as $i => $g)
        <figure class="nb-card thumb-zoom mb-5 break-inside-avoid">
            <button type="button" data-lightbox-index="{{ $i }}" class="block w-full border-0 bg-transparent p-0 text-left" aria-label="Perbesar foto: {{ $g->judul }}">
                <x-thumb :src="$g->image_url" :alt="$g->judul" class="aspect-[4/3] border-b-[3px] border-ink" />
            </button>
            <figcaption class="p-4">
                <span class="nb-tag bg-sun">{{ $g->kategori }}</span> <span class="nb-tag bg-white">{{ $g->tahun }}</span>
                <p class="mt-2 font-extrabold">{{ $g->judul }}</p>
                @if ($g->deskripsi)<p class="text-sm">{{ Str::limit($g->deskripsi, 90) }}</p>@endif
            </figcaption>
        </figure>
    @empty
        <p class="nb-card p-8 text-center font-bold">Belum ada foto.</p>
    @endforelse
</div>
