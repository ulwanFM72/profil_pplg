@props(['placeholder' => 'Cari…'])
{{-- Form pencarian generik: filter tambahan (select dsb.) diisi lewat slot. --}}
<form method="GET" class="row g-2 mb-3 align-items-end">
    <div class="col-sm-4">
        <label class="form-label small fw-bold">Cari</label>
        <input type="search" name="q" value="{{ request('q') }}" class="form-control" placeholder="{{ $placeholder }}">
    </div>
    {{ $slot }}
    <div class="col-sm-auto"><button class="btn btn-dark">Terapkan</button></div>
</form>
