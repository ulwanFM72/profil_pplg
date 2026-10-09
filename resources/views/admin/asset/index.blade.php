<x-admin-layout title="Asset">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div></div>
        <a href="{{ route('admin.asset.create') }}" class="btn btn-danger">+ Tambah Data</a>
    </div>

<x-admin.toolbar placeholder="Cari nama asset…">
        <div class="col-sm-3">
            <label class="form-label small fw-bold">Kategori</label>
            <select name="kategori" class="form-select" onchange="this.form.submit()">
                <option value="">Semua</option>
                @foreach ($kategoriList as $k)<option value="{{ $k }}" @selected(request('kategori') === $k)>{{ $k }}</option>@endforeach
            </select>
        </div>
        <div class="col-sm-3">
            <label class="form-label small fw-bold">Kondisi</label>
            <select name="kondisi" class="form-select" onchange="this.form.submit()">
                <option value="">Semua</option>
                @foreach (['baik', 'cukup', 'rusak'] as $k)<option value="{{ $k }}" @selected(request('kondisi') === $k)>{{ ucfirst($k) }}</option>@endforeach
            </select>
        </div>
    </x-admin.toolbar>

    <div class="card admin-shadow bg-white">
        <div class="table-responsive">
        <table class="table mb-0 align-middle">
            <thead><tr><th>Foto</th><th>Nama</th><th>Kategori</th><th>Jumlah</th><th>Kondisi</th><th class="text-end">Aksi</th></tr></thead>
            <tbody>
                @forelse ($rows as $row)
                    <tr>
                        <td>@if ($row->image_url)<img src="{{ $row->image_url }}" class="border border-2 border-dark" style="width:56px;height:56px;object-fit:cover" alt="">@endif</td>
                        <td class="fw-bold">{{ $row->nama }}</td>
                        <td>{{ $row->kategori }}</td>
                        <td>{{ $row->jumlah }}</td>
                        <td><span class="badge text-bg-{{ ['baik' => 'success', 'cukup' => 'warning', 'rusak' => 'danger'][$row->kondisi] }}">{{ ucfirst($row->kondisi) }}</span></td>
                        <td class="text-end">
                            <a href="{{ route('admin.asset.edit', $row) }}" class="btn btn-outline-dark btn-sm">Ubah</a>
                            <x-admin.delete-form :action="route('admin.asset.destroy', $row)" />
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
</x-admin-layout>.
