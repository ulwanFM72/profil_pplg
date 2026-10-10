<x-admin-layout title="Dashboard">
    <div class="row g-3 mb-4">
        @foreach ($cards as $label => $value)
            <div class="col-6 col-lg-4 col-xl-2">
                <div class="stat-card bg-white p-3 h-100">
                    <p class="text-uppercase small fw-bold text-danger mb-1">{{ $label }}</p>
                    <p class="fs-3 fw-bold mb-0">{{ number_format($value, 0, ',', '.') }}</p>
                </div>
            </div>
        @endforeach
    </div>

    <div class="row g-3">
        <div class="col-lg-6">
            <div class="card admin-shadow p-3 bg-white">
                <h2 class="h6 fw-bold">Galeri per Tahun</h2>
                <canvas id="chartGaleri" height="160" role="img" aria-label="Grafik jumlah galeri per tahun"></canvas>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card admin-shadow p-3 bg-white">
                <h2 class="h6 fw-bold">Asset per Kategori</h2>
                <canvas id="chartAsset" height="160" role="img" aria-label="Grafik jumlah asset per kategori"></canvas>
            </div>
        </div>
    </div>

    @vite('resources/js/admin-charts.js')
    <script>
        window.dashboardData = {
            galeri: { labels: @json($galeriPerTahun->keys()), values: @json($galeriPerTahun->values()) },
            asset: { labels: @json($assetPerKategori->keys()), values: @json($assetPerKategori->values()) },
        };
    </script>
</x-admin-layout>
