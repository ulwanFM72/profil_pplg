<div>
    <div class="mb-8 flex flex-wrap items-end gap-3" role="search">
        <div class="flex-1" style="min-width:200px">
            <input type="search" wire:model.live.debounce.400ms="q" placeholder="Cari judul…" class="nb-input w-full" aria-label="Cari judul galeri">
        </div>
        <select wire:model.live="kategori" class="nb-input" aria-label="Kategori">
            <option value="">Semua kategori</option>
            @foreach ($kategoriList as $k)<option value="{{ $k }}">{{ $k }}</option>@endforeach
        </select>
        <select wire:model.live="tahun" class="nb-input" aria-label="Tahun">
            <option value="">Semua tahun</option>
            @foreach ($tahunList as $t)<option value="{{ $t }}">{{ $t }}</option>@endforeach
        </select>
        @if ($q || $kategori || $tahun)
            <button type="button" wire:click="resetFilter" class="nb-btn nb-btn-light">Reset</button>
        @endif
        <span wire:loading class="self-center text-sm font-bold">Mencari…</span>
    </div>

    <div wire:loading.class="opacity-50" wire:target="q,kategori,tahun" class="transition-opacity duration-150">
        @include('site.partials.galeri-grid', ['items' => $items])
    </div>

    <div class="mt-8">{{ $items->links() }}</div>
</div>.
