<x-public-layout title="Profil" :description="'Profil, sejarah, dan kepala program '.$program->nama">
    <x-section title="Identitas Program" bg="bg-white">
        <dl class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ([
                'Nama Program' => $program->nama, 'Kompetensi Keahlian' => $program->kompetensi,
                'Tahun Berdiri' => $program->tahun_berdiri, 'Akreditasi' => $program->akreditasi,
                'Jumlah Guru' => $program->jumlah_guru, 'Jumlah Siswa' => $program->jumlah_siswa,
            ] as $label => $value)
                <div class="nb-card p-4"><dt class="text-sm font-bold uppercase text-brand">{{ $label }}</dt><dd class="mt-1 text-xl font-extrabold">{{ $value ?: '-' }}</dd></div>
            @endforeach
        </dl>
    </x-section>

    @if ($program->sejarah).
    <x-section title="Sejarah">
        <p class="mb-10 max-w-prose text-lg leading-relaxed">{!! nl2br(e($program->sejarah->narasi)) !!}</p>

        <div class="relative grid gap-x-10 lg:grid-cols-2">
            <div class="absolute inset-y-0 left-3 w-[3px] bg-ink lg:left-1/2 lg:-translate-x-1/2"></div>

            <ol class="pl-10 lg:pl-0 lg:pr-10">
                @forelse ($program->riwayatKepala ?? [] as $k)
                    <li class="relative mb-8 lg:text-right">
                        <span class="absolute -left-[27px] top-1 size-5 border-[3px] border-ink bg-sun lg:left-auto lg:-right-[27px]"></span>
                        <span class="nb-tag bg-brand text-white">{{ $k->periode_mulai }}–{{ $k->periode_selesai ?? 'Sekarang' }}</span>
                        <h3 class="mt-2 font-extrabold">{{ $k->nama }}</h3>
                        @if ($k->keterangan)<p>{{ $k->keterangan }}</p>@endif
                    </li>
                @empty
                    <li class="text-sm italic text-ink/60">Belum ada data kepala program.</li>
                @endforelse
            </ol>

            <ol class="pl-10 lg:pl-10">
                @foreach ($program->sejarah->timeline as $t)
                    <li class="relative mb-8">
                        <span class="absolute -left-[27px] top-1 size-5 border-[3px] border-ink bg-brand"></span>
                        <span class="nb-tag bg-sun">{{ $t->tahun }}</span>
                        <h3 class="mt-2 font-extrabold">{{ $t->judul }}</h3>
                        @if ($t->deskripsi)<p>{{ $t->deskripsi }}</p>@endif
                    </li>
                @endforeach
            </ol>
        </div>
    </x-section>
    @endif

    @if ($program->kepala)
    <x-section title="Kepala Program" bg="bg-white">
        <div class="nb-card grid max-w-3xl overflow-hidden sm:grid-cols-[220px_1fr]">
            <x-thumb :src="$program->kepala->image_url" :alt="$program->kepala->nama" class="aspect-square h-full border-b-[3px] border-ink sm:border-b-0 sm:border-r-[3px]" />
            <div class="p-6">
                <p class="nb-tag bg-brand text-white">{{ $program->kepala->jabatan }}</p>
                <h3 class="mt-3 text-2xl font-extrabold">{{ $program->kepala->nama }} <span class="text-xl font-bold">{{ $program->kepala->gelar }}</span></h3>
                <p class="mt-2">{{ $program->kepala->deskripsi }}</p>
            </div>
        </div>
    </x-section>
    @endif
</x-public-layout>.