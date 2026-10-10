<x-admin-layout title="Keunggulan">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div></div>
        <a href="{{ route('admin.keunggulan.create') }}" class="btn btn-danger">+ Tambah Data</a>
    </div>

    <x-admin.toolbar placeholder="Cari judul / teks…">
        <div class="col-sm-3">
            <label class="form-label small fw-bold">Status</label>
            <select name="aktif" class="form-select" onchange="this.form.submit()">
                <option value="">Semua</option>
                <option value="1" @selected(request('aktif') === '1')>Aktif</option>
                <option value="0" @selected(request('aktif') === '0')>Nonaktif</option>
            </select>
        </div>
    </x-admin.toolbar>

    <div class="card admin-shadow bg-white">
        <div class="table-responsive">
        <table class="table mb-0 align-middle">
            <thead><tr><th>Urutan</th><th>Judul</th><th>Teks</th><th>Warna</th><th>Status</th><th class="text-end">Aksi</th></tr></thead>
            <tbody>
                @forelse ($rows as $row)
                    <tr>
                        <td>{{ $row->urutan }}</td>
                        <td class="fw-bold">{{ $row->judul }}</td>
                        <td>{{ Str::limit($row->teks, 60) }}</td>
                        <td><span class="badge {{ $row->warna }} text-dark">{{ $row->warna }}</span></td>
                        <td><span class="badge text-bg-{{ $row->aktif ? 'success' : 'secondary' }}">{{ $row->aktif ? 'Aktif' : 'Nonaktif' }}</span></td>
                        <td class="text-end">
                            <a href="{{ route('admin.keunggulan.edit', $row) }}" class="btn btn-outline-dark btn-sm">Ubah</a>
                            <x-admin.delete-form :action="route('admin.keunggulan.destroy', $row)" />
                        </td>
                    </tr>
                @empty
                    <x-admin.empty-state :colspan="6" />
                @endforelse
            </tbody>
        </table>
        </div>
    </div>
    <div class="mt-3">{{ $rows->links() }}</div>
</x-admin-layout>