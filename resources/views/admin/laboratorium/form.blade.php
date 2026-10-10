<x-admin-layout :title="$item->exists ? 'Ubah Laboratorium' : 'Tambah Laboratorium'">
    <form method="POST" action="{{ $item->exists ? route('admin.laboratorium.update', $item) : route('admin.laboratorium.store') }}" enctype="multipart/form-data" class="card admin-shadow p-4 bg-white" style="max-width:720px" novalidate>
        @csrf
        @if ($item->exists) @method('PUT') @endif
        <div class="mb-3">
            <label for="nama" class="form-label fw-bold">Nama Laboratorium</label>
            <input id="nama" name="nama" value="{{ old('nama', $item->nama) }}" class="form-control @error('nama') is-invalid @enderror">
            @error('nama')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="mb-3">
            <label for="deskripsi" class="form-label fw-bold">Deskripsi</label>
            <textarea id="deskripsi" name="deskripsi" rows="3" class="form-control">{{ old('deskripsi', $item->deskripsi) }}</textarea>
        </div>
        <div class="row g-3">
            <div class="col-sm-4">
                <label for="kapasitas" class="form-label fw-bold">Kapasitas</label>
                <input type="number" id="kapasitas" name="kapasitas" value="{{ old('kapasitas', $item->kapasitas ?? 0) }}" class="form-control @error('kapasitas') is-invalid @enderror">
                @error('kapasitas')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-sm-4">
                <label for="lokasi" class="form-label fw-bold">Lokasi</label>
                <input id="lokasi" name="lokasi" value="{{ old('lokasi', $item->lokasi) }}" class="form-control">
            </div>
            <div class="col-sm-4">
                <label for="status" class="form-label fw-bold">Status</label>
                <select id="status" name="status" class="form-select">
                    @foreach (['aktif' => 'Aktif', 'perawatan' => 'Perawatan', 'nonaktif' => 'Nonaktif'] as $v => $l)
                        <option value="{{ $v }}" @selected(old('status', $item->status ?? 'aktif') === $v)>{{ $l }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="mb-3 mt-3">
            <label for="fasilitas" class="form-label fw-bold">Fasilitas <span class="fw-normal text-muted">(satu per baris)</span></label>
            <textarea id="fasilitas" name="fasilitas" rows="4" class="form-control">{{ old('fasilitas', is_array($item->fasilitas) ? implode(PHP_EOL, $item->fasilitas) : '') }}</textarea>
        </div>
        <div class="mb-3">
            <label for="jadwal" class="form-label fw-bold">Jadwal Penggunaan <span class="fw-normal text-muted">(satu per baris, opsional)</span></label>
            <textarea id="jadwal" name="jadwal" rows="3" class="form-control">{{ old('jadwal', is_array($item->jadwal) ? implode(PHP_EOL, $item->jadwal) : '') }}</textarea>
        </div>
        <x-admin.image-field name="foto" :current="$item->image_url" />
        <div class="d-flex gap-2">
            <button class="btn btn-dark">Simpan</button>
            <a href="{{ route('admin.laboratorium.index') }}" class="btn btn-outline-secondary">Batal</a>
        </div>
    </form>
</x-admin-layout>
