@props(['submit'])

<div {{ $attributes->merge(['class' => '']) }}>
    {{-- <x-section-title>
        <x-slot name="title">{{ $title }}</x-slot>
        <x-slot name="description">{{ $description }}</x-slot>
    </x-section-title> --}}

    <div class="">
        <form wire:submit.prevent="{{ $submit }}">
            <div class="{{ isset($actions) ? 'sm:rounded-tl-md sm:rounded-tr-md' : 'sm:rounded-md' }}">
                <div class="grid grid-cols-6 gap-6">
                    {{ $form }}
                </div>
            </div>

            @if (isset($actions))
                <div class="">
                    {{ $actions }}
                </div>
            @endif
        </form>
    </div>
</div>
