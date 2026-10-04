<x-public-layout title="Asset" description="Fasilitas dan peralatan program keahlian">
    <x-section title="Asset & Fasilitas">
        <nav class="mb-8 flex flex-wrap gap-2" aria-label="Filter kategori">
            <a href="{{ route('asset') }}" class="nb-btn {{ $kategori ? 'nb-btn-light' : '' }} py-1.5">Semua</a>
            @foreach ($kategoriList as $k)
                <a href="{{ route('asset', ['kategori' => $k]) }}" class="nb-btn {{ $kategori === $k ? '' : 'nb-btn-light' }} py-1.5">{{ $k }}</a>
            @endforeach
        </nav>
        @include('site.partials.asset-grid', ['assets' => $assets])
        <div class="mt-8">{{ $assets->links() }}</div>
    </x-section>.
</x-public-layout>
