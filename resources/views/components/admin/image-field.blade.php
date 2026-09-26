@props(['name', 'current' => null, 'label' => 'Gambar'])
<div class="mb-3">
    <label for="{{ $name }}" class="form-label fw-bold">{{ $label }}</label>
    @if ($current)<div class="mb-2"><img src="{{ $current }}" alt="" class="border border-2 border-dark" style="max-height:120px"></div>@endif
    <input type="file" id="{{ $name }}" name="{{ $name }}" accept="image/jpeg,image/png,image/webp" class="form-control @error($name) is-invalid @enderror">
    <div class="form-text">JPG, JPEG, PNG, atau WEBP, maksimal 2 MB.</div>
    @error($name)<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
</div>
