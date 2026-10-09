<x-admin-layout title="Galeri">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div></div>
        <a href="{{ route('admin.galeri.create') }}" class="btn btn-danger">+ Tambah Data</a>
    </div>

<x-admin.toolbar placeholder="Cari judul…">
        <div class="col-sm-3">
            <label class="form-label small fw-bold">Kategori</label>
            <select name="kategori" class="form-select" onchange="this.form.submit()">
                <option value="">Semua</option>
                @foreach ($kategoriList as $k)<option value="{{ $k }}" @selected(request('kategori') === $k)>{{ $k }}</option>@endforeach
            </select>
        </div>
    </x-admin.toolbar>

    <div class="card admin-shadow bg-white">
        <div class="table-responsive">
        <table class="table mb-0 align-middle">
            <thead><tr><th>Foto</th><th>Judul</th><th>Kategori</th><th>Tahun</th><th class="text-end">Aksi</th></tr></thead>
            <tbody>
                @forelse ($rows as $row)
                    <tr>
                        <td>@if ($row->image_url)<img src="{{ $row->image_url }}" class="border border-2 border-dark" style="width:56px;height:56px;object-fit:cover" alt="">@endif</td>
                        <td class="fw-bold">{{ $row->judul }}</td>
                        <td>{{ $row->kategori }}</td>
                        <td>{{ $row->tahun }}</td>
                        <td class="text-end">
                            <a href="{{ route('admin.galeri.edit', $row) }}" class="btn btn-outline-dark btn-sm">Ubah</a>
                            <x-admin.delete-form :action="route('admin.galeri.destroy', $row)" />
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
