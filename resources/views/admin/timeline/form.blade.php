<x-admin-layout :title="$item->exists ? 'Ubah Milestone' : 'Tambah Milestone'">
    <form method="POST" action="{{ $item->exists ? route('admin.timeline.update', $item) : route('admin.timeline.store') }}" class="card admin-shadow p-4 bg-white" style="max-width:640px" novalidate>
        @csrf
        @if ($item->exists) @method('PUT') @endif
        <div class="row g-3">
            <div class="col-sm-4">
                <label for="tahun" class="form-label fw-bold">Tahun</label>
                <input type="number" id="tahun" name="tahun" value="{{ old('tahun', $item->tahun) }}" class="form-control @error('tahun') is-invalid @enderror">
                @error('tahun')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-sm-8">
                <label for="judul" class="form-label fw-bold">Judul</label>
                <input id="judul" name="judul" value="{{ old('judul', $item->judul) }}" class="form-control @error('judul') is-invalid @enderror">
                @error('judul')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
        </div>
        <div class="mb-3 mt-3">
            <label for="deskripsi" class="form-label fw-bold">Deskripsi</label>
            <textarea id="deskripsi" name="deskripsi" rows="3" class="form-control">{{ old('deskripsi', $item->deskripsi) }}</textarea>
        </div>
        <div class="mb-3">
            <label for="urutan" class="form-label fw-bold">Urutan</label>
            <input type="number" id="urutan" name="urutan" value="{{ old('urutan', $item->urutan ?? 0) }}" class="form-control" style="max-width:120px">
        </div>
        <div class="d-flex gap-2">
            <button class="btn btn-dark">Simpan</button>
            <a href="{{ route('admin.sejarah.edit') }}" class="btn btn-outline-secondary">Batal</a>
        </div>
    </form>
</x-admin-layout>
