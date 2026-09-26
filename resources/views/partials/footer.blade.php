<footer class="bg-ink text-white">
    <div class="mx-auto flex max-w-6xl flex-wrap items-center justify-between gap-4 px-4 py-8">
        <div>
            <p class="font-extrabold">{{ $program?->nama }}</p>
            <p class="text-sm text-white/70">{{ $program?->kompetensi }}</p>
        </div>
        <p class="text-sm text-white/70">© {{ date('Y') }} {{ $program?->nama }}. Seluruh hak dilindungi.</p>
    </div>
</footer>
