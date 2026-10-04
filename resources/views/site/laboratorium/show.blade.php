<x-public-layout :title="$lab->nama" :description="Str::limit($lab->deskripsi, 150)">
    <x-section title="{{ $lab->nama }}" :href="route('laboratorium.index')" link="← Semua lab" bg="bg-white">
        <div class="grid gap-10 lg:grid-cols-2">
            <x-thumb :src="$lab->image_url" :alt="$lab->nama" class="nb-card aspect-[4/3]" />
            <div>
                <p class="text-lg leading-relaxed">{{ $lab->deskripsi }}</p>
                <p class="mt-4 font-bold">Kapasitas: {{ $lab->kapasitas }} siswa @if ($lab->lokasi) · Lokasi: {{ $lab->lokasi }} @endif · Status: {{ ucfirst($lab->status) }}</p>
                @if ($lab->fasilitas)
                    <h3 class="mt-6 text-xl font-extrabold">Fasilitas</h3>
                    <ul class="mt-2 flex flex-wrap gap-2">@foreach ($lab->fasilitas as $f)<li class="nb-tag bg-leaf">{{ $f }}</li>@endforeach</ul>
                @endif
                @if ($lab->jadwal)
                    <h3 class="mt-6 text-xl font-extrabold">Jadwal Penggunaan</h3>
                    <ul class="mt-2 list-disc pl-5">@foreach ($lab->jadwal as $j)<li>{{ $j }}</li>@endforeach</ul>
                @endif
            </div>
        </div>
    </x-section>.
    @if ($lab->assets->isNotEmpty())
        <x-section title="Peralatan di Lab Ini">@include('site.partials.asset-grid', ['assets' => $lab->assets])</x-section>
    @endif
</x-public-layout>
