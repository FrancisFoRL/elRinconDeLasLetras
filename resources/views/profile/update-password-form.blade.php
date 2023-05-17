<x-form-section submit="updatePassword">
    <x-slot name="title">
        {{ __('Update Password') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Ensure your account is using a long, random password to stay secure.') }}
    </x-slot>

    <x-slot name="form">
        <h2 class="text-center mt-4 display-6">Cambiar Contraseña</h2>
        <div class="row justify-content-center">
            <div class="col-11 col-md-3">
                <x-label for="current_password" value="{{ __('Contraseña Actual') }}" />
                <x-input id="current_password" type="password" class="mt-1 block w-100"
                    wire:model.defer="state.current_password" autocomplete="current-password" />
                <x-input-error for="current_password" class="mt-2" />
            </div>

            <div class="col-11 col-md-3">
                <x-label for="password" value="{{ __('Nueva Contraseña') }}" />
                <x-input id="password" type="password" class="mt-1 block w-100" wire:model.defer="state.password"
                    autocomplete="new-password" />
                <x-input-error for="password" class="mt-2" />
            </div>

            <div class="col-11 col-md-3">
                <x-label for="password_confirmation" value="{{ __('Repita la Contraseña') }}" />
                <x-input id="password_confirmation" type="password" class="mt-1 block w-100"
                    wire:model.defer="state.password_confirmation" autocomplete="new-password" />
                <x-input-error for="password_confirmation" class="mt-2" />
            </div>
        </div>
    </x-slot>

    <x-slot name="actions">
        <div class="d-flex justify-content-center">
            <x-action-message class="mr-3" on="saved">
                {{ __('Se actualizo la contraseña') }}
            </x-action-message>
        </div>

        <div class="d-flex justify-content-center mt-2">
            <x-button class="mt-3">
                {{ __('Actualizar Contraseña') }}
            </x-button>
        </div>
    </x-slot>
</x-form-section>

<style>
    h2 {
        font-family: 'Ubuntu', sans-serif;
    }

    .inputs {
        min-width: 180px;
    }
</style>
