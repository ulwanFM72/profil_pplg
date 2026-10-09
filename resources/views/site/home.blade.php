<x-public-layout :description="$program->tagline">
    <section class="border-b-[3px] border-ink bg-white">
        <div class="mx-auto grid max-w-6xl items-center gap-10 px-4 py-14 md:grid-cols-2 md:py-20">
            <div>
                <p class="nb-tag bg-sun">{{ $program->kompetensi }}</p>
                <h1 class="mt-4 text-4xl font-extrabold leading-tight sm:text-5xl lg:text-6xl">{{ $program->nama }}</h1>
                <p class="mt-4 max-w-prose text-lg">{{ $program->tagline }}</p>
                <div class="mt-8 flex flex-wrap gap-4">
                    <a class="nb-btn" href="{{ route('profil') }}">Lihat Profil</a>
                    <a class="nb-btn nb-btn-light" href="{{ route('galeri') }}">Lihat Galeri</a>
                </div>
            </div>
            <x-thumb :src="$program->image_url" :alt="$program->nama" class="nb-card aspect-[4/3] rotate-1" />
        </div>
    </section>

    <x-section title="Tentang Program" bg="bg-white">
        <p class="max-w-3xl text-lg leading-relaxed">{{ $program->deskripsi }}</p>
    </x-section>

    @if ($stats->isNotEmpty())
    <x-section title="Dalam Angka">
        <div class="grid grid-cols-2 gap-5 lg:grid-cols-4">
            @foreach ($stats as $s)
                <div class="nb-card p-5 {{ ['bg-sun', 'bg-sky', 'bg-leaf', 'bg-white'][$loop->index % 4] }}">
                    <p class="text-4xl font-extrabold">{{ number_format($s->nilai, 0, ',', '.') }}</p>
                    <p class="mt-1 font-bold">{{ $s->label }}</p>
                </div>
            @endforeach
        </div>
    </x-section>
    @endif

    <x-section title="Keunggulan" bg="bg-white">
        <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($keunggulan as $k)
                <div class="nb-card p-5 {{ $k['warna'] }}">
                    <h3 class="text-xl font-extrabold">{{ $k['judul'] }}</h3>
                    <p class="mt-2">{{ $k['teks'] }}</p>
                </div>
            @endforeach
        </div>
    </x-section>

    <x-section title="Laboratorium" :href="route('laboratorium.index')">
        @include('site.partials.lab-grid', ['labs' => $labs])
    </x-section>

    <x-section title="Asset & Fasilitas" :href="route('asset')" bg="bg-white">
        @include('site.partials.asset-grid', ['assets' => $assets])
    </x-section>

    <x-section title="Galeri Terbaru" :href="route('galeri')">
        @include('site.partials.galeri-grid', ['items' => $galeri])
    </x-section>

    <section class="bg-brand">
        <div class="mx-auto max-w-6xl px-4 py-16 text-center text-white">
            <h2 class="text-3xl font-extrabold sm:text-4xl">Ingin tahu lebih banyak tentang {{ $program->nama }}?</h2>
            <a href="{{ route('profil') }}" class="nb-btn nb-btn-light mt-8 text-ink">Baca Profil Lengkap</a>
        </div>
    </section>
</x-public-layout>.
