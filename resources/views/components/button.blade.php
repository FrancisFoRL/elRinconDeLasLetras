<button {{ $attributes->merge(['type' => 'submit', 'class' => 'd-inline-flex align-items-center px-4 py-2 rounded-pill text-white', 'style' => 'background-color: #212121; border:2px solid #6D9886;']) }}>
    {{ $slot }}
</button>
