<x-admin-layout title="Statistik">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div></div>
        <a href="{{ route('admin.statistik.create') }}" class="btn btn-danger">+ Tambah Data</a>
    </div>


    <div class="card admin-shadow bg-white">
        <div class="table-responsive">
        <table class="table mb-0 align-middle">
            <thead><tr><th>Label</th><th>Nilai</th><th>Urutan</th><th>Tampil</th><th class="text-end">Aksi</th></tr></thead>
            <tbody>
                @forelse ($rows as $row)
                    <tr>
                        <td class="fw-bold">{{ $row->label }}</td>
                        <td>{{ $row->nilai }}</td>
                        <td>{{ $row->urutan }}</td>
                        <td><span class="badge text-bg-{{ $row->tampil ? 'success' : 'secondary' }}">{{ $row->tampil ? 'Ya' : 'Tidak' }}</span></td>
                        <td class="text-end">
                            <a href="{{ route('admin.statistik.edit', $row) }}" class="btn btn-outline-dark btn-sm">Ubah</a>
                            <x-admin.delete-form :action="route('admin.statistik.destroy', $row)" />
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
</x-admin-layout>
