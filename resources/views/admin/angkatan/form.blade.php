<x-admin-layout :title="$item->exists ? 'Ubah Angkatan' : 'Tambah Angkatan'">
    <form method="POST" action="{{ $item->exists ? route('admin.angkatan.update', $item) : route('admin.angkatan.store') }}" enctype="multipart/form-data" class="card admin-shadow p-4 bg-white" style="max-width:640px" novalidate>
        @csrf
        @if ($item->exists) @method('PUT') @endif
        <div class="row g-3">
            <div class="col-sm-4">
                <label for="tahun" class="form-label fw-bold">Tahun</label>
                <input type="number" id="tahun" name="tahun" value="{{ old('tahun', $item->tahun) }}" class="form-control @error('tahun') is-invalid @enderror">
                @error('tahun')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-sm-8">
                <label for="nama" class="form-label fw-bold">Nama Angkatan</label>
                <input id="nama" name="nama" value="{{ old('nama', $item->nama) }}" class="form-control @error('nama') is-invalid @enderror">
                @error('nama')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
        </div>
        <div class="mb-3 mt-3">
            <label for="deskripsi" class="form-label fw-bold">Deskripsi</label>
            <textarea id="deskripsi" name="deskripsi" rows="3" class="form-control">{{ old('deskripsi', $item->deskripsi) }}</textarea>
        </div>
        <x-admin.image-field name="foto" :current="$item->image_url" />
        <div class="d-flex gap-2">
            <button class="btn btn-dark">Simpan</button>
            <a href="{{ route('admin.angkatan.index') }}" class="btn btn-outline-secondary">Batal</a>
        </div>
    </form>
</x-admin-layout>.
