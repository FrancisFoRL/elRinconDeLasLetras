<button {{ $attributes->merge(['type' => 'button', 'class' => 'd-inline-flex align-items-center justify-content-center rounded-pill px-4 py-2 text-white', 'style' => 'background-color: #8B0000; border:2px solid #212121;']) }}>
    {{ $slot }}
</button>
