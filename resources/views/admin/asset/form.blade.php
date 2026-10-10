<x-admin-layout :title="$item->exists ? 'Ubah Asset' : 'Tambah Asset'">
    <form method="POST" action="{{ $item->exists ? route('admin.asset.update', $item) : route('admin.asset.store') }}" enctype="multipart/form-data" class="card admin-shadow p-4 bg-white" style="max-width:720px" novalidate>
        @csrf
        @if ($item->exists) @method('PUT') @endif
        <div class="mb-3">
            <label for="nama" class="form-label fw-bold">Nama Asset</label>
            <input id="nama" name="nama" value="{{ old('nama', $item->nama) }}" class="form-control @error('nama') is-invalid @enderror">
            @error('nama')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="row g-3">
            <div class="col-sm-6">
                <label for="kategori" class="form-label fw-bold">Kategori</label>
                <select id="kategori" name="kategori" class="form-select @error('kategori') is-invalid @enderror">
                    @foreach ($kategoriList as $k)<option value="{{ $k }}" @selected(old('kategori', $item->kategori) === $k)>{{ $k }}</option>@endforeach
                </select>
                @error('kategori')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-sm-6">
                <label for="laboratorium_id" class="form-label fw-bold">Laboratorium <span class="fw-normal text-muted">(opsional)</span></label>
                <select id="laboratorium_id" name="laboratorium_id" class="form-select">
                    <option value="">-</option>
                    @foreach ($labs as $id => $nama)<option value="{{ $id }}" @selected((string) old('laboratorium_id', $item->laboratorium_id) === (string) $id)>{{ $nama }}</option>@endforeach
                </select>
            </div>
        </div>
        <div class="row g-3 mt-1">
            <div class="col-sm-4">
                <label for="jumlah" class="form-label fw-bold">Jumlah</label>
                <input type="number" id="jumlah" name="jumlah" value="{{ old('jumlah', $item->jumlah ?? 1) }}" class="form-control @error('jumlah') is-invalid @enderror">
                @error('jumlah')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-sm-4">
                <label for="kondisi" class="form-label fw-bold">Kondisi</label>
                <select id="kondisi" name="kondisi" class="form-select">
                    @foreach (['baik' => 'Baik', 'cukup' => 'Cukup', 'rusak' => 'Rusak'] as $v => $l)
                        <option value="{{ $v }}" @selected(old('kondisi', $item->kondisi ?? 'baik') === $v)>{{ $l }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-sm-4">
                <label for="tahun_pengadaan" class="form-label fw-bold">Tahun Pengadaan</label>
                <input type="number" id="tahun_pengadaan" name="tahun_pengadaan" value="{{ old('tahun_pengadaan', $item->tahun_pengadaan) }}" class="form-control">
            </div>
        </div>
        <div class="mb-3 mt-3">
            <label for="deskripsi" class="form-label fw-bold">Deskripsi</label>
            <textarea id="deskripsi" name="deskripsi" rows="3" class="form-control">{{ old('deskripsi', $item->deskripsi) }}</textarea>
        </div>
        <x-admin.image-field name="foto" :current="$item->image_url" />
        <div class="d-flex gap-2">
            <button class="btn btn-dark">Simpan</button>
            <a href="{{ route('admin.asset.index') }}" class="btn btn-outline-secondary">Batal</a>
        </div>
    </form>
</x-admin-layout>
