<x-admin-layout title="Timeline Sejarah">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div></div>
        <a href="{{ route('admin.timeline.create') }}" class="btn btn-danger">+ Tambah Data</a>
    </div>


    <div class="card admin-shadow bg-white">
        <div class="table-responsive">
        <table class="table mb-0 align-middle">
            <thead><tr><th>Tahun</th><th>Judul</th><th>Urutan</th><th class="text-end">Aksi</th></tr></thead>
            <tbody>
                @forelse ($rows as $row)
                    <tr>
                        <td>{{ $row->tahun }}</td><td>{{ $row->judul }}</td><td>{{ $row->urutan }}</td>
                        <td class="text-end">
                            <a href="{{ route('admin.timeline.edit', $row) }}" class="btn btn-outline-dark btn-sm">Ubah</a>
                            <x-admin.delete-form :action="route('admin.timeline.destroy', $row)" />
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
