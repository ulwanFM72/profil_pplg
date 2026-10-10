@php $badge = ['baik' => 'bg-leaf', 'cukup' => 'bg-sun', 'rusak' => 'bg-brand text-white']; @endphp
<div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
    @forelse ($assets as $a)
        <article class="nb-card">
            <x-thumb :src="$a->image_url" :alt="$a->nama" class="aspect-square border-b-[3px] border-ink" />
            <div class="p-4">
                <span class="nb-tag bg-sky">{{ $a->kategori }}</span>
                <h3 class="mt-2 font-extrabold">{{ $a->nama }}</h3>
                <p class="text-sm">{{ $a->jumlah }} unit @if ($a->tahun_pengadaan) · {{ $a->tahun_pengadaan }} @endif</p>
                <span class="nb-tag mt-2 {{ $badge[$a->kondisi] }}">{{ ucfirst($a->kondisi) }}</span>
            </div>
        </article>
    @empty
        <p class="nb-card col-span-full p-8 text-center font-bold">Belum ada asset.</p>
    @endforelse
</div>
