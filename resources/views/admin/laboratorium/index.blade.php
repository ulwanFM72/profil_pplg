<x-admin-layout title="Laboratorium">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div></div>
        <a href="{{ route('admin.laboratorium.create') }}" class="btn btn-danger">+ Tambah Data</a>
    </div>

<x-admin.toolbar placeholder="Cari nama / lokasi…">
        <div class="col-sm-3">
            <label class="form-label small fw-bold">Status</label>
            <select name="status" class="form-select" onchange="this.form.submit()">
                <option value="">Semua</option>
                @foreach (['aktif', 'perawatan', 'nonaktif'] as $s)
                    <option value="{{ $s }}" @selected(request('status') === $s)>{{ ucfirst($s) }}</option>
                @endforeach
            </select>
        </div>
    </x-admin.toolbar>

    <div class="card admin-shadow bg-white">
        <div class="table-responsive">
        <table class="table mb-0 align-middle">
            <thead><tr><th>Foto</th><th>Nama</th><th>Kapasitas</th><th>Status</th><th class="text-end">Aksi</th></tr></thead>
            <tbody>
                @forelse ($rows as $row)
                    <tr>
                        <td>@if ($row->image_url)<img src="{{ $row->image_url }}" class="border border-2 border-dark" style="width:56px;height:56px;object-fit:cover" alt="">@endif</td>
                        <td class="fw-bold">{{ $row->nama }}</td>
                        <td>{{ $row->kapasitas }}</td>
                        <td><span class="badge text-bg-{{ ['aktif' => 'success', 'perawatan' => 'warning', 'nonaktif' => 'danger'][$row->status] }}">{{ ucfirst($row->status) }}</span></td>
                        <td class="text-end">
                            <a href="{{ route('laboratorium.show', $row) }}" target="_blank" class="btn btn-outline-secondary btn-sm">Lihat</a>
                            <a href="{{ route('admin.laboratorium.edit', $row) }}" class="btn btn-outline-dark btn-sm">Ubah</a>
                            <x-admin.delete-form :action="route('admin.laboratorium.destroy', $row)" />
                        </td>
                    </tr>
                @empty
                    <x-admin.empty-state :colspan="5" />
                @endforelse
            </tbody>
        </table>
        </div>
    </div>
    <div class="mt-3">{{ $rows->links() }}</div>
</x-admin-layout>.
