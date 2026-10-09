<x-admin-layout :title="$item->exists ? 'Ubah Keunggulan' : 'Tambah Keunggulan'">
    <form method="POST" action="{{ $item->exists ? route('admin.keunggulan.update', $item) : route('admin.keunggulan.store') }}" class="card admin-shadow p-4 bg-white" style="max-width:720px" novalidate>
        @csrf
        @if ($item->exists) @method('PUT') @endif

        <div class="mb-3">
            <label for="judul" class="form-label fw-bold">Judul</label>
            <input id="judul" name="judul" value="{{ old('judul', $item->judul) }}" class="form-control @error('judul') is-invalid @enderror">
            @error('judul')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="mb-3">
            <label for="teks" class="form-label fw-bold">Teks</label>
            <textarea id="teks" name="teks" rows="3" class="form-control @error('teks') is-invalid @enderror">{{ old('teks', $item->teks) }}</textarea>
            @error('teks')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="row g-3">
            <div class="col-sm-6">
                <label for="warna" class="form-label fw-bold">Warna</label>
                <select id="warna" name="warna" class="form-select @error('warna') is-invalid @enderror">
                    @foreach (['bg-sun' => 'Kuning', 'bg-sky' => 'Biru', 'bg-leaf' => 'Hijau', 'bg-brand text-white' => 'Merah'] as $v => $l)
                        <option value="{{ $v }}" @selected(old('warna', $item->warna ?? 'bg-sun') === $v)>{{ $l }}</option>
                    @endforeach
                </select>
                @error('warna')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-sm-3">
                <label for="urutan" class="form-label fw-bold">Urutan</label>
                <input type="number" id="urutan" name="urutan" value="{{ old('urutan', $item->urutan ?? 0) }}" class="form-control">
            </div>
            <div class="col-sm-3">
                <label for="aktif" class="form-label fw-bold">Status</label>
                <select id="aktif" name="aktif" class="form-select">
                    <option value="1" @selected(old('aktif', $item->aktif ?? true) == 1)>Aktif</option>
                    <option value="0" @selected(old('aktif', $item->aktif ?? true) == 0)>Nonaktif</option>
                </select>
            </div>
        </div>

        <div class="d-flex gap-2 mt-3">
            <button class="btn btn-dark">Simpan</button>
            <a href="{{ route('admin.keunggulan.index') }}" class="btn btn-outline-secondary">Batal</a>
        </div>
    </form>
</x-admin-layout>.