@php $badge = ['aktif' => 'bg-leaf', 'perawatan' => 'bg-sun', 'nonaktif' => 'bg-brand text-white']; @endphp
<div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
    @forelse ($labs as $lab)
        <a href="{{ route('laboratorium.show', $lab) }}" class="nb-card block">
            <x-thumb :src="$lab->image_url" :alt="$lab->nama" class="aspect-[4/3] border-b-[3px] border-ink" />
            <div class="p-4">
                <span class="nb-tag {{ $badge[$lab->status] }}">{{ ucfirst($lab->status) }}</span>
                <h3 class="mt-2 text-xl font-extrabold">{{ $lab->nama }}</h3>
                <p class="text-sm">Kapasitas {{ $lab->kapasitas }} siswa @if ($lab->lokasi) · {{ $lab->lokasi }} @endif</p>
            </div>
        </a>
    @empty
        <p class="nb-card col-span-full p-8 text-center font-bold">Belum ada laboratorium.</p>
    @endforelse
</div>.
