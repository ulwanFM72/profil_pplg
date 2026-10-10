<x-admin-layout title="Sejarah">
    <div class="card admin-shadow p-4 bg-white mb-4">
        <form method="POST" action="{{ route('admin.sejarah.update') }}" novalidate>
            @csrf @method('PUT')
            <div class="mb-3">
                <label for="judul" class="form-label fw-bold">Judul</label>
                <input id="judul" name="judul" value="{{ old('judul', $sejarah->judul) }}" class="form-control @error('judul') is-invalid @enderror">
                @error('judul')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label for="narasi" class="form-label fw-bold">Narasi Sejarah</label>
                <textarea id="narasi" name="narasi" rows="8" class="form-control @error('narasi') is-invalid @enderror">{{ old('narasi', $sejarah->narasi) }}</textarea>
                @error('narasi')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <button class="btn btn-dark">Simpan Narasi</button>
        </form>
    </div>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="h5 fw-bold mb-0">Milestone Timeline</h2>
        <a href="{{ route('admin.timeline.create') }}" class="btn btn-danger btn-sm">+ Tambah Milestone</a>
    </div>
    <div class="card admin-shadow bg-white">
        <table class="table mb-0 align-middle">
            <thead><tr><th>Tahun</th><th>Judul</th><th>Urutan</th><th class="text-end">Aksi</th></tr></thead>
            <tbody>
                @forelse ($sejarah->timeline as $t)
                    <tr>
                        <td>{{ $t->tahun }}</td><td>{{ $t->judul }}</td><td>{{ $t->urutan }}</td>
                        <td class="text-end">
                            <a href="{{ route('admin.timeline.edit', $t) }}" class="btn btn-outline-dark btn-sm">Ubah</a>
                            <x-admin.delete-form :action="route('admin.timeline.destroy', $t)" />
                        </td>
                    </tr>
                @empty
                    <x-admin.empty-state :colspan="4" text="Belum ada milestone." />
                @endforelse
            </tbody>
        </table>
    </div>
</x-admin-layout>
