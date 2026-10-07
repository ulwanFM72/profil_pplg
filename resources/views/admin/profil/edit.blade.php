<x-admin-layout title="Profil">
    <form method="POST" action="{{ route('admin.profil.update') }}" enctype="multipart/form-data" novalidate>
        @csrf @method('PUT')
        <div class="row g-4">
            <div class="col-lg-6">
                <div class="card admin-shadow p-4 bg-white h-100">
                    <h2 class="h5 fw-bold mb-3">Identitas Program</h2>
                    @foreach ([['nama', 'Nama Program'], ['kompetensi', 'Kompetensi Keahlian'], ['tagline', 'Tagline']] as [$f, $l])
                        <div class="mb-3">
                            <label for="{{ $f }}" class="form-label fw-bold">{{ $l }}</label>
                            <input id="{{ $f }}" name="{{ $f }}" value="{{ old($f, $program->$f) }}" class="form-control @error($f) is-invalid @enderror">
                            @error($f)<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    @endforeach
                    <div class="mb-3">
                        <label for="deskripsi" class="form-label fw-bold">Deskripsi</label>
                        <textarea id="deskripsi" name="deskripsi" rows="4" class="form-control @error('deskripsi') is-invalid @enderror">{{ old('deskripsi', $program->deskripsi) }}</textarea>
                        @error('deskripsi')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="row g-3">
                        <div class="col-sm-4">
                            <label for="tahun_berdiri" class="form-label fw-bold">Tahun Berdiri</label>
                            <input type="number" id="tahun_berdiri" name="tahun_berdiri" value="{{ old('tahun_berdiri', $program->tahun_berdiri) }}" class="form-control">
                        </div>
                        <div class="col-sm-4">
                            <label for="akreditasi" class="form-label fw-bold">Akreditasi</label>
                            <select id="akreditasi" name="akreditasi" class="form-select">
                                <option value="">-</option>
                                @foreach (['A', 'B', 'C'] as $a)<option value="{{ $a }}" @selected(old('akreditasi', $program->akreditasi) === $a)>{{ $a }}</option>@endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row g-3 mt-1">
                        <div class="col-sm-6">
                            <label for="jumlah_guru" class="form-label fw-bold">Jumlah Guru</label>
                            <input type="number" id="jumlah_guru" name="jumlah_guru" value="{{ old('jumlah_guru', $program->jumlah_guru) }}" class="form-control">
                        </div>
                        <div class="col-sm-6">
                            <label for="jumlah_siswa" class="form-label fw-bold">Jumlah Siswa</label>
                            <input type="number" id="jumlah_siswa" name="jumlah_siswa" value="{{ old('jumlah_siswa', $program->jumlah_siswa) }}" class="form-control">
                        </div>
                    </div>
                    <hr class="my-3">
                    <x-admin.image-field name="logo" :current="$program->logo ? asset('storage/'.$program->logo) : null" label="Logo" />
                    <x-admin.image-field name="hero_image" :current="$program->hero_image ? asset('storage/'.$program->hero_image) : null" label="Foto Hero (Beranda)" />
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card admin-shadow p-4 bg-white h-100">
                    <h2 class="h5 fw-bold mb-3">Kepala Program Keahlian</h2>
                    @php $k = $program->kepala; @endphp
                    <div class="mb-3">
                        <label for="kepala_nama" class="form-label fw-bold">Nama</label>
                        <input id="kepala_nama" name="kepala_nama" value="{{ old('kepala_nama', $k?->nama) }}" class="form-control @error('kepala_nama') is-invalid @enderror">
                        @error('kepala_nama')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="row g-3">
                        <div class="col-sm-6">
                            <label for="kepala_gelar" class="form-label fw-bold">Gelar</label>
                            <input id="kepala_gelar" name="kepala_gelar" value="{{ old('kepala_gelar', $k?->gelar) }}" class="form-control">
                        </div>
                        <div class="col-sm-6">
                            <label for="kepala_jabatan" class="form-label fw-bold">Jabatan</label>
                            <input id="kepala_jabatan" name="kepala_jabatan" value="{{ old('kepala_jabatan', $k?->jabatan) }}" class="form-control">
                        </div>
                    </div>
                    <div class="mb-3 mt-3">
                        <label for="kepala_deskripsi" class="form-label fw-bold">Deskripsi Singkat</label>
                        <textarea id="kepala_deskripsi" name="kepala_deskripsi" rows="4" class="form-control">{{ old('kepala_deskripsi', $k?->deskripsi) }}</textarea>
                    </div>
                    <x-admin.image-field name="kepala_foto" :current="$k?->foto ? asset('storage/'.$k->foto) : null" label="Foto Kepala Program" />
                </div>
            </div>
        </div>
        <button class="btn btn-dark mt-4">Simpan Perubahan</button>
    </form>
</x-admin-layout>.
