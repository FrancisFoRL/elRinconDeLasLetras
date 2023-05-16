<button {{ $attributes->merge(['type' => 'button', 'class' => 'd-inline-flex align-items-center px-4 py-2 rounded-pill text-white', 'style' => 'background-color: #6D9886; border:none;']) }}>
    {{ $slot }}
</button>

{{-- inline-flex items-center px-4 py-2 rounded-pill text-white --}}
