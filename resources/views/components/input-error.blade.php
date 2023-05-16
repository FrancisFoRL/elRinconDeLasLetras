@props(['for'])

@error($for)
    <p {{ $attributes->merge(['class' => 'fs-6 text-danger']) }}>{{ $message }}</p>
@enderror
