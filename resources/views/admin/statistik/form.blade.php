<x-admin-layout :title="$item->exists ? 'Ubah Statistik' : 'Tambah Statistik'">
    <form method="POST" action="{{ $item->exists ? route('admin.statistik.update', $item) : route('admin.statistik.store') }}" class="card admin-shadow p-4 bg-white" style="max-width:560px" novalidate>
        @csrf
        @if ($item->exists) @method('PUT') @endif
        <div class="mb-3">
            <label for="label" class="form-label fw-bold">Label</label>
            <input id="label" name="label" value="{{ old('label', $item->label) }}" placeholder="mis. Jumlah Siswa" class="form-control @error('label') is-invalid @enderror">
            @error('label')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="row g-3">
            <div class="col-sm-6">
                <label for="nilai" class="form-label fw-bold">Nilai</label>
                <input type="number" id="nilai" name="nilai" value="{{ old('nilai', $item->nilai ?? 0) }}" class="form-control @error('nilai') is-invalid @enderror">
                @error('nilai')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-sm-6">
                <label for="urutan" class="form-label fw-bold">Urutan</label>
                <input type="number" id="urutan" name="urutan" value="{{ old('urutan', $item->urutan ?? 0) }}" class="form-control">
            </div>
        </div>
        <div class="form-check form-switch mt-3">
            <input type="checkbox" id="tampil" name="tampil" value="1" class="form-check-input" @checked(old('tampil', $item->tampil ?? true))>
            <label for="tampil" class="form-check-label fw-bold">Tampilkan di Beranda</label>
        </div>
        <div class="d-flex gap-2 mt-3">
            <button class="btn btn-dark">Simpan</button>
            <a href="{{ route('admin.statistik.index') }}" class="btn btn-outline-secondary">Batal</a>
        </div>
    </form>
</x-admin-layout>
