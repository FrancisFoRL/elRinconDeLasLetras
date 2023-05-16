@props(['value'])

<label {{ $attributes->merge(['class' => 'd-block fs-5 fw-bold mt-3']) }}>
    {{ $value ?? $slot }}
</label>
