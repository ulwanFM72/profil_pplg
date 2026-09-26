@props(['src' => null, 'alt' => ''])
@if ($src)
    <img src="{{ $src }}" alt="{{ $alt }}" loading="lazy" {{ $attributes->merge(['class' => 'w-full object-cover']) }}>
@else
    <div role="img" aria-label="{{ $alt }}" {{ $attributes->merge(['class' => 'grid w-full place-items-center bg-sun text-5xl font-extrabold']) }}>{{ Str::upper(Str::substr($alt, 0, 1)) }}</div>
@endif
