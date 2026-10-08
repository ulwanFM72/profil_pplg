<x-admin-layout title="Angkatan">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div></div>
        <a href="{{ route('admin.angkatan.create') }}" class="btn btn-danger">+ Tambah Data</a>
    </div>


    <div class="card admin-shadow bg-white">
        <div class="table-responsive">
        <table class="table mb-0 align-middle">
            <thead><tr><th>Foto</th><th>Tahun</th><th>Nama</th><th class="text-end">Aksi</th></tr></thead>
            <tbody>
                @forelse ($rows as $row)
                    <tr>
                        <td>@if ($row->image_url)<img src="{{ $row->image_url }}" class="border border-2 border-dark" style="width:56px;height:56px;object-fit:cover" alt="">@endif</td>
                        <td class="fw-bold">{{ $row->tahun }}</td>
                        <td>{{ $row->nama }}</td>
                        <td class="text-end">
                            <a href="{{ route('admin.angkatan.edit', $row) }}" class="btn btn-outline-dark btn-sm">Ubah</a>
                            <x-admin.delete-form :action="route('admin.angkatan.destroy', $row)" />
                        </td>
                    </tr>
                @empty
                    <x-admin.empty-state :colspan="4" />
                @endforelse
            </tbody>
        </table>
        </div>
    </div>
    <div class="mt-3">{{ $rows->links() }}</div>
</x-admin-layout>
