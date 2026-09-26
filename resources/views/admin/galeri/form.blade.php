<x-admin-layout :title="$item->exists ? 'Ubah Galeri' : 'Tambah Galeri'">
    <form method="POST" action="{{ $item->exists ? route('admin.galeri.update', $item) : route('admin.galeri.store') }}" enctype="multipart/form-data" class="card admin-shadow p-4 bg-white" style="max-width:720px" novalidate>
        @csrf
        @if ($item->exists) @method('PUT') @endif
        <div class="mb-3">
            <label for="judul" class="form-label fw-bold">Judul</label>
            <input id="judul" name="judul" value="{{ old('judul', $item->judul) }}" class="form-control @error('judul') is-invalid @enderror">
            @error('judul')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="row g-3">
            <div class="col-sm-4">
                <label for="kategori" class="form-label fw-bold">Kategori</label>
                <select id="kategori" name="kategori" class="form-select @error('kategori') is-invalid @enderror">
                    @foreach ($kategoriList as $k)<option value="{{ $k }}" @selected(old('kategori', $item->kategori) === $k)>{{ $k }}</option>@endforeach
                </select>
                @error('kategori')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-sm-4">
                <label for="tahun" class="form-label fw-bold">Tahun</label>
                <input type="number" id="tahun" name="tahun" value="{{ old('tahun', $item->tahun ?? date('Y')) }}" class="form-control @error('tahun') is-invalid @enderror">
                @error('tahun')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-sm-4">
                <label for="angkatan_id" class="form-label fw-bold">Angkatan <span class="fw-normal text-muted">(opsional)</span></label>
                <select id="angkatan_id" name="angkatan_id" class="form-select">
                    <option value="">-</option>
                    @foreach ($angkatanList as $id => $nama)<option value="{{ $id }}" @selected((string) old('angkatan_id', $item->angkatan_id) === (string) $id)>{{ $nama }}</option>@endforeach
                </select>
            </div>
        </div>
        <div class="mb-3 mt-3">
            <label for="deskripsi" class="form-label fw-bold">Deskripsi</label>
            <textarea id="deskripsi" name="deskripsi" rows="3" class="form-control">{{ old('deskripsi', $item->deskripsi) }}</textarea>
        </div>
        <x-admin.image-field name="foto" :current="$item->image_url" />
        <div class="d-flex gap-2">
            <button class="btn btn-dark">Simpan</button>
            <a href="{{ route('admin.galeri.index') }}" class="btn btn-outline-secondary">Batal</a>
        </div>
    </form>
</x-admin-layout>
