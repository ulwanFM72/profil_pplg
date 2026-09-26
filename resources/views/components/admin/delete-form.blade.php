@props(['action'])
{{-- Tombol hapus + modal konfirmasi Bootstrap; id unik per baris. --}}
@php $id = 'del-'.md5($action); @endphp
<button type="button" class="btn btn-outline-danger btn-sm" data-bs-toggle="modal" data-bs-target="#{{ $id }}" data-confirm-delete="{{ $id }}">Hapus</button>
<div class="modal fade" id="{{ $id }}" tabindex="-1" aria-labelledby="{{ $id }}-label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header"><h2 class="modal-title h5" id="{{ $id }}-label">Hapus data?</h2></div>
            <div class="modal-body">Tindakan ini tidak dapat dibatalkan.</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                <form method="POST" action="{{ $action }}">@csrf @method('DELETE')<button class="btn btn-danger">Ya, Hapus</button></form>
            </div>
        </div>
    </div>
</div>
